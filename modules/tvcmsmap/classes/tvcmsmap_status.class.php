<?php
/**
* 2007-2022 PrestaShop
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2022 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class TvcmsMapStatus extends Module
{
    public function fieldStatusInformation()
    {
        $result = array();
        
        $result['main_form'] = false;
        $result['main_title'] = true;
        $result['main_short_description'] = true;
        $result['main_description'] = true;
        $result['main_image'] = true;


        $result['record_form'] = true;
        $result['image'] = false;
        $result['title'] = true;
        $result['short_description'] = true;
        $result['description'] = false;
        $result['btn_title'] = true;
        $result['api_key'] = true;
        $result['map_type'] = true;
        $result['zoom'] = true;
        $result['letitude'] = true;
        $result['longitude'] = true;

        return $result;
    }
}
