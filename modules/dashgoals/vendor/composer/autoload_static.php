<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitac267cbb4ca6945ca3bff3c3a219e331
{
    public static $classMap = array (
        'AdminDashgoalsController' => __DIR__ . '/../..' . '/controllers/admin/AdminDashgoalsController.php',
        'dashgoals' => __DIR__ . '/../..' . '/dashgoals.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInitac267cbb4ca6945ca3bff3c3a219e331::$classMap;

        }, null, ClassLoader::class);
    }
}