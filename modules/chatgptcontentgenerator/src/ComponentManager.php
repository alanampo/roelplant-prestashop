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

namespace PrestaShop\Module\Chatgptcontentgenerator;

if (!defined('_PS_VERSION_')) {
    exit;
}

use Chatgptcontentgenerator\ProductReviews\Component as ProductReviewsComponent;
use Chatgptcontentgenerator\ProductReviews\ComponentInterface;

class ComponentManager
{
    public static function getList()
    {
        return [
            'productreviews' => ProductReviewsComponent::class,
        ];
    }

    public static function getAllComponents()
    {
        $components = self::getList();

        $result = [];

        foreach ($components as $componentClass) {
            $result[] = new $componentClass();
        }

        return $result;
    }

    public static function componentsToArray(array $components)
    {
        $result = [];

        foreach ($components as $component) {
            $result[] = $component->toArray();
        }

        return $result;
    }

    public static function getInstanceByName($name)
    {
        $components = self::getList();
        if (!isset($components[$name])) {
            throw new \Exception(sprintf('The component "%s" is not available', $name));
        }

        $componentClass = $components[$name];
        $component = new $componentClass();
        // $component->setActive(
        //     (int) MultiComponent::getInstanceByName($component->getName())->active == 1
        // );
        $component->setActive(true);

        if (($component instanceof ComponentInterface) == false) {
            throw new \Exception(sprintf('The "%s" component must implement %s', $name, ComponentInterface::class));
        }

        return $component;
    }

    public static function uninstallAll()
    {
        $components = self::getList();
        foreach ($components as $componentName => $componentClass) {
            // $entity = MultiComponent::getInstanceByName($componentName);
            // if ($entity->id) {
            $component = new $componentClass();
            $component->uninstall();

            // $entity->delete();
            // }
        }
    }

    public static function executeHook(
        $hookName,
        $hookParams,
        ?\Module $module = null,
        ?\Controller $controller = null,
        $smarty = null
    ) {
        // $activeComponents = MultiComponent::getActiveList();
        $components = self::getList();
        $method = 'hook' . ucfirst($hookName);
        $output = null;
        // foreach ($activeComponents as $componentName) {
        foreach ($components as $componentClass) {
            // if (isset($components[$componentName])) {
            // $componentClass = $components[$componentName];
            $object = new $componentClass();
            // $object->setActive(true);
            if ($object->isActive() == false) {
                // ignore component if not active
                continue;
            }
            if (!is_callable([$object, $method])) {
                continue;
            }
            $object->setModule($module)
                ->setController($controller)
                ->setSmarty($smarty);

            $return = $object->{$method}($hookParams);
            if (is_null($return)) {
                continue;
            }

            if (is_null($output)) {
                $output = $return;
                continue;
            }
            if (is_array($return)) {
                $output = array_merge($output, $return);
            } elseif (is_string($return)) {
                $output .= $return;
            } elseif (is_bool($return)) {
                $output &= $return;
            }
            // }
        }

        return $output;
    }
}
