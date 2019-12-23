<?php

namespace Melody;

use Melody\Exception\CliException;

class Cli
{
    public function run()
    {
        if (PHP_SAPI != 'cli') {
            exit('{"Code":1,"Msg":"入口文件请求错误"}');
        }

        require 'Load.php';
        $load = Load::autoloadRegister();

        $register = Register::getInstance();
        $register['Load'] = $load;

        $register['Config'] = Config::getInstance();

        $configFile = APP . '/cli/config.php';
        if (is_file($configFile)) {
            $register['Config']->load($configFile);
        }

        // 加载助手函数
        require "Helper.php";

        try {
            $register['Router'] = CliRouter::route();
            $this->_run($register['Router']);
        } catch (CliException $e) {
            $e->except();
            exit();
        }
    }

    /**
     * @param CliRouter $route
     * @return mixed
     * @throws CliException
     */
    protected function _run(CliRouter $route)
    {
        $class = $route->getClass();
        if (!class_exists($class)) {
            throw new CliException('Class not found', 404);
        }
        $class = new $class();

        $method = $route->getMethod();
        if (!method_exists($class, $method)) {
            throw new CliException('Method not found', 404);
        }

        return $class->$method();
    }
}