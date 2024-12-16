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

class GptHistoryCategory extends \ObjectModel
{
    public $id_category_history;
    public $id_category;
    public $id_lang;
    public $name;
    public $description;
    public $date_add;

    public static $definition = [
        'table' => 'gptcontent_category_history',
        'primary' => 'id_category_history',
        'multilang' => true,
        'fields' => [
            'id_category_history' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'auto_increment' => true],
            'id_category' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true],
            'date_add' => ['type' => self::TYPE_DATE, 'validate' => 'isDate'],

            'name' => ['type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 255],
            'description' => ['type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isCleanHtml'],
        ],
    ];

    public static function addHistoryList($id_category, $names, $descriptions)
    {
        $history = new GptHistoryCategory();

        $history->id_category = $id_category;
        $history->name = $names;
        $history->description = $descriptions;
        $history->save();
    }

    public static function getHistoryData($id_category, $currentPage, $itemsPerPage): array
    {
        if (!$id_category) {
            return [];
        }

        $itemsPerPage *= 20;
        $offset = ($currentPage - 1) * $itemsPerPage;

        $sql = new \DbQuery();
        $sql->select('*');
        $sql->from('gptcontent_category_history', 'cch');
        $sql->innerJoin('gptcontent_category_history_lang', 'cchl', 'cch.id_category_history = cchl.id_category_history');
        $sql->where('cch.id_category = ' . (int) pSQL($id_category));
        $sql->orderBy('cch.date_add DESC');
        $sql->limit($itemsPerPage, $offset);

        $result = \Db::getInstance()->executeS($sql);

        return $result ?: [];
    }

    public function getHistoryDataCount($id_category, $itemsPerPage): int
    {
        if (!$id_category) {
            return 0;
        }

        $itemsPerPage *= 20;

        $sql = new \DbQuery();
        $sql->select('COUNT(*)');
        $sql->from('gptcontent_category_history', 'cch');
        $sql->innerJoin('gptcontent_category_history_lang', 'cchl', 'cch.id_category_history = cchl.id_category_history');
        $sql->where('cch.id_category = ' . (int) pSQL($id_category));

        $totalItems = \Db::getInstance()->getValue($sql);
        $totalPages = ceil($totalItems / $itemsPerPage);

        return $totalPages;
    }

    public static function getIdHistoryByCategoryId($id_category)
    {
        if (!$id_category) {
            return [];
        }

        $sql = new \DbQuery();

        $sql->select('id_category_history');
        $sql->from('gptcontent_category_history');
        $sql->where('id_category = ' . (int) pSQL($id_category));

        $result = \Db::getInstance()->executeS($sql);

        return $result;
    }
}
