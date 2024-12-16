<?php

namespace Chatgptcontentgenerator\ProductReviews;

use Chatgptcontentgenerator\ProductReviews\Traits\ConfigurationTrait;
use Chatgptcontentgenerator\ProductReviews\Traits\ControllerTrait;
use Chatgptcontentgenerator\ProductReviews\Traits\HookTrait;

class Component extends AbstractComponent implements ComponentInterface
{
    use ConfigurationTrait;
    use ControllerTrait;
    use HookTrait;

    public function getName()
    {
        return 'productreviews';
    }

    public function getTitle()
    {
        return $this->getTranslator()->trans('Product reviews', [], 'Modules.Chatgptcontentgenerator.Admin');
    }

    public function getDescription()
    {
        return $this->getTranslator()->trans('Product reviews generator', [], 'Modules.Chatgptcontentgenerator.Admin');
    }

    public function install()
    {
        try {
            if ($this->module) {
                $this->module->registerHook('displayHeader');
                $this->module->registerHook('displayFooterProduct');
                $this->module->registerHook('filterProductContent');

                $this->sqlInstall();

                $this->installTabs();
            }
        } catch (\Exception $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
        return true;
    }

    public function uninstall()
    {
        try {
            $this->sqlUninstall();

            (new \Tab(\Tab::getIdFromClassName('AdminChatGtpReviewsAjax')))->delete();

            $this->module->deleteConfig('AUTHOR_NAME_FORMAT');
        } catch (\Exception $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
        return true;
    }

    public function enable()
    {
        return true;
    }

    public function disable()
    {
        return true;
    }

    public function getActive()
    {
        return true;
    }

    private function installTabs()
    {
        $this->module->installTabs([
            [
                'visible' => true,
                'class_name' => 'AdminChatGtpReviewsAjax',
                'name' => $this->getTranslator()->trans('Gpt Reviews Ajax', [], 'Modules.Multitool.Admin'),
                'id_parent' => -1,
                'icon' => null,
            ],
            [
                'visible' => true,
                'class_name' => 'AdminChatGtpReviews',
                'name' => $this->getTranslator()->trans('Product Reviews', [], 'Modules.Multitool.Admin'),
                'parent_class_name' => 'AdminCatalog',
                'icon' => null,
            ],
        ]);
    }

    public function sqlInstall()
    {
        $sql = [];

        $sql[] = "CREATE TABLE IF NOT EXISTS `" . _DB_PREFIX_ . "gptcontent_review` (
                `id_gptcontent_review` int(11) NOT NULL AUTO_INCREMENT,
                `id_product` int(11) NOT NULL,
                `rate` decimal(5,2) DEFAULT 0.00,
                `active` tinyint(1) DEFAULT 0,
                `author` varchar(255) DEFAULT NULL,
                `description` text DEFAULT NULL,
                `public_date` datetime DEFAULT NULL,
                `date_add` datetime DEFAULT NULL,
                `date_upd` datetime DEFAULT NULL,
            PRIMARY KEY (`id_gptcontent_review`)
        ) ENGINE=" . _MYSQL_ENGINE_ . " DEFAULT CHARSET=utf8";

        foreach ($sql as $query) {
            if (false === \Db::getInstance()->execute($query)) {
                return false;
            }
        }

        return true;
    }

    public function sqlUninstall()
    {
        $sql = "DROP TABLE IF EXISTS `" . _DB_PREFIX_ . "gptcontent_review`";

        return \Db::getInstance()->execute($sql);
    }
}
