<?php

namespace Chatgptcontentgenerator\ProductReviews\Models;

class GptcontentReview extends \ObjectModel
{
    public $id_product;
    public $rate;
    public $active = false;
    public $author;
    public $description;
    public $public_date;
    public $date_add;
    public $date_upd;

    public static $definition = [
        'table' => 'gptcontent_review',
        'primary' => 'id_gptcontent_review',
        'multilang' => false,
        'fields' => [
            'id_product' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'],
            'rate' => ['type' => self::TYPE_FLOAT],
            'active' => ['type' => self::TYPE_BOOL],
            'author' => ['type' => self::TYPE_STRING, 'validate' => 'isString'],
            'description' => ['type' => self::TYPE_STRING, 'validate' => 'isString'],
            'public_date' => ['type' => self::TYPE_DATE, 'validate' => 'isDate'],
            'date_add' => ['type' => self::TYPE_DATE, 'validate' => 'isDate'],
            'date_upd' => ['type' => self::TYPE_DATE, 'validate' => 'isDate'],
        ],
    ];

    public static function getLastReviewsByProductId($productId, $limit = 10, $page = 1)
    {
        if ($page < 1) {
            $page = 1;
        }

        return \Db::getInstance()->executeS('
            SELECT * FROM ' . _DB_PREFIX_ . 'gptcontent_review
            WHERE id_product = ' . (int) $productId . '
                AND active = 1
                AND public_date <= \'' . date('Y-m-d 23:59:59') . '\'
            ORDER BY public_date DESC
            ' . ($limit ? ' LIMIT ' . (($page - 1) * $limit) . ', ' . (int) $limit : '') . '
        ');
    }

    public static function getAggregateRatingValueByProductId($productId)
    {
        $reviewsData = \Db::getInstance()->getRow('
            SELECT
                SUM(IFNULL(rate, 0)) AS total_rate,
                SUM(1) AS nb_reviews
            FROM ' . _DB_PREFIX_ . 'gptcontent_review
            WHERE id_product = ' . (int) $productId . '
                AND active = 1
                AND public_date <= \'' . date('Y-m-d 23:59:59') . '\'
        ');

        return [
            'averageRating' => (($reviewsData && $reviewsData['nb_reviews'] > 0) ? ((int) $reviewsData['total_rate'] / (int) $reviewsData['nb_reviews']) : 0),
            'nbComments' => (int) $reviewsData['nb_reviews'],
        ];
    }

    public static function formatAuthorName($name, $format)
    {
        if ($format == 2) { // John D.
            $arr = explode(' ', $name);
            return trim(
                (isset($arr[0]) ? $arr[0] . ' ' : '') .
                    (isset($arr[1]) ? substr($arr[1], 0, 1) . '.' : '')
            );
        } elseif ($format == 3) { // J. Doe
            $arr = explode(' ', $name);
            return trim(
                (isset($arr[0]) ? substr($arr[0], 0, 1) . '. ' : '') .
                    (isset($arr[1]) ? $arr[1] : '')
            );
        }

        return $name;
    }
}
