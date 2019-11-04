<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf131501f1652c2b0cab40f406a506c69
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'askinss\\serverStat\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'askinss\\serverStat\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf131501f1652c2b0cab40f406a506c69::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf131501f1652c2b0cab40f406a506c69::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
