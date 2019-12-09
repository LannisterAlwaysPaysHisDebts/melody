<?php
/**
 * 助手函数列表
 */

use Melody\Db;
use Melody\Register;

if (!function_exists("halt")) {
    function halt(...$args)
    {
        if (!empty($args)) {
            foreach ($args as $item) {
                var_dump($item);
            }
        }
        exit;
    }
}

if (!function_exists("setLog")) {
    function setLog($content, $tag, $logPath = "")
    {
        $namespace = "";
        $backtrace = debug_backtrace();
        if (!empty($backtrace[0]['file'])) {
            $root = strtolower(ROOT);
            $filePath = strtolower($backtrace[0]['file']);
            $namespace = str_replace($root, "", $filePath);
        }

        $log = Register::get("Melody\\Log");
        $log->setLog($content, $tag, $namespace, $logPath);
        return;
    }
}

if (!function_exists("dbR")) {
    /**
     * @return PDO
     */
    function dbR()
    {
        return Db::get();
    }
}