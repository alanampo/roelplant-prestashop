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

namespace PaypalPPBTlib\Extensions\Diagnostic\Stubs\Concrete;

use PaypalPPBTlib\Extensions\Diagnostic\Stubs\Concrete\AbstractStub;
use PaypalPPBTlib\Extensions\Diagnostic\Stubs\Interfaces\StubInterface;
use PaypalPPBTlib\Extensions\Diagnostic\Stubs\Handler\OrderStateStubHandler;
use PaypalPPBTlib\Extensions\Diagnostic\Stubs\Model\OrderStateParameters;

class OrderStateStub extends AbstractStub implements StubInterface
{
    const FIX_ORDER_STATE_EVENT = 'fixOrderState';

    const ASSOCIATE_ORDER_STATE_EVENT = 'associateOrderState';

    public function __construct($parameters = [])
    {
        parent::__construct($parameters);
        $this->tpl = _PS_MODULE_DIR_ . 'paypal/views/templates/admin/diagnostic/order_state.tpl';
        $this->handler = new OrderStateStubHandler($this);
        $this->events = [
            self::FIX_ORDER_STATE_EVENT,
            self::ASSOCIATE_ORDER_STATE_EVENT,
        ];
        $this->parameters = (new OrderStateParameters());
        if (!empty($parameters)) {
            $this->parameters->setStatuses(isset($parameters['statuses']) ? $parameters['statuses'] : false);
        }
    }

    public function dispatchEvent($event, $params)
    {
        switch ($event) {
            case self::FIX_ORDER_STATE_EVENT:
                $this->handler->fixOrderState($params['moduleName']);
                break;
            case self::ASSOCIATE_ORDER_STATE_EVENT:
                $this->handler->associateOrderState($params['moduleName'], $params['moduleName']);
                break;
            default:
                throw new \RuntimeException('message d\'erreur');
        }
    }

}
