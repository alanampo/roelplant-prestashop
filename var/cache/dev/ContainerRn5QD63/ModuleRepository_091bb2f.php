<?php

class ModuleRepository_091bb2f extends \PrestaShop\PrestaShop\Core\Module\ModuleRepository implements \ProxyManager\Proxy\VirtualProxyInterface
{
    /**
     * @var \PrestaShop\PrestaShop\Core\Module\ModuleRepository|null wrapped object, if the proxy is initialized
     */
    private $valueHolderb02a7 = null;

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializere486c = null;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicProperties555a5 = [
        
    ];

    public function getList() : \PrestaShop\PrestaShop\Core\Module\ModuleCollection
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'getList', array(), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->getList();
    }

    public function getInstalledModules() : \PrestaShop\PrestaShop\Core\Module\ModuleCollection
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'getInstalledModules', array(), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->getInstalledModules();
    }

    public function getMustBeConfiguredModules() : \PrestaShop\PrestaShop\Core\Module\ModuleCollection
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'getMustBeConfiguredModules', array(), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->getMustBeConfiguredModules();
    }

    public function getUpgradableModules() : \PrestaShop\PrestaShop\Core\Module\ModuleCollection
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'getUpgradableModules', array(), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->getUpgradableModules();
    }

    public function getModule(string $moduleName) : \PrestaShop\PrestaShop\Core\Module\ModuleInterface
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'getModule', array('moduleName' => $moduleName), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->getModule($moduleName);
    }

    public function getModulePath(string $moduleName) : ?string
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'getModulePath', array('moduleName' => $moduleName), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->getModulePath($moduleName);
    }

    public function setActionUrls(\PrestaShop\PrestaShop\Core\Module\ModuleCollection $collection) : \PrestaShop\PrestaShop\Core\Module\ModuleCollection
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'setActionUrls', array('collection' => $collection), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->setActionUrls($collection);
    }

    public function clearCache(?string $moduleName = null, bool $allShops = false) : bool
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'clearCache', array('moduleName' => $moduleName, 'allShops' => $allShops), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->clearCache($moduleName, $allShops);
    }

    /**
     * Constructor for lazy initialization
     *
     * @param \Closure|null $initializer
     */
    public static function staticProxyConstructor($initializer)
    {
        static $reflection;

        $reflection = $reflection ?? new \ReflectionClass(__CLASS__);
        $instance   = $reflection->newInstanceWithoutConstructor();

        \Closure::bind(function (\PrestaShop\PrestaShop\Core\Module\ModuleRepository $instance) {
            unset($instance->moduleDataProvider, $instance->adminModuleDataProvider, $instance->hookManager, $instance->cacheProvider, $instance->modulePath, $instance->installedModules, $instance->modulesFromHook, $instance->contextLangId);
        }, $instance, 'PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository')->__invoke($instance);

        $instance->initializere486c = $initializer;

        return $instance;
    }

    public function __construct(\PrestaShop\PrestaShop\Adapter\Module\ModuleDataProvider $moduleDataProvider, \PrestaShop\PrestaShop\Adapter\Module\AdminModuleDataProvider $adminModuleDataProvider, \Doctrine\Common\Cache\CacheProvider $cacheProvider, \PrestaShop\PrestaShop\Adapter\HookManager $hookManager, string $modulePath, int $contextLangId)
    {
        static $reflection;

        if (! $this->valueHolderb02a7) {
            $reflection = $reflection ?? new \ReflectionClass('PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository');
            $this->valueHolderb02a7 = $reflection->newInstanceWithoutConstructor();
        \Closure::bind(function (\PrestaShop\PrestaShop\Core\Module\ModuleRepository $instance) {
            unset($instance->moduleDataProvider, $instance->adminModuleDataProvider, $instance->hookManager, $instance->cacheProvider, $instance->modulePath, $instance->installedModules, $instance->modulesFromHook, $instance->contextLangId);
        }, $this, 'PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository')->__invoke($this);

        }

        $this->valueHolderb02a7->__construct($moduleDataProvider, $adminModuleDataProvider, $cacheProvider, $hookManager, $modulePath, $contextLangId);
    }

    public function & __get($name)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, '__get', ['name' => $name], $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        if (isset(self::$publicProperties555a5[$name])) {
            return $this->valueHolderb02a7->$name;
        }

        $realInstanceReflection = new \ReflectionClass('PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderb02a7;

            $backtrace = debug_backtrace(false, 1);
            trigger_error(
                sprintf(
                    'Undefined property: %s::$%s in %s on line %s',
                    $realInstanceReflection->getName(),
                    $name,
                    $backtrace[0]['file'],
                    $backtrace[0]['line']
                ),
                \E_USER_NOTICE
            );
            return $targetObject->$name;
        }

        $targetObject = $this->valueHolderb02a7;
        $accessor = function & () use ($targetObject, $name) {
            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __set($name, $value)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, '__set', array('name' => $name, 'value' => $value), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        $realInstanceReflection = new \ReflectionClass('PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderb02a7;

            $targetObject->$name = $value;

            return $targetObject->$name;
        }

        $targetObject = $this->valueHolderb02a7;
        $accessor = function & () use ($targetObject, $name, $value) {
            $targetObject->$name = $value;

            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __isset($name)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, '__isset', array('name' => $name), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        $realInstanceReflection = new \ReflectionClass('PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderb02a7;

            return isset($targetObject->$name);
        }

        $targetObject = $this->valueHolderb02a7;
        $accessor = function () use ($targetObject, $name) {
            return isset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __unset($name)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, '__unset', array('name' => $name), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        $realInstanceReflection = new \ReflectionClass('PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderb02a7;

            unset($targetObject->$name);

            return;
        }

        $targetObject = $this->valueHolderb02a7;
        $accessor = function () use ($targetObject, $name) {
            unset($targetObject->$name);

            return;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $accessor();
    }

    public function __clone()
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, '__clone', array(), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        $this->valueHolderb02a7 = clone $this->valueHolderb02a7;
    }

    public function __sleep()
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, '__sleep', array(), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return array('valueHolderb02a7');
    }

    public function __wakeup()
    {
        \Closure::bind(function (\PrestaShop\PrestaShop\Core\Module\ModuleRepository $instance) {
            unset($instance->moduleDataProvider, $instance->adminModuleDataProvider, $instance->hookManager, $instance->cacheProvider, $instance->modulePath, $instance->installedModules, $instance->modulesFromHook, $instance->contextLangId);
        }, $this, 'PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository')->__invoke($this);
    }

    public function setProxyInitializer(\Closure $initializer = null) : void
    {
        $this->initializere486c = $initializer;
    }

    public function getProxyInitializer() : ?\Closure
    {
        return $this->initializere486c;
    }

    public function initializeProxy() : bool
    {
        return $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'initializeProxy', array(), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;
    }

    public function isProxyInitialized() : bool
    {
        return null !== $this->valueHolderb02a7;
    }

    public function getWrappedValueHolderValue()
    {
        return $this->valueHolderb02a7;
    }
}
