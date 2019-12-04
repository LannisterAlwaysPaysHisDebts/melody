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

    /**
     * @param $class
     * @return bool
     */
    protected static function _autoload($class)
    {
        $path = str_replace('\\', '/', $class);

        $basePath = $path . '.php';
        $pathExt = $path . '.class.php';

        if (file_exists($basePath)) {
            _include($basePath);
        } elseif (file_exists($pathExt)) {
            _include($pathExt);
        }
        return false;
    }
}

function _include($file)
{
    include $file;
}