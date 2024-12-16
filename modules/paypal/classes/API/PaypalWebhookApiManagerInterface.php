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

namespace PaypalAddons\classes\API;

if (!defined('_PS_VERSION_')) {
    exit;
}

use PaypalAddons\classes\API\Request\RequestInteface;

interface PaypalWebhookApiManagerInterface
{
    /** @return RequestInteface*/
    public function getWebhookEventList($params);

    /** @return RequestInteface*/
    public function getWebhookEventDetail($id);

    /** @return RequestInteface*/
    public function getWebhookList();

    /** @return RequestInteface*/
    public function createWebhook($webhook = null);

    /** @return RequestInteface*/
    public function patchWebhook($patch);

    /** @return RequestInteface*/
    public function deleteWebhook($id);
}