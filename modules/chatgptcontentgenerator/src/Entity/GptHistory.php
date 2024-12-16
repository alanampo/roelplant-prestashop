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
namespace PrestaShop\Module\Chatgptcontentgenerator\Entity;

if (!defined('_PS_VERSION_')) {
    exit;
}

class GptHistory extends \ObjectModel
{
    public $id_product_history;
    public $id_product;
    public $id_lang;
    public $name;
    public $description;
    public $short_description;
    public $date_add;

    public static $definition = [
        'table' => 'gptcontent_product_history',
        'primary' => 'id_product_history',
        'multilang' => true,
        'fields' => [
            'id_product_history' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'auto_increment' => true],
            'id_product' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true],
            'date_add' => ['type' => self::TYPE_DATE, 'validate' => 'isDate'],

            'name' => ['type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 255],
            'description' => ['type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isCleanHtml'],
            'short_description' => ['type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isCleanHtml'],
        ],
    ];

    public static function addHistoryList($id_product, $names, $descriptions, $short_descriptions)
    {
        $history = new GptHistory();

        $history->id_product = $id_product;

        $history->name = $names;
        $history->description = $descriptions;
        $history->short_description = $short_descriptions;

        $history->save();
    }

    public static function getHistoryData($id_product, $currentPage, $itemsPerPage)
    {
        if (!$id_product) {
            return [];
        }

        $itemsPerPage *= 20;
        $offset = ($currentPage - 1) * $itemsPerPage;

        $sql = new \DbQuery();
        $sql->select('*');
        $sql->from('gptcontent_product_history', 'ph');
        $sql->innerJoin('gptcontent_product_history_lang', 'phl', 'ph.id_product_history = phl.id_product_history');
        $sql->where('ph.id_product = ' . (int) $id_product);
        $sql->orderBy('ph.date_add DESC');
        $sql->limit($itemsPerPage, $offset);

        $result = \Db::getInstance()->executeS($sql);

        return $result ?: [];
    }

    public function getHistoryDataCount($id_product, $itemsPerPage)
    {
        if (!$id_product) {
            return 0;
        }

        $itemsPerPage *= 20;

        $countQuery = new \DbQuery();
        $countQuery->select('COUNT(*)');
        $countQuery->from('gptcontent_product_history', 'ph');
        $countQuery->innerJoin('gptcontent_product_history_lang', 'phl', 'ph.id_product_history = phl.id_product_history');
        $countQuery->where('ph.id_product = ' . (int) $id_product);

        $totalItems = \Db::getInstance()->getValue($countQuery);
        $totalPages = ceil($totalItems / $itemsPerPage);

        return $totalPages;
    }

    public static function getIdHistoryByProductId($id_product)
    {
        if (!$id_product) {
            return [];
        }

        $sql = new \DbQuery();
        $sql->select('id_product_history');
        $sql->from('gptcontent_product_history');
        $sql->where('id_product = ' . (int) pSQL($id_product));
        $result = \Db::getInstance()->executeS($sql);

        return $result;
    }
}
