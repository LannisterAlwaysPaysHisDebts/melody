<?php
/**
 *
 *
 */

namespace Melody;

use ArrayAccess;
use ReflectionClass;
use ReflectionException;

class Register implements ArrayAccess
{
    private static $instance = null;

    private $tree = [];

    protected function __construct()
    {
    }

    /**
     * @return Register
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 获取对应类的实例
     * @param string $className
     * @param array $args
     * @return object
     */
    public static function get($className, $args = [])
    {
        if (!self::getInstance()->offsetExists($className)) {
            try {
                $reflect = new ReflectionClass($className);
            } catch (ReflectionException $e) {
                exit('ReflectException!');
            }
            self::getInstance()->offsetSet($className, $reflect->newInstanceArgs($args));
        }
        return self::getInstance()[$className];
    }

    public function offsetSet($offset, $value)
    {
        $this->tree[$offset] = $value;
    }

    public function offsetGet($offset)
    {
        return $this->tree[$offset];
    }

    public function offsetExists($offset)
    {
        return isset($this->tree[$offset]);
    }

    public function offsetUnset($offset)
    {
        if (isset($this->tree[$offset])) {
            unset($this->tree[$offset]);
        }
    }
}