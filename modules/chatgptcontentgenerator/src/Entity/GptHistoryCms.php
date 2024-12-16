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
namespace Prestashop\Module\Chatgptcontentgenerator\Entity;

if (!defined('_PS_VERSION_')) {
    exit;
}

class GptHistoryCms extends \ObjectModel
{
    public $id_cms_history;
    public $id_cms;
    public $id_lang;
    public $title;
    public $content;
    public $date_add;

    public static $definition = [
        'table' => 'gptcontent_cms_history',
        'primary' => 'id_cms_history',
        'multilang' => true,
        'fields' => [
            'id_cms_history' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'auto_increment' => true],
            'id_cms' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true],
            'date_add' => ['type' => self::TYPE_DATE, 'validate' => 'isDate'],

            'title' => ['type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 255],
            'content' => ['type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isCleanHtml'],
        ],
    ];

    public static function addHistoryList($id_cms, $titles, $contents)
    {
        $history = new GptHistoryCms();

        $history->id_cms = $id_cms;
        $history->title = $titles;
        $history->content = $contents;
        $history->save();
    }

    public static function getHistoryData($id_cms, $currentPage, $itemsPerPage)
    {
        if (!$id_cms) {
            return [];
        }

        $itemsPerPage *= 20;
        $offset = ($currentPage - 1) * $itemsPerPage;

        $sql = new \DbQuery();
        $sql->select('*');
        $sql->from('gptcontent_cms_history', 'ccch');
        $sql->innerJoin('gptcontent_cms_history_lang', 'ccchl', 'ccch.id_cms_history = ccchl.id_cms_history');
        $sql->where('ccch.id_cms = ' . (int) pSQL($id_cms));
        $sql->orderBy('ccch.date_add DESC');
        $sql->limit($itemsPerPage, $offset);

        $result = \Db::getInstance()->executeS($sql);

        return $result ?: [];
    }

    public static function getHistoryDataCount($id_cms, $itemsPerPage)
    {
        if (!$id_cms) {
            return [];
        }

        $itemsPerPage *= 20;

        $sql = new \DbQuery();
        $sql->select('count(*)');
        $sql->from('gptcontent_cms_history', 'ccch');
        $sql->innerJoin('gptcontent_cms_history_lang', 'ccchl', 'ccch.id_cms_history = ccchl.id_cms_history');
        $sql->where('ccch.id_cms = ' . (int) pSQL($id_cms));

        $totalItems = \Db::getInstance()->getValue($sql);
        $totalPages = ceil($totalItems / $itemsPerPage);

        return $totalPages;
    }

    public static function getIdHistoryByCmsId($id_cms)
    {
        if (!$id_cms) {
            return [];
        }

        $sql = new \DbQuery();
        $sql->select('id_cms_history');
        $sql->from('gptcontent_cms_history');
        $sql->where('id_cms = ' . (int) pSQL($id_cms));

        $result = \Db::getInstance()->executeS($sql);

        return $result;
    }
}
