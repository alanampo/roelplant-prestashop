<?php

namespace Chatgptcontentgenerator\ProductReviews\Traits;

use Chatgptcontentgenerator\ProductReviews\Models\GptcontentReview;

trait HookTrait
{
    public function hookActionAdminControllerSetMedia($params)
    {
        if ($this->isActive()
            // && $this->controller
            // && $this->controller instanceof \ProductController
        ) {
            $context = \Context::getContext();

            \Media::addJsDef([
                'gptI18nReviews' => [
                    'buttonGenerate' => $this->getTranslator()->trans('Generate', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'generationProcessFailed' => $this->getTranslator()->trans('Generating failed', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'bulkGenerateReviewsButtonName' => $this->getTranslator()->trans('Generate reviews', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'reviewsModalTitle' =>  $this->getTranslator()->trans('Generate product reviews', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'contentLanguageLabel' =>  $this->getTranslator()->trans('Content language', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'authorNameLabel' => $this->getTranslator()->trans('Author name', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'reviewsStatusLabel' => $this->getTranslator()->trans('Status', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'enabled' => $this->getTranslator()->trans('Enabled', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'disabled' => $this->getTranslator()->trans('Disabled', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'reviews' => $this->getTranslator()->trans('reviews', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'nbReviewsPerProductLabel' => $this->getTranslator()->trans('Number of product reviews', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'maxRateLabel' => $this->getTranslator()->trans('Max. rate', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'minRateLabel' => $this->getTranslator()->trans('Min. rate', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'startCreationDateLabel' => $this->getTranslator()->trans('Creation date from', [], 'Modules.Chatgptcontentgenerator.Admin'),
                    'endCreationDateLabel' => $this->getTranslator()->trans('Creation date to', [], 'Modules.Chatgptcontentgenerator.Admin'),
                ],
                'gptReviewsAjaxUrl' => $context->link->getAdminLink('AdminChatGtpReviewsAjax'),
            ]);

            $this->controller->addJs(
                $this->module->getPathUri() . 'views/js/' . $this->getName() . '/admin.reviews.content.js'
            );
            $this->controller->addJs(
                $this->module->getPathUri() . 'views/js/' . $this->getName() . '/admin.products.list.js'
            );
        } 
    }

    public function hookActionFrontControllerSetMedia()
    {
        $this->controller->registerJavascript(
            'front-gpt-reviews',
            '/modules/' . $this->module->name . '/views/js/productreviews/front.js'
        );

        \Media::addJsDef([
            'gpt_reviews_ajax_url' => \Context::getContext()->link->getModuleLink(
                $this->module->name,
                'reviews',
                [
                    'ajax' => 1,
                    'id_product' => (int) \Tools::getValue('id_product'),
                ]
            ),
        ]);
    }

    public function hookDisplayFooterProduct($params)
    {
        $rating = GptcontentReview::getAggregateRatingValueByProductId(\Tools::getValue('id_product'));

        $dateFormatter = new \IntlDateFormatter(
            \Context::getContext()->language->locale,
            \IntlDateFormatter::SHORT,
            \IntlDateFormatter::SHORT
        );

        $authorNameFormat = (int) $this->module->getConfigGlobal('AUTHOR_NAME_FORMAT');
        $reviews = GptcontentReview::getLastReviewsByProductId(\Tools::getValue('id_product'), 5);
        foreach ($reviews as &$review) {
            $publicDate = new \DateTime($review['public_date'], new \DateTimeZone('UTC'));
            $publicDate->setTimezone(new \DateTimeZone(date_default_timezone_get()));
            $review['public_date'] = $dateFormatter->format($publicDate);
            $review['author'] = GptcontentReview::formatAuthorName($review['author'], $authorNameFormat);
        }
        unset($review);

        \Context::getContext()->smarty->assign([
            'nbComments' => $rating['nbComments'],
            'reviews' => $reviews,
        ]);
        return \Context::getContext()->smarty->fetch('module:' . $this->module->name . '/vendor/chatgptcontentgenerator/' . $this->getName() . '/resources/hook/displayFooterProduct.tpl');
    }

    public function hookDisplayHeader()
    {
        $reviews = GptcontentReview::getLastReviewsByProductId(\Tools::getValue('id_product'), 5);

        foreach ($reviews as &$review) {
            $review['description'] = str_replace("\n", ' ', $review['description']);
        }
        unset($review);

        $tpl = \Context::getContext()->smarty->createtemplate($this->getResourcesDir() . 'hook/reviews-jsonld.tpl', \Context::getContext()->smarty);

        $tpl->assign([
            'productObject' => $this->controller->getProduct(),
            'reviews' => $reviews,
            'rating' => GptcontentReview::getAggregateRatingValueByProductId(\Tools::getValue('id_product')),
        ]);

        return $tpl->fetch();
    }

    /**
     * Inject data about productcomments in the product object for frontoffice
     *
     * @param array $params
     *
     * @return array
     */
    public function hookFilterProductContent(array $params)
    {
        $rating = GptcontentReview::getAggregateRatingValueByProductId(\Tools::getValue('id_product'));

        $params['object']->productComments = [
            'averageRating' => $rating['averageRating'],
            'nbComments' => $rating['nbComments'],
        ];

        return $params;
    }
}
