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

namespace PrestaShop\Module\Chatgptcontentgenerator\Entity;

if (!defined('_PS_VERSION_')) {
    exit;
}

class GptContentPostCron extends \ObjectModel
{
    public $name;
    public $length_content = 400;
    public $period;
    public $quantity = 1;
    public $type;
    public $active_post = false;
    public $use_produt_image = false;
    public $number_links_product = 0;
    public $active = true;
    public $date_add;
    public $date_upd;

    public $short_code_title;
    public $short_code_content;

    const PERIOD_DAY = 'day';
    const PERIOD_WEEK = 'week';
    const PERIOD_MONTH = 'month';

    const TYPE_AUTO = 'auto';
    const TYPE_CUSTOM = 'custom';

    public static $definition = [
        'table' => 'gptcontent_post_cron',
        'primary' => 'id_gptcontent_post_cron',
        'multilang' => true,
        'fields' => [
            'name' => ['type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'required' => true, 'size' => 128],
            'length_content' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true],
            'period' => ['type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'required' => true],
            'quantity' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true],
            'type' => ['type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'required' => true],
            'active_post' => ['type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true],
            'use_produt_image' => ['type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true],
            'number_links_product' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => false],
            'active' => ['type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true],
            'date_add' => ['type' => self::TYPE_DATE, 'validate' => 'isDate'],
            'date_upd' => ['type' => self::TYPE_DATE, 'validate' => 'isDate'],

            /* Lang fields */
            'short_code_title' => ['type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml'],
            'short_code_content' => ['type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml'],
        ],
    ];

    public static function getPeriods($isHelper = false)
    {
        $periods = [
            self::PERIOD_DAY => ucfirst(self::PERIOD_DAY),
            self::PERIOD_WEEK => ucfirst(self::PERIOD_WEEK),
            self::PERIOD_MONTH => ucfirst(self::PERIOD_MONTH),
        ];

        if (true === $isHelper) {
            foreach ($periods as $key => &$period) {
                $period = [
                    'id' => $key,
                    'name' => $period,
                ];
            }
        }

        return $periods;
    }

    public static function getTypes($isHelper = false)
    {
        $types = [
            self::TYPE_AUTO => ucfirst(self::TYPE_AUTO),
            self::TYPE_CUSTOM => ucfirst(self::TYPE_CUSTOM),
        ];

        if (true === $isHelper) {
            foreach ($types as $key => &$type) {
                $type = [
                    'id' => $key,
                    'name' => $type,
                ];
            }
        }

        return $types;
    }

    public function deleteCategories()
    {
        return \Db::getInstance()->delete(
            self::$definition['table'] . '_category',
            self::$definition['primary'] . ' = ' . (int) $this->id
        );
    }

    public function addToCategories($categories = [])
    {
        if (
            !$this->id
            || empty($categories)
        ) {
            return false;
        }

        if (!is_array($categories)) {
            $categories = [$categories];
        }

        $cronCategories = [];

        foreach ($categories as $idCategory) {
            $cronCategories[] = [
                self::$definition['primary'] => (int) $this->id,
                'id_category' => (int) $idCategory,
            ];
        }

        return \Db::getInstance()->insert(self::$definition['table'] . '_category', $cronCategories);
    }

    public function getCategories()
    {
        $query = new \DbQuery();
        $query->select('id_category')
            ->from(self::$definition['table'] . '_category')
            ->where(self::$definition['primary'] . ' = ' . (int) $this->id);

        return array_column(\Db::getInstance()->executeS($query), 'id_category');
    }

    public function getProducts()
    {
        $query = new \DbQuery();
        $query->select('cp.`id_product`')
            ->from(self::$definition['table'] . '_category', 'gcpc')
            ->innerJoin('category_product', 'cp', 'gcpc.`id_category` = cp.`id_category`')
            ->where('gcpc.' . self::$definition['primary'] . ' = ' . (int) $this->id)
            ->orderBy('cp.`id_product`')
            ->groupBy('cp.`id_product`')
        ;

        return array_column(\Db::getInstance()->executeS($query), 'id_product');
    }

    public function isCustomRequest()
    {
        return $this->type === self::TYPE_CUSTOM;
    }

    public static function getCronTokenById($id)
    {
        $shop = new \Shop((int) \Configuration::get('PS_SHOP_DEFAULT'));

        $data = [
            'chatgptcontentgenerator',
            $shop->domain,
            (int) $id,
        ];

        return md5(implode('|', $data));
    }

    public function checkCronTime()
    {
        return true;
    }
}
