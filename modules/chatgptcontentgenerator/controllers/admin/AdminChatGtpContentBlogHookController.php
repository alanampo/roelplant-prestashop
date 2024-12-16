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

use PrestaShop\Module\Chatgptcontentgenerator\Entity\GptContentBlogHook;

class AdminChatGtpContentBlogHookController extends ModuleAdminController
{
    public function __construct()
    {
        $this->table = GptContentBlogHook::$definition['table'];
        $this->className = GptContentBlogHook::class;
        $this->identifier = GptContentBlogHook::$definition['primary'];
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

        $hooks = [];
        foreach (Hook::getHooks(false, true) as $hook) {
            $hooks[$hook['name']] = $hook['name'];
        }

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
            'hook_name' => [
                'title' => $this->trans('Hook name', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'type' => 'select',
                'list' => $hooks,
                'filter_key' => 'a!hook_name',
                'order_key' => 'a!hook_name',
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
        $this->fields_form = [
            'legend' => [
                'title' => $this->trans('Hook', [], 'Admin.Global'),
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
                    'type' => 'select',
                    'label' => $this->trans('Hook', [], 'Admin.Global'),
                    'name' => 'hook_name',
                    'class' => 'col-xs-12',
                    'options' => [
                        'query' => Hook::getHooks(false, true),
                        'id' => 'name',
                        'name' => 'name',
                    ],
                ],
                [
                    'type' => 'text',
                    'label' => $this->trans('Posts to display', [], 'Modules.Chatgptcontentgenerator.Admin') . ':',
                    'name' => 'quantity',
                    'class' => 'fixed-width-sm',
                    'required' => true,
                    'desc' => $this->trans(
                        'Define the number of posts displayed in this block.',
                        [],
                        'Modules.Chatgptcontentgenerator.Admin'
                    ),
                ],
                [
                    'type' => 'date',
                    'label' => $this->trans('Post publication date (from)', [], 'Modules.Chatgptcontentgenerator.Admin') . ':',
                    'name' => 'date_start',
                ],
                [
                    'type' => 'date',
                    'label' => $this->trans('Post publication date (to)', [], 'Modules.Chatgptcontentgenerator.Admin') . ':',
                    'name' => 'date_end',
                ],
                [
                    'type' => 'select',
                    'label' => $this->trans('Sort way', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'name' => 'order_way',
                    'class' => 'col-xs-12',
                    'options' => [
                        'query' => [
                            [
                                'id' => 'DESC',
                                'name' => $this->trans('Newer first', [], 'Admin.Global'),
                            ],
                            [
                                'id' => 'ASC',
                                'name' => $this->trans('Older first', [], 'Admin.Global'),
                            ],
                        ],
                        'id' => 'id',
                        'name' => 'name',
                    ],
                ],
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
            ],
            'submit' => [
                'title' => $this->trans('Save', [], 'Admin.Global'),
            ],
        ];

        return parent::renderForm();
    }

    public function postProcess()
    {
        if (Tools::isSubmit('submitAddgptcontent_blog_hook')) {
            $hookName = Tools::getValue('hook_name');

            if (
                $id_gptcontent_blog_hook = GptContentBlogHook::existHookName(
                    Tools::getValue('hook_name'),
                    Tools::getValue($this->identifier)
                )
            ) {
                $this->errors[] = $this->trans(
                    'The settings for the hook "%hook%" already exist [id = %id%]',
                    [
                        '%hook%' => $hookName,
                        '%id%' => $id_gptcontent_blog_hook,
                    ],
                    'Modules.Chatgptcontentgenerator.Admin'
                );
            }

            if ((int) Tools::getValue('quantity') <= 0) {
                $this->errors[] = $this->trans(
                    'You must fill in the \'Posts displayed\' field.',
                    [],
                    'Modules.Chatgptcontentgenerator.Admin'
                );
            }

            if (!$this->errors) {
                $this->module->registerHook(Tools::getValue('hook_name'));
            }
        }

        return parent::postProcess();
    }
}
