<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5229a46e9a2eb3d0c4202dfd59a0a1d9
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Modules\\DigitalSignature\\' => 25,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Modules\\DigitalSignature\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Modules\\DigitalSignature\\Database\\Seeders\\DigitalSignatureDatabaseSeeder' => __DIR__ . '/../..' . '/Database/Seeders/DigitalSignatureDatabaseSeeder.php',
        'Modules\\DigitalSignature\\Http\\Controllers\\DigitalSignatureController' => __DIR__ . '/../..' . '/Http/Controllers/DigitalSignatureController.php',
        'Modules\\DigitalSignature\\Providers\\DigitalSignatureServiceProvider' => __DIR__ . '/../..' . '/Providers/DigitalSignatureServiceProvider.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5229a46e9a2eb3d0c4202dfd59a0a1d9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5229a46e9a2eb3d0c4202dfd59a0a1d9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5229a46e9a2eb3d0c4202dfd59a0a1d9::$classMap;

        }, null, ClassLoader::class);
    }
}
