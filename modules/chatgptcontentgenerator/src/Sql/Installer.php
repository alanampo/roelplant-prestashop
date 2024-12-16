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
namespace PrestaShop\Module\Chatgptcontentgenerator\Sql;

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\Module\Chatgptcontentgenerator\Entity\GptContentBlogCategory;

class Installer
{
    private $sql = [];
    private $usql = [];
    private $errors = [];

    public function __construct()
    {
        $collation_database = \Db::getInstance()->getValue('SELECT @@collation_database');

        $this->sql['content_generator'] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'content_generator` (
                                            `id_content_generator` int(10) NOT NULL AUTO_INCREMENT,
                                            `id_object` int(10) NOT NULL,
                                            `id_lang` int(10) NULL,
                                            `object_type` tinyint(1) DEFAULT 1,
                                            `is_translated` tinyint(1) NULL DEFAULT 0,
                                            `is_generated` tinyint(1) NULL DEFAULT 0,
                                            `date_add` datetime DEFAULT NULL,
                                            PRIMARY KEY (`id_content_generator`),
                                            KEY `id_object` (`id_object`,`object_type`)
                                        ) COLLATE=\'' . $collation_database . '\' ENGINE=' . _MYSQL_ENGINE_ . ';';

        $this->sql['content_template'] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'content_template` (
                                            `id_content_template` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                            `name` varchar(128) NOT NULL,
                                            `type` enum("product","category","cms") NOT NULL DEFAULT "product",
                                            `active` tinyint(1) NOT NULL DEFAULT 1,
                                            PRIMARY KEY (`id_content_template`)
                                        ) COLLATE=\'' . $collation_database . '\' ENGINE=' . _MYSQL_ENGINE_ . ';';

        $this->sql['content_template_lang'] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'content_template_lang` (
                                            `id_content_template` int(10) unsigned NOT NULL,
                                            `id_lang` int(10) unsigned NOT NULL,
                                            `short_code` text NULL,
                                            PRIMARY KEY (`id_content_template`,`id_lang`)
                                        ) COLLATE=\'' . $collation_database . '\' ENGINE=' . _MYSQL_ENGINE_ . ';';

        $this->usql['content_generator'] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'content_generator`;';
        $this->usql['content_template'] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'content_template`;';
        $this->usql['content_template_lang'] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'content_template_lang`;';
        $this->usql['gptcontent_post'] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'gptcontent_post`;';
        $this->usql['gptcontent_post_lang'] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'gptcontent_post_lang`;';
        $this->usql['gptcontent_post_image'] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'gptcontent_post_image`;';
        $this->usql['gptcontent_post_category'] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'gptcontent_post_category`;';
        $this->usql['gptcontent_post_category_lang'] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'gptcontent_post_category_lang`;';
        $this->usql['spinoff_connections'] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'spinoff_connections`;';

        $this->usql['gptcontent_product_history'] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'gptcontent_product_history`;';
        $this->usql['gptcontent_product_history_lang'] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'gptcontent_product_history_lang`;';

        $this->usql['gptcontent_category_history'] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'gptcontent_category_history`;';
        $this->usql['gptcontent_category_history_lang'] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'gptcontent_category_history_lang`;';

        $this->usql['gptcontent_cms_history'] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'gptcontent_cms_history`;';
        $this->usql['gptcontent_cms_history_lang'] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'gptcontent_cms_history_lang`;';

        $this->usql['gptcontent_blog_category'] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'gptcontent_blog_category`;';
        $this->usql['gptcontent_blog_category_lang'] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'gptcontent_blog_category_lang`;';
        $this->usql['gptcontent_blog_category_post'] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'gptcontent_blog_category_post`;';

        $this->usql['gptcontent_blog_hook'] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'gptcontent_blog_hook`;';
        $this->usql['gptcontent_blog_hook_lang'] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'gptcontent_blog_hook_lang`;';

        $this->usql['gptcontent_post_cron'] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'gptcontent_post_cron`;';
        $this->usql['gptcontent_post_cron_lang'] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'gptcontent_post_cron_lang`;';
        $this->usql['gptcontent_post_cron_category'] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'gptcontent_post_cron_category`;';
    }

    public function installPosts()
    {
        $collation_database = \Db::getInstance()->getValue('SELECT @@collation_database');

        // reset tables list
        $this->sql = [];

        $this->sql['gptcontent_post'] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'gptcontent_post` (
                                            `id_gptcontent_post` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                                            `id_gptcontent_post_category` int(11) UNSIGNED DEFAULT NULL,
                                            `active` tinyint(1) UNSIGNED DEFAULT 0,
                                            `author` VARCHAR(60) DEFAULT NULL,
                                            `likes` int(11) UNSIGNED DEFAULT 0,
                                            `views` int(11) UNSIGNED DEFAULT 0,
                                            `allow_comments` tinyint(1) UNSIGNED DEFAULT 3,
                                            `is_featured` tinyint(1) UNSIGNED DEFAULT 0,
                                            `access` text DEFAULT NULL,
                                            `cover` text DEFAULT NULL,
                                            `featured` text DEFAULT NULL,
                                            `id_product` int(11) DEFAULT NULL,
                                            `date_add` datetime DEFAULT NULL,
                                            `date_upd` datetime DEFAULT NULL,
                                            PRIMARY KEY (`id_gptcontent_post`)
                                        ) COLLATE=\'' . $collation_database . '\' ENGINE=' . _MYSQL_ENGINE_ . ';';

        $this->sql['gptcontent_post_lang'] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'gptcontent_post_lang` (
                                            `id_gptcontent_post` int(10) UNSIGNED NOT NULL,
                                            `id_lang` int(10) UNSIGNED NOT NULL,
                                            `title` varchar(255) NOT NULL,
                                            `meta_title` varchar(255) DEFAULT NULL,
                                            `meta_description` varchar(255) DEFAULT NULL,
                                            `meta_keywords` varchar(255) DEFAULT NULL,
                                            `short_content` text DEFAULT NULL,
                                            `content` text DEFAULT NULL,
                                            `video_code` text DEFAULT NULL,
                                            `link_rewrite` varchar(255) DEFAULT NULL,
                                            PRIMARY KEY (`id_gptcontent_post`,`id_lang`)
                                        ) COLLATE=\'' . $collation_database . '\' ENGINE=' . _MYSQL_ENGINE_ . ';';

        $this->sql['gptcontent_post_image'] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'gptcontent_post_image` (
                                            `id_gptcontent_post_image` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                                            `id_gptcontent_post` int(11) UNSIGNED NOT NULL,
                                            `position` int(10) UNSIGNED DEFAULT NULL,
                                            `image` varchar(255) DEFAULT NULL,
                                            PRIMARY KEY (`id_gptcontent_post_image`)
                                        ) COLLATE=\'' . $collation_database . '\' ENGINE=' . _MYSQL_ENGINE_ . ';';

        return $this->executeSql();
    }

    public function installSpinOff()
    {
        $collation_database = \Db::getInstance()->getValue('SELECT @@collation_database');

        // reset tables list
        $this->sql = [];

        $this->sql['spinoff_connections'] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'spinoff_connections` (
                                            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                            `id_spinoff` int(10) unsigned NOT NULL,
                                            `id_product` int(10) unsigned NOT NULL,
                                            `stock` tinyint(1) unsigned NOT NULL DEFAULT 1,
                                            PRIMARY KEY (`id`)
                                        ) COLLATE=\'' . $collation_database . '\' ENGINE=' . _MYSQL_ENGINE_ . ';';

        return $this->executeSql();
    }

    public function installProductHistory()
    {
        $collation_database = \Db::getInstance()->getValue('SELECT @@collation_database');

        $this->sql = [];

        $this->sql['product_history'] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'gptcontent_product_history` (
                                        `id_product_history` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                        `id_product` int(10) unsigned NOT NULL,
                                        `date_add` datetime DEFAULT NULL,
                                        PRIMARY KEY (`id_product_history`)
        ) COLLATE=\'' . $collation_database . '\' ENGINE=' . _MYSQL_ENGINE_ . ';';

        $this->sql['product_history_lang'] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'gptcontent_product_history_lang` (
                                        `id_product_history` int(10) unsigned NOT NULL,
                                        `id_lang` int(10) unsigned NOT NULL,
                                        `name` varchar(255) DEFAULT NULL,
                                        `description` text DEFAULT NULL,
                                        `short_description` text DEFAULT NULL,
                                        PRIMARY KEY (`id_product_history`,`id_lang`)
        ) COLLATE=\'' . $collation_database . '\' ENGINE=' . _MYSQL_ENGINE_ . ';';

        return $this->executeSql();
    }

    public function installCategoryHistory()
    {
        $collation_database = \Db::getInstance()->getValue('SELECT @@collation_database');

        $this->sql = [];

        $this->sql['category_history'] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'gptcontent_category_history` (
                                        `id_category_history` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                        `id_category` int(10) unsigned NOT NULL,
                                        `date_add` datetime DEFAULT NULL,
                                        PRIMARY KEY (`id_category_history`)
        ) COLLATE=\'' . $collation_database . '\' ENGINE=' . _MYSQL_ENGINE_ . ';';

        $this->sql['category_history_lang'] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'gptcontent_category_history_lang` (
                                        `id_category_history` int(10) unsigned NOT NULL,
                                        `id_lang` int(10) unsigned NOT NULL,
                                        `name` varchar(255) DEFAULT NULL,
                                        `description` text DEFAULT NULL,
                                        PRIMARY KEY (`id_category_history`,`id_lang`)
        ) COLLATE=\'' . $collation_database . '\' ENGINE=' . _MYSQL_ENGINE_ . ';';

        return $this->executeSql();
    }

    public function installCmsHistory()
    {
        $collation_database = \Db::getInstance()->getValue('SELECT @@collation_database');

        $this->sql = [];

        $this->sql['cms_history'] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'gptcontent_cms_history` (
                                        `id_cms_history` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                        `id_cms` int(10) unsigned NOT NULL,
                                        `date_add` datetime DEFAULT NULL,
                                        PRIMARY KEY (`id_cms_history`)
        ) COLLATE=\'' . $collation_database . '\' ENGINE=' . _MYSQL_ENGINE_ . ';';

        $this->sql['cms_history_lang'] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'gptcontent_cms_history_lang` (
                                        `id_cms_history` int(10) unsigned NOT NULL,
                                        `id_lang` int(10) unsigned NOT NULL,
                                        `title` varchar(255) DEFAULT NULL,
                                        `content` text DEFAULT NULL,
                                        PRIMARY KEY (`id_cms_history`,`id_lang`)
        ) COLLATE=\'' . $collation_database . '\' ENGINE=' . _MYSQL_ENGINE_ . ';';

        return $this->executeSql();
    }

    public function installBlogCategories()
    {
        $collation_database = \Db::getInstance()->getValue('SELECT @@collation_database');

        $this->sql = [];

        $this->sql['gptcontent_blog_category'] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'gptcontent_blog_category` (
            `id_gptcontent_blog_category` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `id_parent` int(11) UNSIGNED DEFAULT 0,
            `level_depth` tinyint(3) UNSIGNED DEFAULT 0,
            `nleft` int(11) UNSIGNED DEFAULT 0,
            `nright` int(11) UNSIGNED DEFAULT 0,
            `position` int(11) UNSIGNED DEFAULT 0,
            `active` tinyint(1) UNSIGNED DEFAULT 1,
            `date_add` datetime DEFAULT NULL,
            `date_upd` datetime DEFAULT NULL,
            PRIMARY KEY (`id_gptcontent_blog_category`)
        ) COLLATE=\'' . $collation_database . '\' ENGINE=' . _MYSQL_ENGINE_ . ';';

        $this->sql['gptcontent_blog_category_lang'] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'gptcontent_blog_category_lang` (
            `id_gptcontent_blog_category` int(11) UNSIGNED NOT NULL,
            `id_lang` int(11) UNSIGNED NOT NULL,
            `name` varchar(128) DEFAULT NULL,
            `description` text DEFAULT NULL,
            `meta_title` varchar(255) DEFAULT NULL,
            `meta_keywords` varchar(255) DEFAULT NULL,
            `meta_description` varchar(512) DEFAULT NULL,
            `link_rewrite` varchar(128) DEFAULT NULL,
            PRIMARY KEY (`id_gptcontent_blog_category`, `id_lang`)
        ) COLLATE=\'' . $collation_database . '\' ENGINE=' . _MYSQL_ENGINE_ . ';';

        $this->sql['gptcontent_blog_category_post'] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'gptcontent_blog_category_post` (
            `id_gptcontent_blog_category` int(11) UNSIGNED NOT NULL,
            `id_gptcontent_post` int(11) UNSIGNED NOT NULL,
            `is_default` tinyint(1) UNSIGNED DEFAULT 0,
            PRIMARY KEY (`id_gptcontent_blog_category`, `id_gptcontent_post`)
        ) COLLATE=\'' . $collation_database . '\' ENGINE=' . _MYSQL_ENGINE_ . ';';

        if ($res = $this->executeSql()) {
            if (
                !GptContentBlogCategory::createTopCategory()
                || !GptContentBlogCategory::createRootCategory()
            ) {
                $res = false;
            }
        }

        return $res;
    }

    public function installBlogHooks()
    {
        $collation_database = \Db::getInstance()->getValue('SELECT @@collation_database');

        $this->sql = [];

        $this->sql['gptcontent_blog_hook'] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'gptcontent_blog_hook` (
            `id_gptcontent_blog_hook` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `quantity` int(10) UNSIGNED DEFAULT 1,
            `date_start` date DEFAULT NULL,
            `date_end` date DEFAULT NULL,
            `order_way` enum("ASC", "DESC") NOT NULL DEFAULT "ASC",
            `hook_name` varchar(255) DEFAULT NULL,
            `active` tinyint(1) UNSIGNED DEFAULT 0,
            `date_add` datetime DEFAULT NULL,
            `date_upd` datetime DEFAULT NULL,
            PRIMARY KEY (`id_gptcontent_blog_hook`)
        ) COLLATE=\'' . $collation_database . '\' ENGINE=' . _MYSQL_ENGINE_ . ';';

        $this->sql['gptcontent_blog_hook_lang'] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'gptcontent_blog_hook_lang` (
            `id_gptcontent_blog_hook` int(11) UNSIGNED NOT NULL,
            `id_lang` int(11) UNSIGNED NOT NULL,
            `name` varchar(128) DEFAULT NULL,
            PRIMARY KEY (`id_gptcontent_blog_hook`, `id_lang`)
        ) COLLATE=\'' . $collation_database . '\' ENGINE=' . _MYSQL_ENGINE_ . ';';

        return $this->executeSql();
    }

    public function installPostsCron()
    {
        $collation_database = \Db::getInstance()->getValue('SELECT @@collation_database');

        $this->sql = [];

        $this->sql['gptcontent_post_cron'] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'gptcontent_post_cron` (
            `id_gptcontent_post_cron` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` varchar(128) DEFAULT NULL,
            `length_content` int(10) UNSIGNED DEFAULT 400,
            `period` enum("day", "week", "month") NOT NULL DEFAULT "week",
            `quantity` int(10) UNSIGNED DEFAULT 1,
            `type` enum("auto", "custom") NOT NULL DEFAULT "auto",
            `active_post` tinyint(1) UNSIGNED DEFAULT 0,
            `use_produt_image` tinyint(1) UNSIGNED DEFAULT 0,
            `number_links_product` int(10) UNSIGNED DEFAULT 0,
            `active` tinyint(1) UNSIGNED DEFAULT 0,
            `date_add` datetime DEFAULT NULL,
            `date_upd` datetime DEFAULT NULL,
            PRIMARY KEY (`id_gptcontent_post_cron`)
        ) COLLATE=\'' . $collation_database . '\' ENGINE=' . _MYSQL_ENGINE_ . ';';

        $this->sql['gptcontent_post_cron_lang'] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'gptcontent_post_cron_lang` (
            `id_gptcontent_post_cron` int(11) UNSIGNED NOT NULL,
            `id_lang` int(11) UNSIGNED NOT NULL,
            `short_code_title` text NULL,
            `short_code_content` text NULL,
            PRIMARY KEY (`id_gptcontent_post_cron`, `id_lang`)
        ) COLLATE=\'' . $collation_database . '\' ENGINE=' . _MYSQL_ENGINE_ . ';';

        $this->sql['gptcontent_post_cron_category'] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'gptcontent_post_cron_category` (
            `id_gptcontent_post_cron` int(11) UNSIGNED NOT NULL,
            `id_category` int(10) UNSIGNED NOT NULL,
            PRIMARY KEY (`id_gptcontent_post_cron`, `id_category`)
        ) COLLATE=\'' . $collation_database . '\' ENGINE=' . _MYSQL_ENGINE_ . ';';

        return $this->executeSql();
    }

    /**
     * @return bool
     */
    public function install()
    {
        return $this->executeSql()
            && $this->installPosts()
            && $this->installSpinOff()
            && $this->installProductHistory()
            && $this->installCategoryHistory()
            && $this->installCmsHistory()
            && $this->installBlogCategories()
            && $this->installBlogHooks()
            && $this->installPostsCron();
    }

    private function executeSql()
    {
        foreach ($this->sql as $table => $sql) {
            if (!\Db::getInstance()->execute($sql)) {
                $this->errors[] = 'The table ' . $table . ' can not be created';
                return false;
            }
        }

        return true;
    }

    /**
     * @return bool
     */
    public function uninstall()
    {
        foreach ($this->usql as $table => $sql) {
            if (!\Db::getInstance()->execute($sql)) {
                $this->errors[] = 'The table ' . $table . ' can not be removed';
                return false;
            }
        }
        return true;
    }

    /**
     * Get the errors list
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
