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

trait RewriteTrait
{
    public function rewriteText($text, $langIsoCode, $entityType, $fieldName)
    {
        $text = str_replace(['<br/>', '<br>', '<br />'], "\n", $text);
        $text = strip_tags($text);

        if (empty($langIsoCode)) {
            throw new \Exception('The language iso is not valid');
        }

        if (!is_string($text)) {
            throw new \Exception('The text is not valid');
        }

        if (trim($text) === '') {
            throw new \Exception('The text could not be empty');
        }

        if (!is_string($entityType) || trim($entityType) === '') {
            throw new \Exception('The entity type is not set or not valid');
        }

        if (!is_string($fieldName) || trim($fieldName) === '') {
            throw new \Exception('The field name is not set or not valid');
        }

        $response = $this->sendRequest(
            '/text/rewrite',
            'POST',
            [
                'text' => $text,
                'langIsoCode' => $langIsoCode,
                'entityType' => $entityType,
                'fieldName' => $fieldName,
            ]
        );

        if (!isset($response['text'])) {
            $code = (isset($response['error']['code']) ? $response['error']['code'] : 0);
            throw new \Exception($response['error']['message'], $code);
        }

        return $response;
    }
}
