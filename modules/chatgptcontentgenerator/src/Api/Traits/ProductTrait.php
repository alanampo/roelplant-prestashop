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

trait ProductTrait
{
    public function productDescription($productName, $textLength = 0, $langIsoCode = null, $categoryName = null, $brandName = null, $ean = null)
    {
        if (!is_numeric($textLength)) {
            throw new \Exception('The text length is not valid');
        }

        $response = $this->sendRequest(
            '/text/product-description',
            'POST',
            [
                'productName' => $productName,
                'maxLength' => $textLength,
                'langIsoCode' => $langIsoCode,
                'categoryName' => $categoryName,
                'brandName' => $brandName,
                'productEan' => $ean,
            ]
        );

        if (!isset($response['text'])) {
            $code = (isset($response['error']['code']) ? $response['error']['code'] : 0);
            throw new \Exception($response['error']['message'], $code);
        } else {
            $response['text'] = self::nlToBr(self::formatText($response['text']));
        }

        return $response;
    }

    public function productCharacteristics($productName, $textLength = 0, $langIsoCode = null, $categoryName = null, $brandName = null, $ean = null)
    {
        if (!is_numeric($textLength)) {
            throw new \Exception('The text length is not valid');
        }

        $response = $this->sendRequest(
            '/text/product-description',
            'POST',
            [
                'productName' => $productName,
                'maxLength' => $textLength,
                'langIsoCode' => $langIsoCode,
                'categoryName' => $categoryName,
                'brandName' => $brandName,
                'productEan' => $ean,
                'descriptionType' => 'characteristics',
            ]
        );

        if (!isset($response['text'])) {
            $code = (isset($response['error']['code']) ? $response['error']['code'] : 0);
            throw new \Exception($response['error']['message'], $code);
        } else {
            $response['text'] = self::nlToBr(self::formatText($response['text']));
        }

        return $response;
    }
}