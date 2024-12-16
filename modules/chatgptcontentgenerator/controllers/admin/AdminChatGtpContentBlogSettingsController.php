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

class AdminChatGtpContentBlogSettingsController extends ModuleAdminController
{
    public function __construct()
    {
        parent::__construct();

        $this->bootstrap = true;

        $this->initOptions();
    }

    public function initOptions()
    {
        $shopInfo = $this->module->getShopInfo();
        if (!$shopInfo || empty($shopInfo['subscription'])) {
            return parent::renderOptions();
        }

        $this->optionTitle = $this->trans('Settings', [], 'Modules.Chatgptcontentgenerator.Admin');

        $pre_settings_content = '';

        $standard_options = [
            'general' => [
                'title' => $this->trans('ChatGPT blog settings', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'image' => '../img/t/AdminOrderPreferences.gif',
                'info' => $pre_settings_content,
                'fields' => [
                    'CHATGPTCONTENTGENERATOR_BLOG_POSTS_PER_PAGE' => [
                        'title' => $this->trans('Number of posts on the page:', [], 'Modules.Chatgptcontentgenerator.Admin'),
                        'cast' => 'intval',
                        'desc' => $this->trans('Posts are displayed in 3 columns. The default value is 9.', [], 'Modules.Chatgptcontentgenerator.Admin'),
                        'type' => 'text',
                        'required' => true,
                        'validation' => 'isUnsignedId',
                    ],
                    'CHATGPTCONTENTGENERATOR_BLOG_MAIN_TITLE' => [
                        'title' => $this->trans('Title of the blog:', [], 'Modules.Chatgptcontentgenerator.Admin'),
                        'validation' => 'isGenericName',
                        'type' => 'textLang',
                        'size' => 40,
                    ],
                ],
                'submit' => ['title' => $this->trans('Update', [], 'Modules.Chatgptcontentgenerator.Admin'), 'class' => 'button'],
            ],
            'single_post' => [
                'submit' => ['title' => $this->trans('Update', [], 'Modules.Chatgptcontentgenerator.Admin'), 'class' => 'button'],
                'title' => $this->trans('Visual settings of a single post', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'image' => '../img/t/AdminOrderPreferences.gif',
                'fields' => [
                    'CHATGPTCONTENTGENERATOR_BLOG_DISPLAY_DATE' => [
                        'title' => $this->trans('Enable post-creation date:', [], 'Modules.Chatgptcontentgenerator.Admin'),
                        'validation' => 'isBool',
                        'cast' => 'intval',
                        'required' => true,
                        'type' => 'bool',
                    ],
                    'CHATGPTCONTENTGENERATOR_BLOG_DISPLAY_FEATURED' => [
                        'title' => $this->trans('Enable post thumbnail image:', [], 'Modules.Chatgptcontentgenerator.Admin'),
                        'validation' => 'isBool',
                        'cast' => 'intval',
                        'required' => true,
                        'type' => 'bool',
                    ],
                    'CHATGPTCONTENTGENERATOR_BLOG_DISPLAY_RELATED' => [
                        'title' => $this->trans('Enable related products:', [], 'Modules.Chatgptcontentgenerator.Admin'),
                        'validation' => 'isBool',
                        'cast' => 'intval',
                        'required' => true,
                        'type' => 'bool',
                    ],
                ],
            ],
            'category_page' => [
                'submit' => ['title' => $this->trans('Update', [], 'Modules.Chatgptcontentgenerator.Admin'), 'class' => 'button'],
                'title' => $this->trans('Visual settings of posts list', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'image' => '../img/t/AdminOrderPreferences.gif',
                'fields' => [
                    'CHATGPTCONTENTGENERATOR_BLOG_DISPLAY_THUMBNAIL' => [
                        'title' => $this->trans('Enable posts thumbnails:', [], 'Modules.Chatgptcontentgenerator.Admin'),
                        'validation' => 'isBool',
                        'cast' => 'intval',
                        'required' => true,
                        'type' => 'bool',
                    ],
                    'CHATGPTCONTENTGENERATOR_BLOG_DISPLAY_DESCRIPTION' => [
                        'title' => $this->trans('Enable short descriptions for posts:', [], 'Modules.Chatgptcontentgenerator.Admin'),
                        'validation' => 'isBool',
                        'cast' => 'intval',
                        'required' => true,
                        'type' => 'bool',
                    ],
                ],
            ],
            'product_page' => [
                'submit' => ['title' => $this->trans('Update', [], 'Modules.Chatgptcontentgenerator.Admin'), 'class' => 'button'],
                'title' => $this->trans('Visual settings of the product page', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'image' => '../img/t/AdminOrderPreferences.gif',
                'fields' => [
                    'CHATGPTCONTENTGENERATOR_BLOG_DISPLAY_POST_ON_PRODUCT_PAGE' => [
                        'title' => $this->trans('Enable assigned posts:', [], 'Modules.Chatgptcontentgenerator.Admin'),
                        'validation' => 'isBool',
                        'cast' => 'intval',
                        'required' => true,
                        'type' => 'bool',
                    ],
                ],
            ],
            'category_list' => [
                'submit' => ['title' => $this->trans('Update', [], 'Modules.Chatgptcontentgenerator.Admin'), 'class' => 'button'],
                'title' => $this->trans('Visual settings of the blog category tree', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'image' => '../img/t/AdminOrderPreferences.gif',
                'fields' => [
                    'CHATGPTCONTENTGENERATOR_BLOG_DISPLAY_CATEGORY_TREE' => [
                        'title' => $this->trans('Enable blog category tree:', [], 'Modules.Chatgptcontentgenerator.Admin'),
                        'validation' => 'isBool',
                        'cast' => 'intval',
                        'required' => true,
                        'type' => 'bool',
                    ],
                    'CHATGPTCONTENTGENERATOR_BLOG_DISPLAY_CATEGORY_TREE_DEPTH' => [
                        'title' => $this->trans('Maximum depth:', [], 'Modules.Chatgptcontentgenerator.Admin'),
                        'cast' => 'intval',
                        'desc' => $this->trans(
                            'Set the maximum depth of category sublevels displayed in this block (0 = infinite).',
                            [],
                            'Modules.Chatgptcontentgenerator.Admin'
                        ),
                        'type' => 'text',
                        'required' => true,
                        'validation' => 'isUnsignedId',
                    ],
                ],
            ],
            'thumbnails' => [
                'submit' => ['title' => $this->trans('Update', [], 'Modules.Chatgptcontentgenerator.Admin'), 'class' => 'button'],
                'title' => $this->trans('Settings of thumbnails', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'image' => '../img/t/AdminOrderPreferences.gif',
                'fields' => [
                    'CHATGPTCONTENTGENERATOR_BLOG_THUMB_X' => [
                        'title' => $this->trans('Default width (px):', [], 'Modules.Chatgptcontentgenerator.Admin'),
                        'cast' => 'intval',
                        'desc' => $this->trans('Default: 600', [], 'Modules.Chatgptcontentgenerator.Admin'),
                        'type' => 'text',
                        'required' => true,
                        'validation' => 'isUnsignedId',
                    ],
                    'CHATGPTCONTENTGENERATOR_BLOG_THUMB_Y' => [
                        'title' => $this->trans('Default height (px):', [], 'Modules.Chatgptcontentgenerator.Admin'),
                        'cast' => 'intval',
                        'desc' => $this->trans('Default: 300', [], 'Modules.Chatgptcontentgenerator.Admin'),
                        'type' => 'text',
                        'required' => true,
                        'validation' => 'isUnsignedId',
                    ],
                ],
            ],
        ];

        $this->fields_options = $standard_options;

        return parent::renderOptions();
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

        return parent::renderList();
    }

    public static function prepareValueForLangs($value)
    {
        $languages = Language::getLanguages(false);

        $output = [];

        foreach ($languages as $lang) {
            $output[$lang['id_lang']] = $value;
        }

        return $output;
    }

    public static function getValueForLangs($field)
    {
        $languages = Language::getLanguages(false);

        $output = [];

        foreach ($languages as $lang) {
            $output[$lang['id_lang']] = Configuration::get($field, $lang['id_lang']);
        }

        return $output;
    }

    public function initContent()
    {
        $this->multiple_fieldsets = true;

        $this->context->smarty->assign([
            'content' => $this->content,
            'url_post' => self::$currentIndex . '&token=' . $this->token,
        ]);

        parent::initContent();
    }
}
