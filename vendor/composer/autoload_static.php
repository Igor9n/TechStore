<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit66ea791a170e7e5701e89e83130e42b7
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stereolog\\' => 10,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stereolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/stereolog/stereolog/src/Stereolog',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit66ea791a170e7e5701e89e83130e42b7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit66ea791a170e7e5701e89e83130e42b7::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
