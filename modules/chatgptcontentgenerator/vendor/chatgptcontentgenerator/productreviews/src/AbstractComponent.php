<?php

namespace Chatgptcontentgenerator\ProductReviews;

use Chatgptcontentgenerator\ProductReviews\Traits\ResponseTrait;
use PrestaShop\PrestaShop\Core\FeatureFlag\FeatureFlagSettings;

abstract class AbstractComponent
{
    use ResponseTrait;

    protected $controller;
    protected $smarty;
    protected $module;
    protected $errors = [];

    /**
     * @var bool
     */
    protected $active;

    public function setController($controller)
    {
        $this->controller = $controller;
        return $this;
    }

    public function setSmarty($smarty)
    {
        $this->smarty = $smarty;
        return $this;
    }

    public function setModule($module)
    {
        $this->module = $module;
        return $this;
    }

    public function setActive($active)
    {
        $this->active = (bool) $active;
        return $this;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function isActive()
    {
        return $this->getActive() === true;
    }

    public function getTranslator()
    {
        return \Context::getContext()->getTranslator();
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
        ];
    }

    public function getResourcesDir()
    {
        return _PS_MODULE_DIR_ . 'chatgptcontentgenerator/vendor/chatgptcontentgenerator/' . $this->getName() . '/resources/';
    }

    public function getFetchResourceDir()
    {
        return 'module:' . $this->module->name . '/vendor/chatgptcontentgenerator/' . $this->getName() . '/resources/hook/';
    }

    public function isProductFormV2()
    {
        return (int) \Db::getInstance()->getValue(
                'SELECT `state` FROM ' . _DB_PREFIX_ . 'feature_flag
                WHERE `name` = \'' . FeatureFlagSettings::FEATURE_FLAG_PRODUCT_PAGE_V2 . '\''
            ) == 1;
    }
}
