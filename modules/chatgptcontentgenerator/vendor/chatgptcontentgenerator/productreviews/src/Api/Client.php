<?php

namespace Chatgptcontentgenerator\ProductReviews\Api;

use PrestaShop\Module\Chatgptcontentgenerator\Api\Client as SaasClient;

class Client extends SaasClient
{
    public function generateProductReview(
        $productName,
        $langIsoCode,
        $rate,
        $textLength = 0,
        $productDescription = null
    ) {
        if (!is_numeric($textLength)) {
            throw new \Exception('The text length is not valid');
        }

        $response = $this->sendRequest(
            '/reviews/generate-review',
            'POST',
            [
                'productName' => $productName,
                'productDescription' => $productDescription,
                'maxLength' => $textLength,
                'langIsoCode' => $langIsoCode,
                'rate' => $rate,
            ]
        );

        if (!isset($response['text'])) {
            $code = (isset($response['error']['code']) ? $response['error']['code'] : 0);
            throw new \Exception($response['error']['message'], $code);
        }

        return $response;
    }
}
