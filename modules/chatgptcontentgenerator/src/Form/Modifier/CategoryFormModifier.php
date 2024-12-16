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

use PrestaShop\Module\Chatgptcontentgenerator\Entity\GptHistoryCategory;
use PrestaShopBundle\Form\FormBuilderModifier;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class CategoryFormModifier
{
    private $formBuilderModifier;
    private $translator;

    public function __construct(FormBuilderModifier $formBuilderModifier, TranslatorInterface $translator)
    {
        $this->formBuilderModifier = $formBuilderModifier;
        $this->translator = $translator;
    }

    public function modify($id_category, FormBuilderInterface $categoryFormBuilder, array $data = [], array $options = [], array $languages = [])
    {
        $productHistoryList = GptHistoryCategory::getHistoryData($id_category, 1, count($languages));
        $history = new GptHistoryCategory($id_category);
        $totalPages = $history->getHistoryDataCount($id_category, count($languages));
        $data = [
            'languages' => $languages,
            'productHistoryList' => $productHistoryList,
            'currentPage' => 1,
            'totalPages' => $totalPages,
            'id_category' => $id_category,
        ];

        $categoryFormBuilder->add('historyTable', CategoryFormType::class, [
            'data' => $data,
            'required' => false,
            'label' => $this->translator->trans('Category history', [], 'Modules.Chatgptcontentgenerator.Admin'),
        ]);
    }
}
