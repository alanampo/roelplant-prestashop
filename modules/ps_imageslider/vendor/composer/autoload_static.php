<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit745eb634aa35bcfa4ff4a23c09d794d1
{
    public static $classMap = array (
        'Ps_ImageSlider' => __DIR__ . '/../..' . '/ps_imageslider.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit745eb634aa35bcfa4ff4a23c09d794d1::$classMap;

        }, null, ClassLoader::class);
    }
}
