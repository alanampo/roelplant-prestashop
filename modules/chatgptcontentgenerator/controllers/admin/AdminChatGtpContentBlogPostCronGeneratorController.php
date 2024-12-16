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

use PrestaShop\Module\Chatgptcontentgenerator\Controllers\Admin\Traits\ShortCodeTrait;
use PrestaShop\Module\Chatgptcontentgenerator\Entity\GptContentPostCron;
use PrestaShop\Module\Chatgptcontentgenerator\Entity\GptContentTemplate;

class AdminChatGtpContentBlogPostCronGeneratorController extends ModuleAdminController
{
    use ShortCodeTrait;

    public function __construct()
    {
        $this->table = GptContentPostCron::$definition['table'];
        $this->className = GptContentPostCron::class;
        $this->identifier = GptContentPostCron::$definition['primary'];
        $this->identifier_name = $this->identifier;
        $this->list_no_link = true;
        $this->lang = true;
        $this->_defaultOrderBy = $this->identifier;
        $this->bootstrap = true;

        $this->addRowAction('edit');
        $this->addRowAction('delete');

        parent::__construct();

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
                'class' => 'fixed-width-xs',
            ],
            'name' => [
                'title' => $this->trans('Name', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'width' => 'auto',
            ],
            'period' => [
                'title' => $this->trans('Period', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'type' => 'select',
                'list' => GptContentPostCron::getPeriods(),
                'filter_key' => 'a!period',
                'order_key' => 'a!period',
                'class' => 'fixed-width-lg',
            ],
            'type' => [
                'title' => $this->trans('Type', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'type' => 'select',
                'list' => GptContentPostCron::getTypes(),
                'filter_key' => 'a!type',
                'order_key' => 'a!type',
                'class' => 'fixed-width-lg',
            ],
            'active' => [
                'title' => $this->trans('Status', [], 'Admin.Global'),
                'type' => 'bool',
                'active' => 'status',
                'class' => 'text-center',
            ],
        ];
    }

    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);

        $this->addCss(_PS_MODULE_DIR_ . $this->module->name . '/views/css/admin.template.css');
        $this->addJS(_PS_MODULE_DIR_ . $this->module->name . '/views/js/admin.post.cron.js');

        Media::addJsDef([
            'textLanguagesPompt' => $this->trans('Used languages', [], 'Modules.Chatgptcontentgenerator.Admin'),
        ]);
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

    public function renderForm()
    {
        $this->prepareShortCode('short_code_title');
        $this->prepareShortCode('short_code_content');

        $this->fields_form = [
            'legend' => [
                'title' => $this->trans('Posts cron generator', [], 'Admin.Global'),
            ],
            'input' => [
                [
                    'type' => 'switch',
                    'label' => $this->trans('Enabled', [], 'Admin.Global'),
                    'name' => 'active',
                    'required' => false,
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->trans('Yes', [], 'Admin.Global'),
                        ],
                        [
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->trans('No', [], 'Admin.Global'),
                        ],
                    ],
                ],
                [
                    'type' => 'text',
                    'label' => $this->trans('Name:', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'name' => 'name',
                    'required' => true,
                    'class' => 'copy2friendlyUrl',
                ],
                [
                    'type' => 'categories',
                    'label' => $this->trans('Categories:', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'name' => 'ids_categories',
                    'required' => true,
                    'tree' => [
                        'id' => 'categories-tree',
                        'selected_categories' => $this->object->getCategories(),
                        'root_category' => $this->context->shop->getCategory(),
                        'use_checkbox' => true,
                    ],
                    'desc' => $this->trans(
                        'Posts will be generated for products that belong to the selected categories.',
                        [],
                        'Modules.Chatgptcontentgenerator.Admin'
                    ),
                ],
                [
                    'type' => 'text',
                    'label' => $this->trans('Maximum number of words for content', [], 'Modules.Chatgptcontentgenerator.Admin') . ':',
                    'name' => 'length_content',
                    'class' => 'fixed-width-sm',
                    'required' => true,
                ],
                [
                    'type' => 'select',
                    'label' => $this->trans('Period', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'name' => 'period',
                    'class' => 'col-xs-12',
                    'options' => [
                        'query' => GptContentPostCron::getPeriods(true),
                        'id' => 'id',
                        'name' => 'name',
                    ],
                ],
                [
                    'type' => 'text',
                    'label' => $this->trans('Quantity of post for a period', [], 'Modules.Chatgptcontentgenerator.Admin') . ':',
                    'name' => 'quantity',
                    'class' => 'fixed-width-sm',
                    'required' => true,
                ],
                [
                    'type' => 'select',
                    'label' => $this->trans('Type', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'name' => 'type',
                    'class' => 'col-xs-12',
                    'options' => [
                        'query' => GptContentPostCron::getTypes(true),
                        'id' => 'id',
                        'name' => 'name',
                    ],
                ],
                [
                    'type' => 'textarea',
                    'label' => $this->trans('Request to ChatGPT (title)', [], 'Modules.Chatgptcontentgenerator.Admin') . ':',
                    'name' => 'short_code_title',
                    'form_group_class' => 'prompt-short-code',
                    'lang' => true,
                    'rows' => 5,
                    'cols' => 40,
                    'hint' => $this->trans(
                        'Example: Write a post title for product {product_name} with no more than 70 words',
                        [],
                        'Modules.Chatgptcontentgenerator.Admin'
                    ),
                    'desc' => $this->getProductShortCodeDesc(),
                ],
                [
                    'type' => 'textarea',
                    'label' => $this->trans('Request to ChatGPT (content)', [], 'Modules.Chatgptcontentgenerator.Admin') . ':',
                    'name' => 'short_code_content',
                    'form_group_class' => 'prompt-short-code',
                    'lang' => true,
                    'rows' => 5,
                    'cols' => 40,
                    'hint' => $this->trans(
                        'Example: Write a detailed post for product {product_name} with no more than 400 words',
                        [],
                        'Modules.Chatgptcontentgenerator.Admin'
                    ),
                    'desc' => $this->getProductShortCodeDesc(),
                ],
                [
                    'type' => 'switch',
                    'label' => $this->trans('Post status', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'name' => 'active_post',
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->trans('Yes', [], 'Admin.Global'),
                        ],
                        [
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->trans('No', [], 'Admin.Global'),
                        ],
                    ],
                ],
                [
                    'type' => 'switch',
                    'label' => $this->trans('Use product images', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'name' => 'use_produt_image',
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->trans('Yes', [], 'Admin.Global'),
                        ],
                        [
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->trans('No', [], 'Admin.Global'),
                        ],
                    ],
                ],
                [
                    'type' => 'text',
                    'label' => $this->trans('Maximum number of links product for content', [], 'Modules.Chatgptcontentgenerator.Admin') . ':',
                    'name' => 'number_links_product',
                    'class' => 'fixed-width-sm',
                    'required' => false,
                    'desc' => $this->trans(
                        'Their presence in the content depends on GPT.',
                        [],
                        'Modules.Chatgptcontentgenerator.Admin'
                    ),
                ],
            ],
            'submit' => [
                'title' => $this->trans('Save', [], 'Admin.Global'),
            ],
        ];

        if (Validate::isLoadedObject($this->object)) {
            $this->fields_form['input'][] = [
                'type' => 'text',
                'label' => $this->trans('Link for cron', [], 'Modules.Chatgptcontentgenerator.Admin') . ':',
                'name' => 'cron_link',
                'disabled' => true,
            ];

            $this->fields_value['cron_link'] = $this->context->link->getModuleLink($this->module->name, 'cron')
                . '?token=' . GptContentPostCron::getCronTokenById($this->object->id) . '&id=' . (int) $this->object->id;
        }

        return parent::renderForm();
    }

    public function postProcess()
    {
        if ($this->isSubmit()) {
            if (!$categories = Tools::getValue('ids_categories', [])) {
                $this->errors[] = $this->trans(
                    'Please select categories.',
                    [],
                    'Modules.Chatgptcontentgenerator.Admin'
                );
            }
        }

        $res = parent::postProcess();

        if (
            $this->isSubmit()
            && !$this->errors
        ) {
            $this->object->deleteCategories();
            $this->object->addToCategories($categories);
        }

        return $res;
    }

    protected function prepareShortCode($type)
    {
        $newShortCodes = null;
        $shortCodes = $this->object->{$type};

        if ($shortCodes) {
            $id_lang = (int) $this->context->language->id;
            if (is_array($shortCodes)) {
                foreach ($shortCodes as $key => $short_code) {
                    $newShortCodes[$key] = GptContentTemplate::prepareDisplayShortCode($id_lang, $short_code);
                }
            } else {
                $newShortCodes = GptContentTemplate::prepareDisplayShortCode($id_lang, $shortCodes);
            }
        }

        if ($newShortCodes) {
            $this->object->{$type} = $newShortCodes;
        }
    }

    protected function copyFromPost(&$object, $table)
    {
        parent::copyFromPost($object, $table);

        if ($this->isSubmit()) {
            if (is_array($object->short_code_title)) {
                foreach ($object->short_code_title as $id_lang => &$shortCode) {
                    if ($shortCode) {
                        $shortCode = GptContentTemplate::prepareSaveShortCode($id_lang, $shortCode);
                    }
                }
            }

            if (is_array($object->short_code_content)) {
                foreach ($object->short_code_content as $id_lang => &$shortCode) {
                    if ($shortCode) {
                        $shortCode = GptContentTemplate::prepareSaveShortCode($id_lang, $shortCode);
                    }
                }
            }
        }
    }

    private function isSubmit()
    {
        return Tools::isSubmit('submit' . $this->table) || Tools::isSubmit('submitAdd' . $this->table);
    }
}
