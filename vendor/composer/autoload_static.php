<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit48759560185316f16b49698c51edadb3
{
    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'Kercode\\Projet\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Kercode\\Projet\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit48759560185316f16b49698c51edadb3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit48759560185316f16b49698c51edadb3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit48759560185316f16b49698c51edadb3::$classMap;

        }, null, ClassLoader::class);
    }
}
