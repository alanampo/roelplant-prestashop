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

use Chatgptcontentgenerator\ProductReviews\Models\GptcontentReview;
use PrestaShop\Module\Chatgptcontentgenerator\ComponentManager;

class AdminChatGtpReviewsController extends ModuleAdminController
{
    private $component;

    public function __construct()
    {
        $this->table = GptcontentReview::$definition['table'];
        $this->className = GptcontentReview::class;
        $this->identifier = GptcontentReview::$definition['primary'];
        $this->identifier_name = $this->identifier;
        $this->list_no_link = true;
        $this->lang = false;
        $this->explicitSelect = true;

        $this->bootstrap = true;

        $this->addRowAction('edit');
        $this->addRowAction('delete');

        parent::__construct();

        $this->component = ComponentManager::getInstanceByName('productreviews')
            ->setController($this)
            ->setModule($this->module);

        $this->bulk_actions = [
            'delete' => [
                'text' => $this->trans('Delete selected', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'confirm' => $this->trans('Delete selected items?', [], 'Modules.Chatgptcontentgenerator.Admin'),
            ],
            'enableSelection' => ['text' => $this->trans('Enable selection', [], 'Modules.Chatgptcontentgenerator.Admin')],
            'disableSelection' => ['text' => $this->trans('Disable selection', [], 'Modules.Chatgptcontentgenerator.Admin')],
        ];

        $this->fields_list = [
            $this->identifier => [
                'title' => $this->trans('ID', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'align' => 'center',
                'width' => 30,
            ],
            'product_name' => [
                'title' => $this->trans('Product', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'width' => 'auto',
                'filter_key' => 'pl!name',
            ],
            'author' => [
                'title' => $this->trans('Author', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'width' => 'auto',
                'filter_key' => 'a!author',
            ],
            'active' => [
                'title' => $this->trans('Enabled', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'width' => 25,
                'active' => 'status',
                'align' => 'center',
                'type' => 'bool',
                'orderby' => false,
                'filter_key' => 'a!active',
            ],
            'rate' => [
                'title' => $this->trans('Rate', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'width' => 'auto',
                'filter_key' => 'a!rate',
                'type' => 'select',
                'list' => [
                    1 => 1,
                    2 => 2,
                    3 => 3,
                    4 => 4,
                    5 => 5,
                ],
                'callback' => 'printRate',
            ],
            'description' => [
                'title' => $this->trans('Content', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'filter_key' => 'a!description',
                'callback' => 'printReviewContent',
            ],
            'public_date' => [
                'title' => $this->trans('Date', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'type' => 'date',
                'filter_key' => 'a!public_date',
            ],
        ];

        $this->_join .= ' LEFT JOIN ' . _DB_PREFIX_ . 'product AS p ON (a.id_product = p.id_product)';
        $this->_join .= ' LEFT JOIN ' . _DB_PREFIX_ . 'product_lang AS pl ON
            (pl.id_product = p.id_product AND pl.id_lang = ' . (int) $this->context->language->id . '
                AND pl.id_shop = ' . (int) $this->context->shop->id . ')';
    }

    public function renderForm()
    {
        $this->fields_value['public_date'] = date('Y-m-d', strtotime($this->object->public_date));

        $this->fields_form = [
            'legend' => [
                'title' => $this->trans('Review', [], 'Modules.Chatgptcontentgenerator.Admin'),
                'icon' => 'icon-chat',
            ],
            'input' => [
                [
                    'type' => 'textarea',
                    'label' => $this->trans('Content', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'name' => 'description',
                    'required' => true,
                    'rows' => 7,
                ],
                [
                    'type' => 'select',
                    'label' => $this->trans('Rate', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'name' => 'rate',
                    'required' => true,
                    'options' => [
                        'query' => [
                            [
                                'id' => 1,
                                'name' => '1 - negative',
                            ],
                            [
                                'id' => 2,
                                'name' => '2 - negative',
                            ],
                            [
                                'id' => 3,
                                'name' => '3 - neutral',
                            ],
                            [
                                'id' => 4,
                                'name' => '4 - good',
                            ],
                            [
                                'id' => 5,
                                'name' => '5 - excellent',
                            ],
                        ],
                        'id' => 'id',
                        'name' => 'name',
                    ],
                ],
                [
                    'type' => 'text',
                    'label' => $this->trans('Author', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'name' => 'author',
                ],
                [
                    'type' => 'switch',
                    'label' => $this->trans('Enabled', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'name' => 'active',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->trans('Yes', [], 'Modules.Chatgptcontentgenerator.Admin'),
                        ],
                        [
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->trans('No', [], 'Modules.Chatgptcontentgenerator.Admin'),
                        ],
                    ],
                ],
                [
                    'type' => 'date',
                    'label' => $this->trans('Date', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'name' => 'public_date',
                    'required' => true,
                ],
            ],
            'submit' => [
                'title' => $this->trans('Save', [], 'Modules.Chatgptcontentgenerator.Admin'),
            ],
        ];
        return parent::renderForm();
    }

    public function initToolbar()
    {
        parent::initToolbar();

        if (isset($this->toolbar_btn['new'])) {
            unset($this->toolbar_btn['new']);
        }
    }

    public function printRate($value)
    {
        return (int) $value;
    }

    public function printReviewContent($value)
    {
        return strip_tags($value);
    }

    public function viewAccess($disable = false)
    {
        return $this->component->isActive();
    }
}
