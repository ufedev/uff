<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit54c11f93d1fb49c90fe74d9a82c3dee9
{
    public static $files = array (
        '8666530795a349866a5c08062b82b8ef' => __DIR__ . '/../..' . '/src/snippets.php',
    );

    public static $prefixLengthsPsr4 = array (
        'U' => 
        array (
            'Uff\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Uff\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/uff',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit54c11f93d1fb49c90fe74d9a82c3dee9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit54c11f93d1fb49c90fe74d9a82c3dee9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit54c11f93d1fb49c90fe74d9a82c3dee9::$classMap;

        }, null, ClassLoader::class);
    }
}