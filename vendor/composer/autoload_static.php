<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit015c0f60a3620e1e65e7ef3cbf644d64
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Lenovo\\JwtApi\\' => 14,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Lenovo\\JwtApi\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit015c0f60a3620e1e65e7ef3cbf644d64::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit015c0f60a3620e1e65e7ef3cbf644d64::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit015c0f60a3620e1e65e7ef3cbf644d64::$classMap;

        }, null, ClassLoader::class);
    }
}
