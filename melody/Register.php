<?php
/**
 *
 *
 */

namespace Melody;

class Register implements \ArrayAccess
{
    static $instance = null;

    private $tree = [];

    protected function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
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