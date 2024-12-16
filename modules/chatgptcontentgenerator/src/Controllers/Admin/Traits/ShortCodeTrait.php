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
namespace PrestaShop\Module\Chatgptcontentgenerator\Controllers\Admin\Traits;

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\Module\Chatgptcontentgenerator\Entity\GptContentTemplate;

trait ShortCodeTrait
{
    protected function getProductShortCodeDesc()
    {
        $desc[] = $this->trans(
            'You can also use the following shortcodes. The shortcodes will be replaced by the product values in the request',
            [],
            'Modules.Chatgptcontentgenerator.Admin'
        );

        $desc[] = [
            'id' => 'shortcodes',
            'text' => $this->getProductShortCodes(),
        ];

        $desc[] = [
            'id' => 'shortcodes_features',
            'text' => $this->getShortCodesFeatures(),
        ];

        return $desc;
    }

    protected function getProductShortCodes()
    {
        $html = '<span class="shortcodes-name">' . $this->trans('Product shortcodes:', [], 'Modules.Chatgptcontentgenerator.Admin') . '</span> ';

        foreach (GptContentTemplate::getProductShortCodes() as $shortCode => $shortCodeDesc) {
            $html .= $this->getHtmlShortCodeWithTitle($shortCode, $shortCodeDesc);
        }

        return $html;
    }

    protected function getShortCodesFeatures()
    {
        $html = '';
        $features = GptContentTemplate::getShortCodesFeaturesByLang((int) $this->context->language->id);

        if (isset($features['prepareName']) && is_array($features['prepareName'])) {
            $html .= '<span class="shortcodes-name">' . $this->trans('Product features:', [], 'Modules.Chatgptcontentgenerator.Admin') . '</span> ';

            foreach ($features['prepareName'] as $id_feature => $feature) {
                $title = $this->trans('Feature', [], 'Admin.Global') . ': ' . $features['name'][$id_feature];
                $html .= $this->getHtmlShortCodeWithTitle($feature, $title);
            }
        }

        return $html;
    }

    protected function getCategoryShortCodeDesc()
    {
        $desc[] = $this->trans('You can also use the following shortcodes. The shortcodes will be replaced by the category values in the request', [], 'Modules.Chatgptcontentgenerator.Admin');

        $desc[] = [
            'id' => 'shortcodes',
            'text' => $this->getCategoryShortCodes(),
        ];

        return $desc;
    }

    protected function getCategoryShortCodes()
    {
        $html = '<span class="shortcodes-name">' . $this->trans('Category shortcodes:', [], 'Modules.Chatgptcontentgenerator.Admin') . '</span> ';

        foreach (GptContentTemplate::getCategoryShortCodes() as $shortCode => $shortCodeDesc) {
            $html .= $this->getHtmlShortCodeWithTitle($shortCode, $shortCodeDesc);
        }

        return $html;
    }

    protected function getPageShortCodeDesc()
    {
        $desc[] = $this->trans('You can also use the following shortcodes. The shortcodes will be replaced by the cms values in the request', [], 'Modules.Chatgptcontentgenerator.Admin');

        $desc[] = [
            'id' => 'shortcodes',
            'text' => $this->getPageShortCodes(),
        ];

        return $desc;
    }

    protected function getPageShortCodes()
    {
        $html = '<span class="shortcodes-name">' . $this->trans('CMS shortcodes:', [], 'Modules.Chatgptcontentgenerator.Admin') . '</span> ';

        foreach (GptContentTemplate::getPageShortCodes() as $shortCode => $shortCodeDesc) {
            $html .= $this->getHtmlShortCodeWithTitle($shortCode, $shortCodeDesc);
        }

        return $html;
    }

    protected function getHtmlShortCodeWithTitle($shortCode, $title)
    {
        return '<span class="shortcod-value label-tooltip" data-toggle="tooltip" data-html="false" title="' . $title . '">' . $shortCode . '</span>';
    }
}
