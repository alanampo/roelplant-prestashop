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

class GptContentBlogHook extends \ObjectModel
{
    public $quantity = 8;
    public $date_start;
    public $date_end;
    public $hook_name;
    public $order_way;
    public $active = true;
    public $date_add;
    public $date_upd;

    public $name;

    public static $definition = [
        'table' => 'gptcontent_blog_hook',
        'primary' => 'id_gptcontent_blog_hook',
        'multilang' => true,
        'fields' => [
            'quantity' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true],
            'date_start' => ['type' => self::TYPE_DATE, 'validate' => 'isDateOrNull'],
            'date_end' => ['type' => self::TYPE_DATE, 'validate' => 'isDateOrNull'],
            'order_way' => ['type' => self::TYPE_STRING, 'validate' => 'isOrderWay'],
            'hook_name' => ['type' => self::TYPE_STRING, 'validate' => 'isHookName', 'required' => true, 'size' => 191],
            'active' => ['type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true],
            'date_add' => ['type' => self::TYPE_DATE, 'validate' => 'isDate'],
            'date_upd' => ['type' => self::TYPE_DATE, 'validate' => 'isDate'],

            /* Lang fields */
            'name' => [
                'type' => self::TYPE_STRING,
                'lang' => true,
                'validate' => 'isCatalogName',
                'required' => true,
                'size' => 128,
            ],
        ],
    ];

    public function add($autoDate = true, $nullValues = false)
    {
        if ($id_gptcontent_blog_hook = self::existHookName($this->hook_name)) {
            $message = $this->trans(
                'The settings for the hook "%hook%" already exist [id = %id%]',
                [
                    '%hook%' => $this->hook_name,
                    '%id%' => $id_gptcontent_blog_hook,
                ],
                'Modules.Chatgptcontentgenerator.Admin'
            );

            throw new \PrestaShopException($message);
        }

        return parent::add($autoDate, $nullValues);
    }

    public function update($nullValues = false)
    {
        if ($id_gptcontent_blog_hook = self::existHookName($this->hook_name, $this->id)) {
            $message = $this->trans(
                'The settings for the hook "%hook%" already exist [id = %id%]',
                [
                    '%hook%' => $this->hook_name,
                    '%id%' => $id_gptcontent_blog_hook,
                ],
                'Modules.Chatgptcontentgenerator.Admin'
            );

            throw new \PrestaShopException($message);
        }

        return parent::update($nullValues);
    }

    public static function existHookName($hookName, $idsExclude = [])
    {
        if (!is_array($idsExclude)) {
            $idsExclude = [(int) $idsExclude];
        }

        $idsExclude = array_map('intval', $idsExclude);

        $query = new \DbQuery();
        $query->select(self::$definition['primary'])
            ->from(self::$definition['table'])
            ->where('hook_name = \'' . pSQL($hookName) . '\'');

        if ($idsExclude) {
            $query->where(self::$definition['primary'] . ' NOT IN (' . implode(',', $idsExclude) . ')');
        }

        return \Db::getInstance()->getValue($query);
    }

    public static function getPostsByHook($hookName, $idLang)
    {
        $res = [];

        foreach (self::getGptContentBlogHooks($idLang, $hookName) as $hook) {
            $res[] = [
                'id_gptcontent_blog_hook' => $hook->id,
                'name' => $hook->name,
                'posts' => $hook->getHookPosts($idLang),
            ];
        }

        return $res;
    }

    public static function getGptContentBlogHooks($idLang, $hookName = null, $isActive = true)
    {
        $gptContentBlogHooks = new \PrestaShopCollection(self::class, $idLang);

        if ($isActive) {
            $gptContentBlogHooks->where('active', '=', 1);
        }

        if ($hookName) {
            $gptContentBlogHooks->where('hook_name', '=', $hookName);
        }

        return $gptContentBlogHooks;
    }

    public function getHookPosts($idLang = null, $isActive = true)
    {
        $orderBy = GptContentPost::$definition['primary'];

        if ($idLang === null) {
            $idLang = \Context::getContext()->language->id;
        }

        $posts = new \PrestaShopCollection(GptContentPost::class, $idLang);

        if ($isActive) {
            $posts->where('active', '=', 1);
        }

        if ('0000-00-00' != $this->date_start) {
            $posts->where('date_add', '>=', $this->date_start . ' 00:00:00');
            $orderBy = 'date_add';
        }

        if ('0000-00-00' != $this->date_end) {
            $posts->where('date_add', '<=', $this->date_end . ' 23:59:59');
            $orderBy = 'date_add';
        }

        if ($this->quantity > 0) {
            $posts->setPageSize($this->quantity);
        }

        if (\Validate::isOrderWay($this->order_way)) {
            $posts->orderBy($orderBy, $this->order_way);
        }

        return $posts;
    }
}
