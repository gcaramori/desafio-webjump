<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitd041de8d02d38cec44c14de7058fb16e
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitd041de8d02d38cec44c14de7058fb16e', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitd041de8d02d38cec44c14de7058fb16e', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitd041de8d02d38cec44c14de7058fb16e::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}