<?php
/*
 * 2007-2024 PayPal
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
 *  versions in the future. If you wish to customize PrestaShop for your
 *  needs please refer to http://www.prestashop.com for more information.
 *
 *  @author 2007-2024 PayPal
 *  @author 202 ecommerce <tech@202-ecommerce.com>
 *  @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 *  @copyright PayPal
 *
 */

namespace PaypalAddons\classes\Shortcut;

use Configuration;
use Tools;

if (!defined('_PS_VERSION_')) {
    exit;
}

class ShortcutProduct extends ShortcutAbstract
{
    protected $idProduct;

    protected $idProductAttribute;

    public function __construct($idProduct, $idProductAttribute = null)
    {
        parent::__construct();
        $this->idProduct = $idProduct;
        $this->idProductAttribute = $idProductAttribute;
    }

    protected function getTemplatePath()
    {
        return 'module:paypal/views/templates/shortcut/shortcut-product.tpl';
    }

    protected function getTplVars()
    {
        $environment = ($this->method->isSandbox() ? 'sandbox' : 'live');
        $shop_url = $this->context->link->getBaseLink($this->context->shop->id, true);

        $return = [
            'shop_url' => $shop_url,
            'PayPal_payment_type' => $this->getMethodType(),
            'action_url' => $this->context->link->getModuleLink($this->module->name, 'ScInit', [], true),
            'ec_sc_in_context' => Configuration::get('PAYPAL_EXPRESS_CHECKOUT_IN_CONTEXT'),
            'merchant_id' => Configuration::get('PAYPAL_MERCHANT_ID_' . Tools::strtoupper($environment)),
            'environment' => $environment,
            'es_cs_product_attribute' => $this->idProductAttribute ? $this->idProductAttribute : '',
            'paypalIdProduct' => $this->idProduct,
        ];

        return $return;
    }

    protected function getStyleSetting()
    {
        if (Configuration::get(ShortcutConfiguration::CUSTOMIZE_STYLE)) {
            $styleSetting = [
                'label' => Configuration::get(ShortcutConfiguration::STYLE_LABEL_PRODUCT, null, null, null, ShortcutConfiguration::STYLE_LABEL_BUYNOW),
                'color' => Configuration::get(ShortcutConfiguration::STYLE_COLOR_PRODUCT, null, null, null, ShortcutConfiguration::STYLE_COLOR_GOLD),
                'shape' => Configuration::get(ShortcutConfiguration::STYLE_SHAPE_PRODUCT, null, null, null, ShortcutConfiguration::STYLE_SHAPE_RECT),
                'height' => (int) Configuration::get(ShortcutConfiguration::STYLE_HEIGHT_PRODUCT, null, null, null, 35),
                'width' => (int) Configuration::get(ShortcutConfiguration::STYLE_WIDTH_PRODUCT, null, null, null, 200),
            ];
        } else {
            $styleSetting = [
                'label' => ShortcutConfiguration::STYLE_LABEL_BUYNOW,
                'color' => ShortcutConfiguration::STYLE_COLOR_GOLD,
                'shape' => ShortcutConfiguration::STYLE_SHAPE_RECT,
                'height' => 35,
                'width' => 200,
            ];
        }

        return $styleSetting;
    }
}
