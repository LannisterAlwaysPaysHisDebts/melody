<?php


namespace Melody;

use \ArrayAccess;

class Config implements ArrayAccess
{
    private $config = [];

    protected function __construct()
    {
        define("ROOT", realpath('.'));
        define("MELODY", realpath("./melody/"));

        // 加载主要配置文件
        $this->load(MELODY . "/config/main.php");
    }

    public function load($file)
    {
        if (!is_file($file)) {
            return false;
        }
        $data = require $file;
        if (!is_array($data)) {
            return false;
        }

        $this->config = array_merge($this->config, $data);
        return true;
    }

    static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function offsetGet($offset)
    {
        return isset($this->config[$offset]) ? $this->config[$offset] : false;
    }

    public function offsetSet($offset, $value)
    {
        $this->config[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        return false;
    }

    public function offsetExists($offset)
    {
        return isset($this->config[$offset]);
    }
}