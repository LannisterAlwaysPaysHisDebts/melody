<?php
namespace Melody;

class Db
{
    protected static $connection;

    protected static $config = [];

    public static function init($config = [])
    {
        self::$config = $config;
    }

    public static function getConfig($name = '')
    {
        if ('' === $name) {
            return self::$config;
        }

        return isset(self::$config[$name]) ? self::$config[$name] : null;
    }
}