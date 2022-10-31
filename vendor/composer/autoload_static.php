<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4bfd099ad800de21043ceff611b77034
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'LCong\\Ldap\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'LCong\\Ldap\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4bfd099ad800de21043ceff611b77034::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4bfd099ad800de21043ceff611b77034::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4bfd099ad800de21043ceff611b77034::$classMap;

        }, null, ClassLoader::class);
    }
}