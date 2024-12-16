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
if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\Module\Chatgptcontentgenerator\Entity\GptContentBlogCategory;
use PrestaShop\Module\Chatgptcontentgenerator\Entity\GptContentPost;

class ChatgptcontentgeneratorBlogHomeModuleFrontController extends ModuleFrontController
{
    public $category;
    public $blog_search;
    public $is_search = false;
    public $posts_per_page;
    public $n;
    public $p;

    public function init()
    {
        parent::init();

        if (!Configuration::getGlobalValue('CHATGPTSPINOFF_MANAGE')) {
            Tools::redirect('index.php?controller=404');
        }

        $this->category = new GptContentBlogCategory(GptContentBlogCategory::getIdRootCategory(), $this->context->language->id);

        if (!Validate::isLoadedObject($this->category)) {
            Tools::redirect('index.php?controller=404');
        }

        $blog_search = Tools::getValue('blog_search', false);

        if ($blog_search) {
            $this->blog_search = $blog_search;
            $this->is_search = true;
        }
    }

    public function initContent()
    {
        $id_lang = Context::getContext()->language->id;

        parent::initContent();

        $this->context->smarty->assign([
            'blogMainTitle' => $this->category->name,
        ]);

        $page = Tools::getValue('p', 0);
        $this->posts_per_page = $this->module->getConfig('BLOG_POSTS_PER_PAGE');
        $this->context->smarty->assign('is_search', $this->is_search);
        $blog_search = null;

        if ($this->is_search) {
            $blog_search = $this->blog_search;
            $this->context->smarty->assign('blog_search', $this->blog_search);
        }

        $idCategory = 0;
        if ($this->category->id != GptContentBlogCategory::getIdRootCategory()) {
            $idCategory = $this->category->id;
        }

        $result = GptContentPost::getPosts(
            $id_lang,
            $this->posts_per_page,
            $blog_search,
            $page,
            true,
            false,
            false,
            null,
            false,
            null,
            false,
            [],
            false,
            $idCategory
        );

        $posts = $result['posts'];

        $this->assignPagination($this->posts_per_page, $result['count']);

        $popularpost = GptContentPost::getPosts(
            $id_lang,
            3,
            null,
            null,
            true,
            'views',
            false,
            null,
            false,
            null,
            false,
            [],
            false,
            $idCategory
        );
        $this->context->smarty->assign('popular_posts', $popularpost['posts']);

        $settings = [
            'is_display_time' => (bool) $this->module->getConfig('BLOG_DISPLAY_DATE', null, null, null, false),
            'is_shortdescription' => (bool) $this->module->getConfig('BLOG_DISPLAY_DESCRIPTION', null, null, null, false),
            'is_cover' => (bool) $this->module->getConfig('BLOG_DISPLAY_THUMBNAIL', null, null, null, false),
        ];
        $this->context->smarty->assign($settings);

        $this->context->smarty->assign([
            'posts' => $posts,
            'searchFormLink' => $this->category->getLink(),
            'module' => $this->module,
            'category' => $this->category,
        ]);

        $this->setTemplate('module:chatgptcontentgenerator/views/templates/front/bloghome.tpl');
    }

    public function getBreadcrumbLinks()
    {
        $breadcrumb = parent::getBreadcrumbLinks();

        foreach ($this->category->getAllParents() as $category) {
            if ($category->id_parent != 0 && $category->active) {
                $breadcrumb['links'][] = [
                    'title' => $category->name,
                    'url' => $category->getLink(),
                ];
            }
        }

        $breadcrumb['links'][] = [
            'title' => $this->category->name,
            'url' => $this->category->getLink(),
        ];

        return $breadcrumb;
    }

    public function getTemplateVarPage()
    {
        $page = parent::getTemplateVarPage();

        if ($this->category->meta_title) {
            $page['meta']['title'] = $this->category->meta_title;
        }

        if ($this->category->meta_description) {
            $page['meta']['description'] = $this->category->meta_description;
        }

        if ($this->category->meta_keywords) {
            $page['meta']['keywords'] = $this->category->meta_keywords;
        }

        $page['body_classes']['blog-category-id-' . $this->category->id] = true;
        $page['body_classes']['blog-category-id-parent-' . $this->category->id_parent] = true;
        $page['body_classes']['blog-category-depth-level-' . $this->category->level_depth] = true;

        return $page;
    }

    public function assignPagination($limit, $nbPosts)
    {
        $this->n = $limit;
        $this->p = abs((int) Tools::getValue('p', 1));

        $current_url = tools::htmlentitiesUTF8($_SERVER['REQUEST_URI']);
        $current_url = preg_replace('/(\?)?(&amp;)?p=\d+/', '$1', $current_url);

        $range = 2;

        if ($this->p < 1) {
            $this->p = 1;
        }

        $pages_nb = ceil($nbPosts / (int) $this->n);

        $start = (int) ($this->p - $range);

        if ($start < 1) {
            $start = 1;
        }
        $stop = (int) ($this->p + $range);

        if ($stop > $pages_nb) {
            $stop = (int) $pages_nb;
        }
        $this->context->smarty->assign('nb_posts', $nbPosts);
        $pagination_infos = [
            'products_per_page' => $limit,
            'pages_nb' => $pages_nb,
            'p' => $this->p,
            'n' => $this->n,
            'range' => $range,
            'start' => $start,
            'stop' => $stop,
            'current_url' => $current_url,
        ];

        $this->context->smarty->assign($pagination_infos);
    }

    public function setMedia()
    {
        parent::setMedia();
        $this->context->controller->registerStylesheet(
            'front-' . $this->module->name,
            '/modules/' . $this->module->name . '/views/css/front.css',
            [
                'media' => 'all',
                'priority' => 990,
            ]
        );
    }

    public function getLayout()
    {
        return 'layouts/layout-left-column.tpl';
    }
}
