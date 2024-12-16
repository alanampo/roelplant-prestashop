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
namespace PrestaShop\Module\Chatgptcontentgenerator\Form\Modifier;

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\Module\Chatgptcontentgenerator\Entity\GptHistory;
use PrestaShopBundle\Form\FormBuilderModifier;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class ProductFormModifier
{
    private $formBuilderModifier;
    private $translator;

    public function __construct(FormBuilderModifier $formBuilderModifier, TranslatorInterface $translator)
    {
        $this->formBuilderModifier = $formBuilderModifier;
        $this->translator = $translator;
    }

    public function modify($id_product, FormBuilderInterface $productFormBuilder, array $data = [], array $options = [], array $languages = [])
    {
        $productHistoryList = GptHistory::getHistoryData($id_product, 1, count($languages));
        $history = new GptHistory($id_product);
        $totalPages = $history->getHistoryDataCount($id_product, count($languages));
        $data = [
            'languages' => $languages,
            'productHistoryList' => $productHistoryList,
            'currentPage' => 1,
            'totalPages' => $totalPages,
            'id_product' => $id_product,
        ];

        $descriptionTabFormBuilder = $productFormBuilder->get('description');
        $this->formBuilderModifier->addAfter(
            $descriptionTabFormBuilder,
            'related_products',
            'product_history',
            ProductFormType::class, [
                'data' => $data,
            ]
        );
    }
}
