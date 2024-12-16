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
namespace PrestaShop\Module\Chatgptcontentgenerator\Process;

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\Module\Chatgptcontentgenerator\Entity\GptContentPost;

class GeneratePost
{
    protected $context;
    protected $translator;

    public function __construct($context = null)
    {
        if (null === $context) {
            $context = \Context::getContext();
        }

        $this->context = $context;
        $this->translator = $this->context->getTranslator();
    }

    protected function trans($id, array $parameters = [], $domain = null, $locale = null)
    {
        return $this->translator->trans($id, $parameters, $domain, $locale);
    }

    public function generatePostByProduct(
        $idProduct,
        $idLang,
        $maxLength = 400,
        $name = '',
        $images = [] // id, save_path
    ) {
        if ('' === $name) {
            $name = (new \Product((int) $idProduct, false, (int) $idLang))->name;
        }

        if (trim($name) === '') {
            $message = $this->trans(
                'Product name is empty [id_product = %id_product%, language = %language%]',
                [
                    '%id_product%' => $idProduct,
                    '%language%' => \Language::getIsoById((int) $idLang),
                ],
                'Modules.Chatgptcontentgenerator.Admin'
            );

            throw new \Exception($message);
        }

        $post = $this->apiClient->generatePostForProduct([
            'name' => $name, // product name
            'maxLength' => \Tools::getValue('length'),
            'langIsoCode' => \Language::getIsoById((int) $idLang),
            'categoryName' => '',
            'brandName' => '',
        ]);

        $post_content = $this->insertImagesIntoText($images, $post['text']);

        // prepare post data
        $content = [];
        $title = [];

        foreach (\Language::getLanguages(false) as $lang) {
            $content[$lang['id_lang']] = $post_content;
            $title[$lang['id_lang']] = self::getTitleFromContent($post['text'], $name);
        }

        $product_post = $this->createPost((int) $idProduct, $title, $content);

        return [
            'text' => $post['text'],
            'nbWords' => (!isset($post['nbWords'])
                ? str_word_count($post['text'])
                : $post['nbWords']),
            'inQueue' => $post['inQueue'],
            'requestId' => $post['requestId'],
            'post' => (new GptContentPost($product_post->id, $this->context->language->id)),
        ];
    }

    private function insertImagesIntoText($images, $htmlContent)
    {
        if (!is_array($images) || empty($images)) {
            return $htmlContent;
        }

        // split HTML by paragraphs
        $paragraphs = null;
        preg_match_all('/<p>((.|\r\n|\r|\n)*?)<\/p>/', $htmlContent, $paragraphs);

        if (!is_array($paragraphs) || !isset($paragraphs[0]) || empty($paragraphs[0])) {
            return $htmlContent;
        }

        $paragraphs = $paragraphs[0];

        $dir = _PS_IMG_DIR_ . 'chatgptcontentgenerator/post-media/';

        if (!file_exists(rtrim($dir))) {
            mkdir($dir, 0777, true);
        }

        foreach ($images as $k => $img) {
            if (!file_exists($img['save_path'])) {
                unset($images[$k]);
                continue;
            }
            $path_parts = pathinfo($img['save_path']);
            $fileName = date('Y-m-d_h-i-s') . '-' . $path_parts['filename'] . '.' . $path_parts['extension'];
            copy($img['save_path'], $dir . $fileName);
            $images[$k]['url'] = $this->context->link->getMediaLink('/img/chatgptcontentgenerator/post-media/' . $fileName);
        }

        $images = array_values($images);

        $nbParagraphs = count($paragraphs);
        $avgImages = ceil(count($images) / $nbParagraphs);

        for ($i = 0; $i < $nbParagraphs; $i = $i + 1) {
            $pImages = [];

            if ($images) {
                for ($j = 0; $j < $avgImages; $j = $j + 1) {
                    if (!isset($images[$j])) {
                        break;
                    }
                    $pImages[] = $images[$j];
                    unset($images[$j]);
                    $images = array_values($images);
                }
            }
            if ($pImages) {
                $htmlContent = str_replace(
                    $paragraphs[$i],
                    $paragraphs[$i] . '<p>' .
                            implode(
                                ' ',
                                array_map(
                                    function ($img) {
                                        return '<img src="' . $img['url'] . '" class="blog-content-images" alt="" style="display: inline-block;"/>';
                                    },
                                    $pImages
                                )
                            ) .
                        '</p>',
                    $htmlContent
                );
            }
        }

        return $htmlContent;
    }

    public static function getTitleFromContent($htmlContent, $defautlTitle = '')
    {
        $m = null;
        preg_match_all('/<h1>((.|\r\n|\r|\n)*?)<\/h1>/', $htmlContent, $m);

        if ($m && isset($m[1]) && !empty($m[1]) && trim($m[1][0]) !== '') {
            return trim(str_replace("\n", '', $m[1][0]));
        }

        return $defautlTitle;
    }

    private function createPost($id_product, array $title, array $content)
    {
        $post = new GptContentPost();
        $post->id_product = (int) $id_product;
        $post->title = $title;
        $post->content = $content;
        $post->link_rewrite = array_map(
            function ($t) {
                return \Tools::link_rewrite($t);
            },
            $post->title
        );
        $post->short_content = [];

        foreach ($content as $id_lang => $html_content) {
            $post->short_content[$id_lang] = self::getShortDescriptionFromContent($html_content, '');
        }

        $post->add();

        return $post;
    }

    public static function getShortDescriptionFromContent($htmlContent, $defautlContent = '')
    {
        $m = null;
        preg_match_all('/<p>((.|\r\n|\r|\n)*?)<\/p>/', $htmlContent, $m);

        if ($m && isset($m[0]) && !empty($m[0])) {
            return trim($m[0][0]);
        }

        return $defautlContent;
    }
}
