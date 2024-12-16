<?php

class EntityManager_9a5be93 extends \Doctrine\ORM\EntityManager implements \ProxyManager\Proxy\VirtualProxyInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager|null wrapped object, if the proxy is initialized
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

    public function getConnection()
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'getConnection', array(), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->getConnection();
    }

    public function getMetadataFactory()
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'getMetadataFactory', array(), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->getMetadataFactory();
    }

    public function getExpressionBuilder()
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'getExpressionBuilder', array(), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->getExpressionBuilder();
    }

    public function beginTransaction()
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'beginTransaction', array(), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->beginTransaction();
    }

    public function getCache()
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'getCache', array(), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->getCache();
    }

    public function transactional($func)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'transactional', array('func' => $func), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->transactional($func);
    }

    public function wrapInTransaction(callable $func)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'wrapInTransaction', array('func' => $func), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->wrapInTransaction($func);
    }

    public function commit()
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'commit', array(), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->commit();
    }

    public function rollback()
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'rollback', array(), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->rollback();
    }

    public function getClassMetadata($className)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'getClassMetadata', array('className' => $className), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->getClassMetadata($className);
    }

    public function createQuery($dql = '')
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'createQuery', array('dql' => $dql), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->createQuery($dql);
    }

    public function createNamedQuery($name)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'createNamedQuery', array('name' => $name), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->createNamedQuery($name);
    }

    public function createNativeQuery($sql, \Doctrine\ORM\Query\ResultSetMapping $rsm)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'createNativeQuery', array('sql' => $sql, 'rsm' => $rsm), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->createNativeQuery($sql, $rsm);
    }

    public function createNamedNativeQuery($name)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'createNamedNativeQuery', array('name' => $name), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->createNamedNativeQuery($name);
    }

    public function createQueryBuilder()
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'createQueryBuilder', array(), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->createQueryBuilder();
    }

    public function flush($entity = null)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'flush', array('entity' => $entity), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->flush($entity);
    }

    public function find($className, $id, $lockMode = null, $lockVersion = null)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'find', array('className' => $className, 'id' => $id, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->find($className, $id, $lockMode, $lockVersion);
    }

    public function getReference($entityName, $id)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'getReference', array('entityName' => $entityName, 'id' => $id), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->getReference($entityName, $id);
    }

    public function getPartialReference($entityName, $identifier)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'getPartialReference', array('entityName' => $entityName, 'identifier' => $identifier), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->getPartialReference($entityName, $identifier);
    }

    public function clear($entityName = null)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'clear', array('entityName' => $entityName), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->clear($entityName);
    }

    public function close()
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'close', array(), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->close();
    }

    public function persist($entity)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'persist', array('entity' => $entity), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->persist($entity);
    }

    public function remove($entity)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'remove', array('entity' => $entity), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->remove($entity);
    }

    public function refresh($entity)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'refresh', array('entity' => $entity), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->refresh($entity);
    }

    public function detach($entity)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'detach', array('entity' => $entity), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->detach($entity);
    }

    public function merge($entity)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'merge', array('entity' => $entity), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->merge($entity);
    }

    public function copy($entity, $deep = false)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'copy', array('entity' => $entity, 'deep' => $deep), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->copy($entity, $deep);
    }

    public function lock($entity, $lockMode, $lockVersion = null)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'lock', array('entity' => $entity, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->lock($entity, $lockMode, $lockVersion);
    }

    public function getRepository($entityName)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'getRepository', array('entityName' => $entityName), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->getRepository($entityName);
    }

    public function contains($entity)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'contains', array('entity' => $entity), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->contains($entity);
    }

    public function getEventManager()
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'getEventManager', array(), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->getEventManager();
    }

    public function getConfiguration()
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'getConfiguration', array(), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->getConfiguration();
    }

    public function isOpen()
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'isOpen', array(), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->isOpen();
    }

    public function getUnitOfWork()
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'getUnitOfWork', array(), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->getUnitOfWork();
    }

    public function getHydrator($hydrationMode)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'getHydrator', array('hydrationMode' => $hydrationMode), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->getHydrator($hydrationMode);
    }

    public function newHydrator($hydrationMode)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'newHydrator', array('hydrationMode' => $hydrationMode), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->newHydrator($hydrationMode);
    }

    public function getProxyFactory()
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'getProxyFactory', array(), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->getProxyFactory();
    }

    public function initializeObject($obj)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'initializeObject', array('obj' => $obj), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->initializeObject($obj);
    }

    public function getFilters()
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'getFilters', array(), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->getFilters();
    }

    public function isFiltersStateClean()
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'isFiltersStateClean', array(), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->isFiltersStateClean();
    }

    public function hasFilters()
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, 'hasFilters', array(), $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        return $this->valueHolderb02a7->hasFilters();
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

        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $instance, 'Doctrine\\ORM\\EntityManager')->__invoke($instance);

        $instance->initializere486c = $initializer;

        return $instance;
    }

    protected function __construct(\Doctrine\DBAL\Connection $conn, \Doctrine\ORM\Configuration $config, \Doctrine\Common\EventManager $eventManager)
    {
        static $reflection;

        if (! $this->valueHolderb02a7) {
            $reflection = $reflection ?? new \ReflectionClass('Doctrine\\ORM\\EntityManager');
            $this->valueHolderb02a7 = $reflection->newInstanceWithoutConstructor();
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);

        }

        $this->valueHolderb02a7->__construct($conn, $config, $eventManager);
    }

    public function & __get($name)
    {
        $this->initializere486c && ($this->initializere486c->__invoke($valueHolderb02a7, $this, '__get', ['name' => $name], $this->initializere486c) || 1) && $this->valueHolderb02a7 = $valueHolderb02a7;

        if (isset(self::$publicProperties555a5[$name])) {
            return $this->valueHolderb02a7->$name;
        }

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

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

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

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

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

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

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

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
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);
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
