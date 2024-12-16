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
namespace PrestaShop\Module\Chatgptcontentgenerator\Api;

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\Module\Chatgptcontentgenerator\Api\Traits\CategoryTrait;
use PrestaShop\Module\Chatgptcontentgenerator\Api\Traits\CustomRequestTrait;
use PrestaShop\Module\Chatgptcontentgenerator\Api\Traits\ModuleTrait;
use PrestaShop\Module\Chatgptcontentgenerator\Api\Traits\PageTrait;
use PrestaShop\Module\Chatgptcontentgenerator\Api\Traits\PostTrait;
use PrestaShop\Module\Chatgptcontentgenerator\Api\Traits\ProductTrait;
use PrestaShop\Module\Chatgptcontentgenerator\Api\Traits\RewriteTrait;
use PrestaShop\Module\Chatgptcontentgenerator\Api\Traits\ShopTrait;
use PrestaShop\Module\Chatgptcontentgenerator\Api\Traits\TemplateTrait;
use PrestaShop\Module\Chatgptcontentgenerator\Api\Traits\TextTrait;
use PrestaShop\Module\Chatgptcontentgenerator\Api\Traits\ToolsTrait;

class Client
{
    use ProductTrait;
    use CategoryTrait;
    use PageTrait;
    use TextTrait;
    use CustomRequestTrait;
    use ShopTrait;
    use ModuleTrait;
    use TemplateTrait;
    use ToolsTrait;
    use RewriteTrait;
    use PostTrait;

    const ENDPOINT = 'https://saas.softsprint.net/gpt/api';
    const APIHOST = 'https://saas.softsprint.net/gpt';

    /**
     * @var string
     */
    private $shopUid;

    /**
     * @var string
     */
    private $shopToken = '';

    /**
     * @var string
     */
    private $gptApiKey = '';

    /**
     * @var Module
     */
    private $module;

    public function __construct($shopUid)
    {
        $this->shopUid = $shopUid;
    }

    /**
     * @param string $shopUid
     */
    public function setShopUid($shopUid)
    {
        $this->shopUid = $shopUid;
        return $this;
    }

    /**
     * @param string $shopToken
     */
    public function setToken($shopToken)
    {
        $this->shopToken = $shopToken;
        return $this;
    }

    /**
     * @param string $gptApiKey
     */
    public function setGptApiKey($gptApiKey)
    {
        $this->gptApiKey = $gptApiKey;
        return $this;
    }

    /**
     * @param \Module $module
     */
    public function setModule(\Module $module)
    {
        $this->module = $module;
        return $this;
    }

    /**
     * Send post request to the API
     *
     * @param string $uri
     *
     * @return array
     */
    public function sendPostRequest($uri, array $body = [])
    {
        return $this->sendRequest($uri, 'POST', $body);
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $body
     * @return bool|string
     */
    protected function sendRequest(string $uri, string $method = 'GET', array $body = [])
    {
        $headers = [
            'Content-Type: application/x-www-form-urlencoded',
        ];

        // set emppty string for the null fields
        foreach ($body as $field => $value) {
            if (is_null($value)) {
                $body[$field] = '';
            }
        }

        if (!isset($body['modelAi'])) {
            $body['modelAi'] = 'chatgpt';
        }

        // $body['shopToken'] = $this->shopToken;
        $body['module'] = 'chatgptcontentgenerator';
        $body['gptApiKey'] = $this->gptApiKey;
        $body['chatGPTModelId'] = \Configuration::getGlobalValue('CHATGPTCONTENTGENERATOR_GPT_MODEL');

        // generate token
        $keys = array_keys($body);

        $n = rand(0, strlen($this->shopToken) - 1);
        $bytes = bin2hex(random_bytes(rand(5, 10)));

        asort($keys);
        $token = hash('sha256', $this->shopToken . implode('.', $keys) . $this->shopToken);
        $arr = explode($this->shopToken[$n], $this->shopToken);
        $arr = array_reverse($arr);
        $arr = implode('.', $arr) . '.' . $bytes;

        $token = base64_encode($body['module'] . ':' . base64_encode($this->shopToken[$n]) . ':' . $arr . ':' . $token);

        $body = http_build_query($body);

        $headers[] = 'Authorization: Bearer ' . $token;

        $uri = '/' . ltrim($uri, '/');

        $curlInfo = [
            CURLOPT_URL => self::ENDPOINT . $uri,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 180,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => $headers,
        ];

        if (empty($body)) {
            unset($curlInfo[CURLOPT_POSTFIELDS]);
        }

        $curl = curl_init();
        curl_setopt_array($curl, $curlInfo);
        $response = curl_exec($curl);
        curl_close($curl);

        return $this->handleResponseContent($response);
    }

    /**
     * Handle response content
     *
     * @param string $response
     *
     * @return array
     */
    private function handleResponseContent($response)
    {
        $response = json_decode($response, true);
        if (!is_array($response)) {
            return [
                'success' => false,
                'error' => [
                    'message' => 'Unknown response',
                ],
            ];
        }

        return $response;
    }

    /**
     * Get host api url
     *
     * @return string
     */
    public static function getApiHostUrl()
    {
        return self::APIHOST;
    }

    /**
     * Get server address
     *
     * @return string
     */
    public static function getServerIp()
    {
        return isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : '';
    }

    /**
     * Check ChatGPT api key
     *
     * @return bool
     */
    public static function checkAPIKey($key)
    {
        $ch = curl_init();
        $uri = 'https://api.openai.com/v1/models';
        // Set the URL
        curl_setopt($ch, CURLOPT_URL, $uri);

        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $key]);

        // Set the option to return the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Execute the cURL request
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        if (empty($result)) {
            throw new \Exception('ChatGPT: Unknown response');
        }
        if (isset($result['error'])) {
            throw new \Exception('ChatGPT: ' . $result['error']['message']);
        }
        return true;
    }
}
