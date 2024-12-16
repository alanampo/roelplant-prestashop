<?php
/**
 * 2007-2023 PrestaShop
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
 *  @copyright 2007-2023 PrestaShop SA
 *  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\Module\Chatgptcontentgenerator\Sql\Installer;

function upgrade_module_1_1_5($module)
{
    $result = true;

    try {
        $module->registerHook('displayAdminProductsMainStepLeftColumnBottom');

        $module->registerHook('actionProductFormBuilderModifier');
        $module->registerHook('actionCategoryFormBuilderModifier');
        $module->registerHook('actionCmsPageFormBuilderModifier');

        $module->registerHook('actionObjectProductUpdateBefore');
        $module->registerHook('actionObjectCategoryUpdateBefore');
        $module->registerHook('actionObjectCmsPageUpdateBefore');

        $module->registerHook('actionObjectProductUpdateBefore');
        $module->registerHook('actionBeforeUpdateProductFormHandler');

        $module->registerHook('actionObjectProductDeleteBefore');
        $module->registerHook('actionObjectCategoryDeleteBefore');
        $module->registerHook('actionObjectCmsPageDeleteBefore');

        $module->installTabs(
            [
                [
                    'visible' => false,
                    'class_name' => 'AdminChatGptHistoryAjax',
                    'name' => 'ChatGPT History',
                    'id_parent' => -1,
                    'icon' => null,
                ],
            ]
        );

        $sqlInstaller = new Installer();
        $sqlInstaller->installProductHistory();
        $sqlInstaller->installCategoryHistory();
        $sqlInstaller->installCmsHistory();
    } catch (Exception $e) {
        $result &= false;
    }

    return (bool) $result;
}
