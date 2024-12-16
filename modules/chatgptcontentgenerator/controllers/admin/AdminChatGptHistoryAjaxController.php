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

use PrestaShop\Module\Chatgptcontentgenerator\Entity\GptHistory;
use PrestaShop\Module\Chatgptcontentgenerator\Entity\GptHistoryCategory;
use PrestaShop\Module\Chatgptcontentgenerator\Entity\GptHistoryCms;

class AdminChatGptHistoryAjaxController extends ModuleAdminController
{
    public function ajaxProcessRestoreDataProduct()
    {
        $id_history = Tools::getValue('id_history');
        $id_lang = Tools::getValue('id_lang');
        $history = new GptHistory($id_history, $id_lang);

        if ($history->id_product) {
            $product = new Product($history->id_product);

            $product->name[$id_lang] = $history->name;
            $product->description[$id_lang] = $history->description;
            $product->description_short[$id_lang] = $history->short_description;

            $update_result = $product->save();
            if ($update_result) {
                $this->module->jsonResponse(['success' => true, 'message' => $this->trans('Product successfully updated', [], 'Modules.Chatgptcontentgenerator.Admin')]);
            } else {
                $this->module->jsonResponse(['success' => false, 'message' => $this->trans('Failed to update product.', [], 'Modules.Chatgptcontentgenerator.Admin')]);
            }
        } else {
            $this->module->jsonResponse(['success' => false, 'message' => $this->trans('Invalid history.', [], 'Modules.Chatgptcontentgenerator.Admin')]);
        }
    }

    public function ajaxProcessGetHistoryPerPageProduct()
    {
        $id_product = Tools::getValue('id_entity');
        $current_page = Tools::getValue('current_page');
        $count_lang = Tools::getValue('count_lang');
        $result = GptHistory::getHistoryData($id_product, $current_page, $count_lang);

        $this->module->jsonResponse(['success' => true, 'data' => $result, 'page' => $current_page]);
    }

    public function ajaxProcessRestoreDataCategory()
    {
        $id_history = Tools::getValue('id_history');

        $id_lang = Tools::getValue('id_lang');
        $history = new GptHistoryCategory($id_history, $id_lang);

        if ($history->id_category) {
            $category = new Category($history->id_category);
            $category->name[$id_lang] = $history->name;
            $category->description[$id_lang] = $history->description;
            $update_result = $category->save();

            if ($update_result) {
                $this->module->jsonResponse(['success' => true, 'message' => $this->trans('Category successfully updated', [], 'Modules.Chatgptcontentgenerator.Admin')]);
            } else {
                $this->module->jsonResponse(['success' => false, 'message' => $this->trans('Failed to update category.', [], 'Modules.Chatgptcontentgenerator.Admin')]);
            }
        } else {
            $this->module->jsonResponse(['success' => false, 'message' => $this->trans('Invalid history.', [], 'Modules.Chatgptcontentgenerator.Admin')]);
        }
    }

    public function ajaxProcessGetHistoryPerPageCategory()
    {
        $id_category = Tools::getValue('id_entity');
        $current_page = Tools::getValue('current_page');
        $count_lang = Tools::getValue('count_lang');
        $result = GptHistoryCategory::getHistoryData($id_category, $current_page, $count_lang);

        $this->module->jsonResponse(['success' => true, 'data' => $result, 'page' => $current_page]);
    }

    public function ajaxProcessRestoreDataCms()
    {
        $id_history = Tools::getValue('id_history');
        $id_lang = Tools::getValue('id_lang');
        $history = new GptHistoryCms($id_history, $id_lang);

        if ($history->id_cms) {
            $cms = new CMS($history->id_cms);
            $cms->meta_title[$id_lang] = $history->title;
            $cms->content[$id_lang] = $history->content;
            $update_result = $cms->save();

            if ($update_result) {
                $this->module->jsonResponse(['success' => true, 'message' => $this->trans('Cms successfully updated', [], 'Modules.Chatgptcontentgenerator.Admin')]);
            } else {
                $this->module->jsonResponse(['success' => false, 'message' => $this->trans('Failed to update cms.', [], 'Modules.Chatgptcontentgenerator.Admin')]);
            }
        } else {
            $this->module->jsonResponse(['success' => false, 'message' => $this->trans('Invalid history.', [], 'Modules.Chatgptcontentgenerator.Admin')]);
        }
    }

    public function ajaxProcessGetHistoryPerPageCms()
    {
        $id_cms = Tools::getValue('id_entity');
        $current_page = Tools::getValue('current_page');
        $count_lang = Tools::getValue('count_lang');
        $result = GptHistoryCms::getHistoryData($id_cms, $current_page, $count_lang);

        $this->module->jsonResponse(['success' => true, 'data' => $result, 'page' => $current_page]);
    }
}
