<?php

namespace Chatgptcontentgenerator\ProductReviews\Commands;

use Chatgptcontentgenerator\ProductReviews\Component;
use Chatgptcontentgenerator\ProductReviews\Models\GptcontentReview;

class AjaxGetReviewsCommand
{
    /**
     * @var int
     */
    private $idProduct;

    /**
     * @var \Language
     */
    private $language;

    /**
     * @var Multicomponent\ProductsCleaner\Component
     */
    private $component;

    /**
     * @var int
     */
    private $page;

    /**
     * @var int
     */
    private $limit;

    public function __construct(int $idProduct, \Language $language, Component $component, int $page = 1, int $limit = 5)
    {
        $this->idProduct = $idProduct;
        $this->language = $language;
        $this->component = $component;
        $this->page = $page;
        $this->limit = $limit;
    }

    public function execute()
    {
        $rating = GptcontentReview::getAggregateRatingValueByProductId($this->idProduct);
        $reviews = GptcontentReview::getLastReviewsByProductId($this->idProduct, $this->limit, $this->page);

        $dateFormatter = new \IntlDateFormatter(
            $this->language->locale,
            \IntlDateFormatter::SHORT,
            \IntlDateFormatter::SHORT
        );

        $authorNameFormat = (int) \Configuration::get('CHATGPTCONTENTGENERATOR_AUTHOR_NAME_FORMAT', null, 0, 0, 1);

        foreach ($reviews as &$review) {
            $publicDate = new \DateTime($review['public_date'], new \DateTimeZone('UTC'));
            $publicDate->setTimezone(new \DateTimeZone(date_default_timezone_get()));
            $review['public_date'] = $dateFormatter->format($publicDate);
            $review['author'] = GptcontentReview::formatAuthorName($review['author'], $authorNameFormat);
        }
        unset($review);

        \Context::getContext()->smarty->assign([
            'reviews' => $reviews,
        ]);

        $this->component->jsonResponse([
            'reviewsHtml' => \Context::getContext()->smarty->fetch($this->component->getFetchResourceDir() . 'reviews.tpl'),
            'reviews' => $reviews,
            'total' => $rating['nbComments'],
            'page' => $this->page,
        ]);
    }
}
