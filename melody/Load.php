<?php
/**
 * 自动加载
 */

namespace Melody;

class Load
{
    // 允许访问的根命名空间
    const ACCESS_BASE_NAMESPACE = [
        "melody",
        "app"
    ];

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

        // 根命名空间的访问权限控制
        $access = explode('/', $path)[0];
        if (empty($access)) return false;
        if (!in_array(strtolower($access), self::ACCESS_BASE_NAMESPACE)) return false;

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