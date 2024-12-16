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
namespace PrestaShop\Module\Chatgptcontentgenerator\Api\Traits;

if (!defined('_PS_VERSION_')) {
    exit;
}

trait ToolsTrait
{
    public static function formatText($text)
    {
        if (empty($text) || !is_string($text)) {
            return $text;
        }

        // Replace all instances of "#### " with "<h3>" and append "</h3>" to the end of the line
        $text = preg_replace('/####\s*(.*)/', '<h3>$1</h3>', $text);
        $text = preg_replace('/###\s*(.*)/', '<h3>$1</h3>', $text);

        // replace **text** with <b>text</b>
        $text = preg_replace('/\*\*\*(.*?)\*\*\*/', '<b>$1</b>', $text);
        $text = preg_replace('/\*\*(.*?)\*\*/', '<b>$1</b>', $text);

        return $text;
    }

    public static function nlToBr($text)
    {
        if (empty($text) || !is_string($text)) {
            return $text;
        }

        // replace \n with <br/>
        return nl2br($text);
    }
}
