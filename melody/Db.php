<?php
/**
 * Db
 */

namespace Melody;

class Db
{
    protected static $connection;

    protected static $config = [];

    public static function get()
    {
        $config = Register::get("Config");
        $dbSource = "Melody\\Db\\" . $config['source_name'];
        $db = Register::get($dbSource, [$config['db_default']]);
        return $db->connect();
    }

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