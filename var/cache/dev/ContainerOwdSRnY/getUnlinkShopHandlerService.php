<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'PrestaShop\Module\PsAccounts\Account\CommandHandler\UnlinkShopHandler' shared service.

return $this->services['PrestaShop\\Module\\PsAccounts\\Account\\CommandHandler\\UnlinkShopHandler'] = new \PrestaShop\Module\PsAccounts\Account\CommandHandler\UnlinkShopHandler(($this->services['PrestaShop\\Module\\PsAccounts\\Account\\LinkShop'] ?? $this->load('getLinkShopService.php')), ($this->services['PrestaShop\\Module\\PsAccounts\\Service\\AnalyticsService'] ?? $this->load('getAnalyticsServiceService.php')), ($this->services['PrestaShop\\Module\\PsAccounts\\Provider\\ShopProvider'] ?? $this->load('getShopProvider2Service.php')));
