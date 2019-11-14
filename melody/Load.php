<?php
/**
 * 自动加载
 */

namespace Melody;

class Load
{
    public static function autoloadRegister()
    {
        return new self();
    }

    protected function __construct()
    {
        spl_autoload_register("Melody\\Load::_autoload");
    }

    protected static function _autoload($class)
    {
        var_dump($class);
    }
}