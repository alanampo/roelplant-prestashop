<?php
/**
 * 2007-2024 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 *  @author    PrestaShop SA <contact@prestashop.com>
 *  @copyright 2007-2024 PrestaShop SA
 *  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */
namespace PrestaShop\Module\Chatgptcontentgenerator\Entity;

if (!defined('_PS_VERSION_')) {
    exit;
}

class GptContentBlogCategory extends \ObjectModel
{
    public $id_parent;
    public $level_depth;
    public $nleft;
    public $nright;
    public $position;
    public $active = true;
    public $date_add;
    public $date_upd;

    public $name;
    public $description;
    public $meta_title;
    public $meta_keywords;
    public $meta_description;
    public $link_rewrite;

    public static $definition = [
        'table' => 'gptcontent_blog_category',
        'primary' => 'id_gptcontent_blog_category',
        'multilang' => true,
        'fields' => [
            'id_parent' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'],
            'level_depth' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'],
            'nleft' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'],
            'nright' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'],
            'position' => ['type' => self::TYPE_INT],
            'active' => ['type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true],
            'date_add' => ['type' => self::TYPE_DATE, 'validate' => 'isDate'],
            'date_upd' => ['type' => self::TYPE_DATE, 'validate' => 'isDate'],

            /* Lang fields */
            'name' => ['type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCatalogName', 'required' => true, 'size' => 128],
            'description' => ['type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isCleanHtml'],
            'meta_title' => ['type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 255],
            'meta_keywords' => ['type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 255],
            'meta_description' => ['type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 512],
            'link_rewrite' => [
                'type' => self::TYPE_STRING,
                'lang' => true,
                'validate' => 'isLinkRewrite',
                'required' => true,
                'size' => 128,
                'ws_modifier' => [
                    'http_method' => \WebserviceRequest::HTTP_POST,
                    'modifier' => 'modifierWsLinkRewrite',
                ],
            ],
        ],
    ];

    public function add($autoDate = true, $nullValues = false)
    {
        if (!$this->id_parent) {
            $this->id_parent = self::getIdRootCategory();
        }

        if (!isset($this->level_depth)) {
            $this->level_depth = $this->calcLevelDepth();
        }

        $this->position = (int) self::getLastPosition((int) $this->id_parent);
        $res = parent::add($autoDate, $nullValues);
        self::regenerateEntireNtree();

        return $res;
    }

    public function update($nullValues = false)
    {
        if ($this->id_parent == $this->id) {
            throw new \PrestaShopException('a category cannot be its own parent');
        }

        if (!$this->id_parent) {
            $this->id_parent = self::getIdRootCategory();
        }

        if ($this->level_depth != $this->calcLevelDepth()) {
            $this->level_depth = $this->calcLevelDepth();
            $changed = true;
        }

        if (self::getParentId($this->id) !== (int) $this->id_parent) {
            $changed = true;
        }

        // If the parent category was changed, we don't want to have 2 categories with the same position
        if (!isset($changed)) {
            $changed = $this->getDuplicatePosition();
        }

        $ret = parent::update($nullValues);
        if ($changed) {
            self::cleanPositions((int) $this->id_parent);
            self::regenerateEntireNtree();
            $this->recalculateLevelDepth($this->id);
        }

        return $ret;
    }

    public function calcLevelDepth()
    {
        /* Root category */
        if (!$this->id_parent) {
            return 0;
        }

        if ($this->id_parent === self::getIdTopCategory()) {
            return 1;
        }

        $parentCategory = new self((int) $this->id_parent);
        if (!\Validate::isLoadedObject($parentCategory)) {
            if (is_array($this->name)) {
                $name = $this->name[\Context::getContext()->language->id];
            } else {
                $name = $this->name;
            }

            throw new \PrestaShopException('Parent category ' . $this->id_parent . '
                does not exist. Current category: ' . $name);
        }

        return (int) $parentCategory->level_depth + 1;
    }

    public function updatePosition($way, $position)
    {
        $query = new \DbQuery();
        $query->select('`id_gptcontent_blog_category`, `position`, `id_parent`')
            ->from('gptcontent_blog_category')
            ->where('id_parent = ' . (int) $this->id_parent)
            ->orderBy('`position` ASC');

        if (!$res = \Db::getInstance()->executeS($query)) {
            return false;
        }

        $movedCategory = false;
        foreach ($res as $category) {
            if ((int) $category['id_gptcontent_blog_category'] == (int) $this->id) {
                $movedCategory = $category;
            }
        }

        if ($movedCategory === false) {
            return false;
        }
        // < and > statements rather than BETWEEN operator
        // since BETWEEN is treated differently according to databases
        $increment = ($way ? '- 1' : '+ 1');
        $result = (\Db::getInstance()->execute(
            'UPDATE `' . _DB_PREFIX_ . 'gptcontent_blog_category` ' .
            'SET `position`= ' .
            'IF(cast(`position` as signed) ' . $increment . ' > 0, `position` ' . $increment . ', 0), ' .
            '`date_upd` = "' . date('Y-m-d H:i:s') . '" ' .
            'WHERE `position`' .
            ($way
                ? '> ' . (int) $movedCategory['position'] . ' AND `position` <= ' . (int) $position
                : '< ' . (int) $movedCategory['position'] . ' AND `position` >= ' . (int) $position) . ' ' .
            'AND `id_parent`=' . (int) $movedCategory['id_parent'])
        && \Db::getInstance()->execute('
            UPDATE `' . _DB_PREFIX_ . 'gptcontent_blog_category`
            SET `position` = ' . (int) $position . ',
            `date_upd` = "' . date('Y-m-d H:i:s') . '"
            WHERE `id_parent` = ' . (int) $movedCategory['id_parent'] . '
            AND `id_gptcontent_blog_category`=' . (int) $movedCategory['id_gptcontent_blog_category']));

        return $result;
    }

    public static function cleanPositions($idCategoryParent = null)
    {
        if ($idCategoryParent === null) {
            return;
        }

        $return = true;

        $query = new \DbQuery();
        $query->select('`id_gptcontent_blog_category`')
            ->from('gptcontent_blog_category')
            ->where('`id_parent` = ' . (int) $idCategoryParent)
            ->orderBy('`position`');

        $result = \Db::getInstance()->executeS($query);
        $count = count($result);

        for ($i = 0; $i < $count; ++$i) {
            $return &= \Db::getInstance()->execute(
                'UPDATE `' . _DB_PREFIX_ . 'gptcontent_blog_category`
                    SET `position` = ' . (int) $i . ',
                        `date_upd` = "' . date('Y-m-d H:i:s') . '"
                    WHERE `id_parent` = ' . (int) $idCategoryParent . '
                        AND `id_gptcontent_blog_category` = ' . (int) $result[$i]['id_gptcontent_blog_category']
            );
        }

        return $return;
    }

    public function delete()
    {
        if (
            (int) $this->id === 0
            || (int) $this->id === self::getIdTopCategory()
            || (int) $this->id === self::getIdRootCategory()
        ) {
            return false;
        }

        $this->clearCache();

        $deletedChildren = $this->getAllChildren();
        $allCat = $deletedChildren;
        $allCat[] = $this;

        foreach ($allCat as $cat) {
            $cat->deleteLite();
            $cat->updatePostsParent();
            self::cleanPositions($cat->id_parent);
        }

        self::regenerateEntireNtree();

        return true;
    }

    public function deleteLite()
    {
        return parent::delete();
    }

    public static function getLastPosition($idCategoryParent)
    {
        $query = new \DbQuery();
        $query->select('1')
            ->from('gptcontent_blog_category')
            ->where('id_parent = ' . (int) $idCategoryParent)
            ->limit(2);

        $results = \Db::getInstance()->executeS($query);

        if (count($results) === 0) {
            return 0;
        } else {
            $query = new \DbQuery();
            $query->select('MAX(`position`)')
                ->from('gptcontent_blog_category')
                ->where('id_parent = ' . (int) $idCategoryParent);

            $maxPosition = (int) \Db::getInstance()->getValue($query);

            return ++$maxPosition;
        }
    }

    public static function regenerateEntireNtree()
    {
        $sql = new \DbQuery();
        $sql->select('`id_gptcontent_blog_category`, `id_parent`')
            ->from('gptcontent_blog_category')
            ->orderBy('`id_parent`, `position` ASC');

        $categories = \Db::getInstance()->executeS($sql);
        $categoriesArray = [];

        foreach ($categories as $category) {
            $categoriesArray[$category['id_parent']]['subcategories'][] = $category['id_gptcontent_blog_category'];
        }
        $n = 1;

        if (isset($categoriesArray[0]['subcategories'][0])) {
            $queries = self::computeNTreeInfos($categoriesArray, $categoriesArray[0]['subcategories'][0], $n);

            // update by batch of 5000 categories
            $chunks = array_chunk($queries, 5000);
            foreach ($chunks as $chunk) {
                $sqlChunk = array_map(function ($value) { return '(' . rtrim(implode(',', $value)) . ')'; }, $chunk);

                \Db::getInstance()->execute('INSERT INTO `' . _DB_PREFIX_ . 'gptcontent_blog_category`
                    (id_gptcontent_blog_category, nleft, nright)
                    VALUES ' . rtrim(implode(',', $sqlChunk), ',') . '
                    ON DUPLICATE KEY UPDATE nleft=VALUES(nleft), nright=VALUES(nright)');
            }
        }
    }

    protected static function computeNTreeInfos(&$categories, $idCategory, &$n)
    {
        $queries = [];
        $left = $n++;
        if (isset($categories[(int) $idCategory]['subcategories'])) {
            foreach ($categories[(int) $idCategory]['subcategories'] as $idSubcategory) {
                $queries = array_merge($queries, self::computeNTreeInfos($categories, (int) $idSubcategory, $n));
            }
        }
        $right = (int) $n++;

        $queries[] = [$idCategory, $left, $right];

        return $queries;
    }

    public function recalculateLevelDepth($idParentCategory)
    {
        if (!is_numeric($idParentCategory)) {
            throw new \PrestaShopException('id category is not numeric');
        }

        // Gets all children
        $query = new \DbQuery();
        $query->select('`id_gptcontent_blog_category`, `id_parent`, `level_depth`')
            ->from('gptcontent_blog_category')
            ->where('id_parent = ' . (int) $idParentCategory);
        $categories = \Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);

        // Gets level_depth
        $query = new \DbQuery();
        $query->select('`level_depth`')
            ->from('gptcontent_blog_category')
            ->where('id_gptcontent_blog_category = ' . (int) $idParentCategory);
        $level = \Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($query);

        // Updates level_depth for all children
        foreach ($categories as $subCategory) {
            \Db::getInstance()->update(
                'gptcontent_blog_category',
                [
                    'level_depth' => (int) ($level['level_depth'] + 1),
                ],
                '`id_gptcontent_blog_category` = ' . (int) $subCategory['id_gptcontent_blog_category']
            );
            // Recursive call
            $this->recalculateLevelDepth($subCategory['id_category']);
        }
    }

    public static function getParentId(int $categoryId): int
    {
        $query = new \DbQuery();
        $query->select('id_parent')
            ->from('gptcontent_blog_category')
            ->where('id_gptcontent_blog_category = ' . $categoryId)
        ;

        return (int) \Db::getInstance()->getValue($query);
    }

    public static function getTopCategory($idLang = null)
    {
        if (null === $idLang) {
            $idLang = (int) \Context::getContext()->language->id;
        }
        $cacheId = 'GptContentBlogCategory::getTopCategory_' . (int) $idLang;

        if (!\Cache::isStored($cacheId)) {
            $sql = new \DbQuery();
            $sql->select('id_gptcontent_blog_category')
                ->from('gptcontent_blog_category')
                ->where('id_parent = 0');

            if ($id = \Db::getInstance()->getValue($sql)) {
                $category = new self($id, $idLang);
                \Cache::store($cacheId, $category);

                return $category;
            }

            return false;
        }

        return \Cache::retrieve($cacheId);
    }

    public static function getIdTopCategory()
    {
        return (int) \Configuration::get(\Chatgptcontentgenerator::getConfigPrefix() . 'BLOG_ROOT_CATEGORY');
    }

    public static function getIdRootCategory()
    {
        if ($rootCategory = self::getRootCategory()) {
            return (int) $rootCategory->id;
        }

        return 0;
    }

    public static function getRootCategory($idLang = null)
    {
        if (null === $idLang) {
            $idLang = (int) \Context::getContext()->language->id;
        }

        $cacheId = 'GptContentBlogCategory::getRootCategory_' . $idLang;

        if (!\Cache::isStored($cacheId)) {
            $sql = new \DbQuery();
            $sql->select('id_gptcontent_blog_category')
                ->from('gptcontent_blog_category')
                ->where('id_parent = ' . (int) self::getIdTopCategory());

            if ($id = \Db::getInstance()->getValue($sql)) {
                $category = new self($id, $idLang);
                \Cache::store($cacheId, $category);

                return $category;
            }

            return false;
        }

        return \Cache::retrieve($cacheId);
    }

    public static function getCategoriesWithChildrens($rootCategoryId = null, $idLang = null)
    {
        if (!$rootCategoryId) {
            $rootCategoryId = self::getIdRootCategory();
        }

        if (!$idLang) {
            $idLang = \Context::getContext()->language->id;
        }

        $categories = [];

        foreach (self::getChildren($rootCategoryId, $idLang, false) as $category) {
            $idCategory = $category['id_category'] = (int) $category['id_gptcontent_blog_category'];
            if (!isset($categories[$rootCategoryId][$idCategory])) {
                $categories[$rootCategoryId][$idCategory] = $category;
            }
        }

        $tree = self::getCategoryInformation([$rootCategoryId], $idLang);

        $children = self::fillTree($categories, $rootCategoryId, $idLang);

        if (!empty($children)) {
            $tree[$rootCategoryId]['children'] = $children;
        }

        return $tree;
    }

    protected static function fillTree(&$categories, $rootCategoryId, $idLang)
    {
        $tree = [];
        $rootCategoryId = (int) $rootCategoryId;

        if (isset($categories[$rootCategoryId]) && is_array($categories[$rootCategoryId])) {
            foreach ($categories[$rootCategoryId] as $category) {
                $categoryId = (int) $category['id_gptcontent_blog_category'];
                $tree[$categoryId] = $category;

                if ($categoryChildren = self::getChildren($categoryId, $idLang, false)) {
                    foreach ($categoryChildren as $child) {
                        $childId = $child['id_category'] = (int) $child['id_gptcontent_blog_category'];

                        if (!array_key_exists('children', $tree[$categoryId])) {
                            $tree[$categoryId]['children'] = [$childId => $child];
                        } else {
                            $tree[$categoryId]['children'][$childId] = $child;
                        }

                        $categories[$childId] = [$child];
                    }

                    foreach ($tree[$categoryId]['children'] as $childId => $child) {
                        $subtree = self::fillTree($categories, $childId, $idLang);

                        foreach ($subtree as $subcategoryId => $subcategory) {
                            $tree[$categoryId]['children'][$subcategoryId] = $subcategory;
                        }
                    }
                }
            }
        }

        return $tree;
    }

    public static function getChildren($idParent, $idLang, $active = true)
    {
        $cacheId = 'GptContentBlogCategory::getChildren_' . (int) $idParent . '-' . (int) $idLang . '-' . (bool) $active;

        if (!\Cache::isStored($cacheId)) {
            $query = new \DbQuery();
            $query->select('gpc.`id_gptcontent_blog_category`, gpcl.`name`, gpcl.`link_rewrite`')
                ->from('gptcontent_blog_category', 'gpc')
                ->leftJoin(
                    'gptcontent_blog_category_lang',
                    'gpcl',
                    'gpcl.`id_gptcontent_blog_category` = gpc.`id_gptcontent_blog_category`'
                )
                ->where('gpcl.id_lang = ' . (int) $idLang)
                ->where('gpc.id_parent = ' . (int) $idParent)
                ->groupBy('gpc.`id_gptcontent_blog_category`')
                ->orderBy('gpc.`position` ASC');

            if (true === $active) {
                $query->where('gpc.`active` = 1');
            }

            $result = \Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);
            \Cache::store($cacheId, $result);

            return $result;
        }

        return \Cache::retrieve($cacheId);
    }

    public function getAllChildren($idLang = null)
    {
        if (null === $idLang) {
            $idLang = \Context::getContext()->language->id;
        }

        $categories = new \PrestaShopCollection(self::class, $idLang);
        $categories->where('nleft', '>', $this->nleft);
        $categories->where('nright', '<', $this->nright);

        return $categories;
    }

    public function getAllParents($idLang = null)
    {
        if (null === $idLang) {
            $idLang = \Context::getContext()->language->id;
        }

        $categories = new \PrestaShopCollection(self::class, $idLang);
        $categories->where('nleft', '<', $this->nleft);
        $categories->where('nright', '>', $this->nright);
        $categories->orderBy('nleft');

        return $categories;
    }

    public function modifierWsLinkRewrite()
    {
        foreach ($this->name as $id_lang => $name) {
            if (empty($this->link_rewrite[$id_lang])) {
                $this->link_rewrite[$id_lang] = \Tools::str2url($name);
            } elseif (!\Validate::isLinkRewrite($this->link_rewrite[$id_lang])) {
                $this->link_rewrite[$id_lang] = \Tools::str2url($this->link_rewrite[$id_lang]);
            }
        }

        return true;
    }

    public function getDuplicatePosition()
    {
        $query = new \DbQuery();
        $query->select('id_gptcontent_blog_category')
            ->from('gptcontent_blog_category')
            ->where('id_parent = ' . $this->id_parent)
            ->where('position = ' . $this->position)
            ->where('id_gptcontent_blog_category != ' . $this->id)
        ;

        return (int) \Db::getInstance()->getValue($query);
    }

    public static function getCategoryInformation($idsCategory, $idLang = null)
    {
        if (null === $idLang) {
            $idLang = \Context::getContext()->language->id;
        }

        if (!is_array($idsCategory) || !count($idsCategory)) {
            return false;
        }

        $categories = [];
        $query = (new \DbQuery())
            ->select('gpc.`id_gptcontent_blog_category`, gpcl.`name`, gpcl.`link_rewrite`, gpcl.`id_lang`')
            ->from('gptcontent_blog_category', 'gpc')
            ->leftJoin(
                'gptcontent_blog_category_lang',
                'gpcl',
                'gpcl.`id_gptcontent_blog_category` = gpc.`id_gptcontent_blog_category`'
            )
            ->where('gpcl.id_lang = ' . (int) $idLang)
            ->where('gpc.id_gptcontent_blog_category IN (' . implode(',', array_map('intval', $idsCategory)) . ')');

        foreach (\Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query) as $category) {
            $idCategory = $category['id_category'] = (int) $category['id_gptcontent_blog_category'];
            $categories[$idCategory] = $category;
        }

        return $categories;
    }

    public function getParentsCategories($idLang = null)
    {
        if (null === $idLang) {
            $idLang = \Context::getContext()->language->id;
        }

        $categories = null;

        $sqlAppend = 'FROM `' . _DB_PREFIX_ . 'gptcontent_blog_category` gpc
			LEFT JOIN `' . _DB_PREFIX_ . 'gptcontent_blog_category_lang` gpcl
				ON (gpc.`id_gptcontent_blog_category` = gpcl.`id_gptcontent_blog_category`
                    AND `id_lang` = ' . (int) $idLang . ')';

        $rootCategory = self::getRootCategory();
        if (
            !\Tools::isSubmit('id_gptcontent_blog_category')
            || (int) \Tools::getValue('id_gptcontent_blog_category') == (int) $rootCategory->id
        ) {
            $sqlAppend .= ' AND gpc.`id_parent` != 0';
        }

        $categories = [];

        $treeInfo = \Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow(
            'SELECT gpc.`nleft`, gpc.`nright` ' . $sqlAppend . '
                WHERE gpc.`id_gptcontent_blog_category` = ' . (int) $this->id
        );

        if (!empty($treeInfo)) {
            $rootTreeInfo = \Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow(
                'SELECT gpc.`nleft`, gpc.`nright` FROM `' . _DB_PREFIX_ . 'gptcontent_blog_category` gpc
                WHERE gpc.`id_gptcontent_blog_category` = ' . (int) $rootCategory->id
            );

            $categories = \Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
                'SELECT gpc.*, gpcl.* ' . $sqlAppend .
                ' WHERE gpc.`nleft` <= ' . (int) $treeInfo['nleft'] .
                ' AND gpc.`nright` >= ' . (int) $treeInfo['nright'] .
                ' AND gpc.`nleft` >= ' . (int) $rootTreeInfo['nleft'] .
                ' AND gpc.`nright` <= ' . (int) $rootTreeInfo['nright'] .
                ' ORDER BY `nleft` DESC'
            );
        }

        return $categories;
    }

    protected function updatePostsParent()
    {
        $postsCategory = GptContentPost::getPosts(
            \Context::getContext()->language->id,
            null,
            null,
            null,
            false,
            false,
            false,
            null,
            false,
            null,
            false,
            [],
            false,
            $this->id
        );

        if ($postsCategory['posts']) {
            $parentCategory = new self($this->id_parent);

            if (!\Validate::isLoadedObject($parentCategory) || $parentCategory->id_parent == self::getIdTopCategory()) {
                $idParent = self::getIdRootCategory();
            } else {
                $idParent = $parentCategory->id;
            }

            foreach ($postsCategory['posts'] as $post) {
                $post->deleteCategory($this->id);
                $post->addToCategories($idParent);
                $post->chechDefaultCategory($idParent);
            }
        }
    }

    public static function getInstanceByRewrite($rewrite, $id_lang = false)
    {
        if (!$id_lang) {
            $id_lang = \Context::getContext()->language->id;
        }

        if (!$rewrite) {
            return false;
        }

        $sql = new \DbQuery();
        $sql->select('gbc.id_gptcontent_blog_category')
            ->from('gptcontent_blog_category', 'gbc')
            ->leftJoin(
                'gptcontent_blog_category_lang',
                'gbcl',
                'gbcl.`id_gptcontent_blog_category` = gbc.`id_gptcontent_blog_category`
                    AND gbcl.`id_lang` = ' . (int) $id_lang
            )
            ->where('gbc.active = 1')
            ->where('gbcl.link_rewrite = \'' . pSQL($rewrite) . '\'');

        if ($id = \Db::getInstance()->getValue($sql)) {
            return new self((int) $id, $id_lang);
        }

        return false;
    }

    public static function createTopCategory()
    {
        if (\Validate::isLoadedObject(self::getTopCategory())) {
            return true;
        }

        $category = new self();
        $category->id_parent = 0;
        $category->level_depth = 0;
        $category->position = 0;

        foreach (\Language::getLanguages() as $lang) {
            $category->name[(int) $lang['id_lang']] = 'Root';
        }

        $category->modifierWsLinkRewrite();

        if ($category->add()) {
            \Configuration::updateGlobalValue(
                \Chatgptcontentgenerator::getConfigPrefix() . 'BLOG_ROOT_CATEGORY',
                (int) $category->id
            );

            return true;
        }

        return false;
    }

    public static function createRootCategory()
    {
        if (\Validate::isLoadedObject(self::getRootCategory())) {
            return true;
        }

        if (!$topcategory = self::getTopCategory()) {
            return false;
        }

        $category = new self();
        $category->id_parent = (int) $topcategory->id;
        $category->level_depth = 1;
        $category->position = 0;

        foreach (\Language::getLanguages() as $lang) {
            $category->name[(int) $lang['id_lang']] = 'Blog';
        }

        $category->modifierWsLinkRewrite();

        return $category->add();
    }

    public function getCategoriesTree($idLang, $maxDepth = 4)
    {
        if (!\Validate::isLoadedObject($this)) {
            return [];
        }

        $resultIds = [];
        $resultParents = [];

        $query = (new \DbQuery())
            ->select('gpc.`id_gptcontent_blog_category`, gpc.`id_parent`, gpcl.`name`,
                gpcl.`description`, gpcl.`link_rewrite`')
            ->from('gptcontent_blog_category', 'gpc')
            ->innerJoin(
                'gptcontent_blog_category_lang',
                'gpcl',
                '(
                    gpcl.`id_gptcontent_blog_category` = gpc.`id_gptcontent_blog_category`
                    AND gpcl.`id_lang` = ' . (int) $idLang . '
                )'
            )
            ->where('gpc.`active` = 1')
            ->where('gpc.`id_gptcontent_blog_category` != ' . self::getIdTopCategory())
            ->where('gpc.`nleft` >= ' . (int) $this->nleft)
            ->where('gpc.`nleft` <= ' . (int) $this->nright)
            ->orderBy('gpc.`level_depth` ASC, gpc.`position` ASC')
        ;

        if ($maxDepth > 0) {
            $maxDepth += $this->level_depth;
            $query->where('gpc.`level_depth` <= ' . (int) $maxDepth);
        }

        $result = \Db::getInstance()->executeS($query);

        foreach ($result as &$row) {
            $resultParents[$row['id_parent']][] = &$row;
            $resultIds[$row['id_gptcontent_blog_category']] = &$row;
        }

        return $this->getTree($resultParents, $resultIds, $maxDepth, $this->id);
    }

    public function getTree($resultParents, $resultIds, $maxDepth, $id_category = null, $currentDepth = 0)
    {
        $children = [];

        if (isset($resultParents[$id_category]) && count($resultParents[$id_category]) && ($maxDepth == 0 || $currentDepth < $maxDepth)) {
            foreach ($resultParents[$id_category] as $subcat) {
                $children[] = $this->getTree($resultParents, $resultIds, $maxDepth, $subcat['id_gptcontent_blog_category'], $currentDepth + 1);
            }
        }

        if (isset($resultIds[$id_category])) {
            $link = self::getLinkStatic($id_category, $resultIds[$id_category]['link_rewrite']);
            $name = $resultIds[$id_category]['name'];
            $desc = $resultIds[$id_category]['description'];
        } else {
            $link = $name = $desc = '';
        }

        return [
            'id' => $id_category,
            'link' => $link,
            'name' => $name,
            'desc' => $desc,
            'children' => $children,
        ];
    }

    public function getLink($params = [])
    {
        return self::getLinkStatic($this->id, $this->link_rewrite, $params);
    }

    public static function getLinkStatic($id_gptcontent_blog_category, $link_rewrite, $params = [])
    {
        if (
            $id_gptcontent_blog_category == GptContentBlogCategory::getIdTopCategory()
            || $id_gptcontent_blog_category == GptContentBlogCategory::getIdRootCategory()
        ) {
            $routeController = 'bloghome';

            if (isset($params['rewrite'])) {
                unset($params['rewrite']);
            }
        } else {
            $routeController = 'blogcategory';
            $params['rewrite'] = $link_rewrite;
        }

        if (isset($params['p'])) {
            $routeController .= 'page';
        }

        return \Context::getContext()->link->getModuleLink(
            'chatgptcontentgenerator',
            $routeController,
            $params
        );
    }
}
