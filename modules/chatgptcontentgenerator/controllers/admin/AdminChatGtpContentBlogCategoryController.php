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
if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\Module\Chatgptcontentgenerator\Entity\GptContentBlogCategory;

class AdminChatGtpContentBlogCategoryController extends ModuleAdminController
{
    protected $_category;
    protected $position_identifier = 'id_gptcontent_blog_category';

    private $original_filter = '';

    public function __construct()
    {
        $this->table = GptContentBlogCategory::$definition['table'];
        $this->className = GptContentBlogCategory::class;
        $this->identifier = GptContentBlogCategory::$definition['primary'];
        $this->identifier_name = $this->identifier;
        $this->list_no_link = true;
        $this->lang = true;
        $this->deleted = false;
        $this->explicitSelect = true;
        $this->_defaultOrderBy = 'position';

        $this->bootstrap = true;

        parent::__construct();

        $this->displayInformations = $this->trans('Some option may be available after saving post', [], 'Modules.Chatgptcontentgenerator.Admin');

        $this->bulk_actions = [
            'delete' => [
                'text' => $this->trans('Delete selected', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'icon' => 'icon-trash',
                'confirm' => $this->trans('Delete selected items?', [], 'Modules.Chatgptcontentgenerator.Admin'),
            ],
        ];

        $this->fields_list = [
            $this->identifier => [
                'title' => $this->trans('ID', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'align' => 'center',
                'width' => 30,
            ],
            'name' => [
                'title' => $this->trans('Name', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'width' => 'auto',
            ],
            'description' => [
                'title' => $this->trans('Description', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'width' => 500,
                'orderby' => false,
                'callback' => 'getDescriptionClean',
            ],
            'subcategories' => [
                'title' => $this->trans('Subcategories', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'width' => 500,
                'orderby' => false,
                'search' => false,
                'filter_key' => 'a!' . GptContentBlogCategory::$definition['primary'],
                'callback' => 'getCountSubcategories',
            ],
            'position' => [
                'title' => $this->trans('Position', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'filter_key' => 'a!position',
                'align' => 'center',
                'class' => 'fixed-width-sm',
                'position' => 'position',
            ],
        ];
    }

    public function getDescriptionClean($description)
    {
        return Tools::getDescriptionClean($description);
    }

    public function getCountSubcategories($id)
    {
        return count(GptContentBlogCategory::getChildren($id, $this->context->language->id));
    }

    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);

        Media::addJsDef([
            'PS_ALLOW_ACCENTED_CHARS_URL' => false,
            'ps_force_friendly_product' => false,
        ]);

        $this->addJS(_MODULE_DIR_ . $this->module->name . '/views/js/admin.category.js');
        $this->addCss(_PS_MODULE_DIR_ . $this->module->name . '/views/css/admin.category.css');
    }

    public function init()
    {
        parent::init();

        if (
            ($id_gptcontent_blog_category = Tools::getvalue('id_gptcontent_blog_category'))
            && $this->action != 'select_delete'
        ) {
            $this->_category = new GptContentBlogCategory($id_gptcontent_blog_category);
        } else {
            $this->_category = GptContentBlogCategory::getRootCategory();
        }

        $this->original_filter = $this->_filter .= ' AND `id_parent` = ' . (int) $this->_category->id . ' ';

        if (GptContentBlogCategory::getIdTopCategory() == $this->_category->id) {
            Tools::redirectAdmin(self::$currentIndex . '&token=' . Tools::getAdminTokenLite('AdminChatGtpContentBlogCategory'));
        }
    }

    public function initToolbar()
    {
        parent::initToolbar();

        if ('view' == $this->display) {
            $this->toolbar_btn['new'] = [
                'href' => self::$currentIndex . '&add' . $this->table . '&token=' . $this->token,
                'desc' => $this->trans('Add new', [], 'Admin.Actions'),
            ];
        }
    }

    public function renderList()
    {
        $shopInfo = $this->module->getShopInfo();
        if (!$shopInfo || empty($shopInfo['subscription'])) {
            return $this->module->getSubscriptionAlertMesssage(
                $this->trans('<b>Attention!</b><br>
                    Please order subscription plan!',
                    [],
                    'Modules.Chatgptcontentgenerator.Admin'
                )
            );
        }

        if (
            !Validate::isLoadedObject($this->_category)
            || (
                $this->_category->id != GptContentBlogCategory::getIdRootCategory()
                && count(GptContentBlogCategory::getChildren($this->_category->id, $this->context->language->id, false)) < 1
            )
        ) {
            Tools::redirectAdmin(self::$currentIndex . '&token=' . Tools::getAdminTokenLite('AdminChatGtpContentBlogCategory')
                . '&id_gptcontent_blog_category=' . (int) $this->_category->id_parent);
        }

        if (isset($this->_filter) && trim($this->_filter) == '') {
            $this->_filter = $this->original_filter;
        }

        $this->addRowAction('view');
        $this->addRowAction('add');
        $this->addRowAction('edit');
        $this->addRowAction('delete');

        $categories_tree = $this->_category->getParentsCategories();

        if (
            empty($categories_tree)
            && (
                $this->_category->id != GptContentBlogCategory::getIdTopCategory()
                || Tools::isSubmit('id_gptcontent_blog_category')
            )
        ) {
            $categories_tree = [
                [
                    'name' => $this->_category->name[$this->context->language->id],
                ],
            ];
        }

        $categories_tree = array_reverse($categories_tree);

        $this->tpl_list_vars['categories_tree'] = $categories_tree;
        $this->tpl_list_vars['categories_tree_current_id'] = $this->_category->id;

        return parent::renderList();
    }

    public function getList($id_lang, $order_by = null, $order_way = null, $start = 0, $limit = null, $id_lang_shop = false)
    {
        parent::getList($id_lang, $order_by, $order_way, $start, $limit, $id_lang_shop);
        // Check each row to see if there are combinations and get the correct action in consequence

        $nb_items = count($this->_list);
        for ($i = 0; $i < $nb_items; ++$i) {
            $item = &$this->_list[$i];
            $category_tree = GptContentBlogCategory::getChildren((int) $item['id_gptcontent_blog_category'], $this->context->language->id, false);

            if (!count($category_tree)) {
                $this->addRowActionSkipList('view', [$item['id_gptcontent_blog_category']]);
            }
        }
    }

    public function renderView()
    {
        return $this->renderList();
    }

    public function renderForm()
    {
        if (!$obj = $this->loadObject(true)) {
            return;
        }

        $this->fields_form = [
            'legend' => [
                'title' => $this->trans('Category', [], 'Admin.Global'),
            ],
            'input' => [
                [
                    'type' => 'text',
                    'label' => $this->trans('Name:', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'name' => 'name',
                    'required' => true,
                    'lang' => true,
                    'class' => 'copy2friendlyUrl',
                ],
                [
                    'type' => 'categories',
                    'label' => $this->trans('Parent Category:', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'name' => 'id_parent',
                    'required' => true,
                    'tree' => [
                        'id' => 'categories-tree',
                        'selected_categories' => [$this->object->id_parent],
                        'root_category' => GptContentBlogCategory::getIdRootCategory(),
                        'set_data' => GptContentBlogCategory::getCategoriesWithChildrens(),
                        'disabled_categories' => [$this->object->id],
                    ],
                ],
                [
                    'type' => 'textarea',
                    'label' => $this->trans('Description:', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'name' => 'description',
                    'lang' => true,
                    'rows' => 15,
                    'cols' => 40,
                    'autoload_rte' => true,
                    'hint' => $this->trans('Invalid characters:', [], 'Admin.Global') . ' <>;=#{}',
                ],
                [
                    'type' => 'text',
                    'label' => $this->trans('Meta title:', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'name' => 'meta_title',
                    'lang' => true,
                    'rows' => 5,
                    'cols' => 100,
                    'hint' => $this->trans('Forbidden characters:', [], 'Admin.Global') . ' <>;=#{}',
                ],
                [
                    'type' => 'text',
                    'label' => $this->trans('Meta description:', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'name' => 'meta_description',
                    'lang' => true,
                    'rows' => 5,
                    'cols' => 100,
                    'hint' => $this->trans('Forbidden characters:', [], 'Admin.Global') . ' <>;=#{}',
                ],
                [
                    'type' => 'text',
                    'label' => $this->trans('Meta keywords:', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'name' => 'meta_keywords',
                    'lang' => true,
                    'hint' => $this->trans('Forbidden characters:', [], 'Admin.Global') . ' <>;=#{}',
                ],
                [
                    'type' => 'text',
                    'label' => $this->trans('Friendly URL:', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'name' => 'link_rewrite',
                    'required' => true,
                    'lang' => true,
                    'suffix' => implode('', ['<', 'a ', 'href="#" ', 'class', '="generate-link-rewrite"', '>', '<i ', 'class', '="icon-refresh"', '>', '<', '/', 'i>', '<', '/', 'a', '>']),
                    'desc' => $this->trans(
                        'Click on %icon% to generate the friendly url based on category title',
                        [
                            '%icon%' => '"icon-refresh"',
                        ],
                        'Modules.Chatgptcontentgenerator.Admin'
                    ),
                ],
            ],
            'submit' => [
                'title' => $this->trans('Save', [], 'Admin.Global'),
            ],
        ];

        return parent::renderForm();
    }

    public function postProcess()
    {
        $res = parent::postProcess();

        if (
            $this->isSubmit()
            && $res
            && !$this->errors
        ) {
            Tools::redirectAdmin(self::$currentIndex . '&token=' . Tools::getAdminTokenLite('AdminChatGtpContentBlogCategory')
                . '&id_gptcontent_blog_category=' . (int) $this->object->id_parent);
        }

        return $res;
    }

    private function isSubmit()
    {
        return Tools::isSubmit('submit' . $this->table) || Tools::isSubmit('submitAdd' . $this->table);
    }

    public function ajaxProcessUpdatePositions()
    {
        $way = (bool) Tools::getValue('way');
        $id = (int) Tools::getValue('id');
        $positions = Tools::getValue($this->table);

        foreach ($positions as $position => $value) {
            $pos = explode('_', $value);

            if (isset($pos[2]) && (int) $pos[2] === $id) {
                $gptContentBlogCategory = new GptContentBlogCategory((int) $pos[2]);
                if (Validate::isLoadedObject($gptContentBlogCategory)) {
                    if (isset($position) && $gptContentBlogCategory->updatePosition($way, $position)) {
                        echo 'ok position ' . (int) $position . ' for category ' . (int) $pos[1] . '\r\n';
                    } else {
                        echo '{"hasError" : true, "errors" : "Can not update category ' . (int) $id . ' to position ' . (int) $position . ' "}';
                    }
                } else {
                    echo '{"hasError" : true, "errors" : "This category (' . (int) $id . ') can t be loaded"}';
                }

                break;
            }
        }
    }
}
