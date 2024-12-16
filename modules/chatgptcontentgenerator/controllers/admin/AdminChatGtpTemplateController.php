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
use PrestaShop\Module\Chatgptcontentgenerator\Entity\GptContentTemplate;

class AdminChatGtpTemplateController extends ModuleAdminController
{
    use ShortCodeTrait;

    public function __construct()
    {
        $this->table = GptContentTemplate::$definition['table'];
        $this->className = 'PrestaShop\Module\Chatgptcontentgenerator\Entity\GptContentTemplate';
        $this->identifier = GptContentTemplate::$definition['primary'];
        $this->bootstrap = true;

        parent::__construct();

        $this->_select .= ' GROUP_CONCAT(DISTINCT lang.iso_code SEPARATOR ", ") AS langs';
        $this->_join .= 'LEFT JOIN `' . _DB_PREFIX_ . bqSQL($this->table) . '_lang` b
            ON (b.`id_content_template` = a.`id_content_template`)
            LEFT JOIN `' . _DB_PREFIX_ . 'lang` AS lang ON (b.`id_lang` = lang.`id_lang`
                AND b.`short_code` IS NOT NULL AND trim(b.`short_code`) <> "")';

        $this->fields_list = [
            'id_content_template' => [
                'title' => $this->trans('ID', [], 'Admin.Global'),
                'search' => false,
            ],
            'name' => [
                'title' => $this->trans('Name', [], 'Admin.Global'),
                'type' => 'text',
                'search' => false,
            ],
            'type' => [
                'title' => $this->trans('Type', [], 'Admin.Global'),
                'type' => 'text',
                'search' => false,
            ],
            'langs' => [
                'title' => $this->trans('Languages', [], 'Admin.Global'),
                'type' => 'text',
                'search' => false,
            ],
            'active' => [
                'title' => $this->trans('Status', [], 'Admin.Global'),
                'type' => 'bool',
                'active' => 'status',
                'class' => 'text-center',
                'search' => false,
            ],
        ];

        $this->_group .= ' GROUP BY a.id_content_template ';
        $this->_orderWay = 'DESC';

        $this->default_form_language = (int) Configuration::get('PS_LANG_DEFAULT');
        $this->allow_employee_form_lang = (int) Configuration::get('PS_LANG_DEFAULT');

        $this->addRowAction('edit');
        $this->addRowAction('delete');
    }

    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);

        $this->addCss(_PS_MODULE_DIR_ . $this->module->name . '/views/css/admin.template.css');
        $this->addJS(_PS_MODULE_DIR_ . $this->module->name . '/views/js/admin.template.js');

        Media::addJsDef([
            'textLanguagesPompt' => $this->trans('Used languages', [], 'Modules.Chatgptcontentgenerator.Admin'),
        ]);
    }

    public function renderForm()
    {
        // Create Form
        $this->getConfigForm();

        $this->prepareShortCode();

        // Settings Form
        $this->multiple_fieldsets = true;
        $this->default_form_language = (int) Configuration::get('PS_LANG_DEFAULT');
        $this->show_form_cancel_button = false;

        $this->submit_action = 'submit' . $this->module->name;

        return parent::renderForm();
    }

    private function getConfigForm(): void
    {
        $types = [];
        $type = '';

        if (Tools::isSubmit('id_content_template')) {
            $gptContentTemplate = new GptContentTemplate((int) Tools::getValue('id_content_template'));

            $type = $gptContentTemplate->getType();
            $typeName = GptContentTemplate::TYPE[$type];

            $types[] = [
                'id' => $type,
                'name' => $typeName,
            ];

            $heading_name = $this->trans('Edit Template', [], 'Modules.Chatgptcontentgenerator.Admin') . ' (' . $typeName . ')';
        } else {
            $heading_name = $this->trans('Add Template', [], 'Modules.Chatgptcontentgenerator.Admin');

            foreach (GptContentTemplate::TYPE as $typeId => $typeName) {
                $types[] = [
                    'id' => $typeId,
                    'name' => $typeName,
                ];
            }
        }

        $this->fields_form['general']['form'] = [
            'legend' => [
                'title' => $heading_name,
                'icon' => 'icon-cog',
            ],
            'input' => [
                [
                    'type' => 'switch',
                    'label' => $this->trans('Status', [], 'Admin.Global'),
                    'name' => 'active',
                    'is_bool' => true,
                    'required' => true,
                    'values' => [
                        [
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->trans('Enabled', [], 'Admin.Global'),
                        ],
                        [
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->trans('Disabled', [], 'Admin.Global'),
                        ],
                    ],
                ],
                [
                    'type' => 'text',
                    'label' => $this->trans('Template name', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'name' => 'name',
                    'required' => true,
                    'empty_message' => 'Please fill the input',
                ],
            ],
        ];

        if (Tools::isSubmit('id_content_template')) {
            $desc = [];

            $this->fields_form['general']['form']['input'][] = [
                'type' => 'hidden',
                'name' => 'type',
            ];

            $requestHint = '';

            switch ($type) {
                case 'product':
                    $desc = $this->getProductShortCodeDesc();
                    $requestHint = $this->trans('Example: Write a detailed description for product {product_name} with no more than 400 words', [], 'Modules.Chatgptcontentgenerator.Admin');
                    break;
                case 'category':
                    $desc = $this->getCategoryShortCodeDesc();
                    $requestHint = $this->trans('Example: Write a detailed description for category {category_name} with no more than 400 words', [], 'Modules.Chatgptcontentgenerator.Admin');
                    break;
                case 'cms':
                    $desc = $this->getPageShortCodeDesc();
                    $requestHint = $this->trans('Example: Write a detailed content for page {page_name} with no more than 400 words', [], 'Modules.Chatgptcontentgenerator.Admin');
                    break;
            }

            $this->fields_form['general']['form']['input'][] = [
                'type' => 'textarea',
                'label' => $this->trans('Request to ChatGPT', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'name' => 'short_code',
                'form_group_class' => 'prompt-short-codes',
                'required' => true,
                'hint' => $requestHint,
                'lang' => true,
                'desc' => $desc,
            ];
        } else {
            $this->fields_form['general']['form']['input'][] = [
                'type' => 'select',
                'label' => $this->trans('Template type', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'name' => 'type',
                'required' => true,
                'options' => [
                    'query' => $types,
                    'id' => 'id',
                    'name' => 'name',
                ],
            ];
        }

        $this->fields_form['general']['form']['submit'] = [
            'title' => $this->trans('Save', [], 'Admin.Global'),
            'class' => 'btn btn-default pull-right',
            'name' => 'submitAdd' . $this->table,
            'stay' => Tools::isSubmit('id_content_template') ? false : true,
        ];

        $this->fields_form['general']['form']['buttons'] = [
            'labels-list' => [
                'title' => $this->trans('Cancel', [], 'Admin.Global'),
                'name' => 'submitAdd' . $this->table . 'AndStay',
                'href' => $this->context->link->getAdminLink('AdminChatGtpTemplate'),
                'icon' => 'process-icon-cancel',
            ],
        ];
    }

    private function prepareShortCode()
    {
        $newShortCodes = null;
        $shortCodes = $this->object->getShortCode();

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
            $this->object->setShortCode($newShortCodes);
        }
    }

    /**
     * Copy data values from $_POST to object.
     *
     * @param ObjectModel &$object Object
     * @param string $table Object table
     */
    protected function copyFromPost(&$object, $table)
    {
        parent::copyFromPost($object, $table);

        if (
            Tools::isSubmit('submit' . $this->module->name)
            && 'product' === Tools::getValue('type')
            && is_array($object->short_code)
        ) {
            foreach ($object->short_code as $id_lang => &$shortCode) {
                if ($shortCode) {
                    $shortCode = GptContentTemplate::prepareSaveShortCode($id_lang, $shortCode);
                }
            }
        }
    }

    public function initContent()
    {
        if ($this->display === null && !$this->ajax) {
            $configuration['configure'] = 'chatgptcontentgenerator';

            if ($page = (int) Tools::getValue('submitFiltercontent_template')) {
                $configuration['submitFiltercontent_template'] = $page;
            }

            if ($pagination = (int) Tools::getValue('content_template_pagination')) {
                $configuration['content_template_pagination'] = $pagination;
            }

            Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true, [], $configuration));
        }

        parent::initContent();
    }
}
