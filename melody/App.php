<?php
/**
 * 应用容器
 */

namespace Melody;

use Melody\Exception\AppException;

class App
{
    // 数据输出格式
    protected $outputMode;

    public function run()
    {
        // 自动加载
        require 'Load.php';
        $load = Load::autoloadRegister();

        $register = Register::getInstance();
        $register['Load'] = $load;

        // 配置加载
        $register['Config'] = Config::getInstance();

        // 加载助手函数
        require "Helper.php";

        Session::start();

        // 初始化路由
        $register['Router'] = Router::route();

        $this->_loadApp();

        // 执行请求
        try {
            $result = $this->_run($register['Router']);
        } catch (AppException $e) {
            $e->except();
            exit;
        }

        $this->_output($result);
    }

    /**
     * 加载框架外的配置
     */
    protected function _loadApp()
    {

    }

    /**
     * @param Router $route
     * @return mixed
     * @throws AppException
     */
    protected function _run(Router $route)
    {
        $route->parse();
        $class = $route->getClass();
        if (!class_exists($class)) {
            throw new AppException('Class not found', 404);
        }
        $class = new $class();

        $method = $route->getMethod();
        if (!method_exists($class, $method)) {
            throw new AppException('Method not found', 404);
        }

        return $class->$method();
    }

    protected function _output($data)
    {
        switch ($this->outputMode) {
            case 'jsonp':
                echo $_GET['callback'] . "(" . json_encode($data, JSON_UNESCAPED_UNICODE) . ")";
                exit;
            default:
                header("Content-type: application/json;charset=utf-8");
                echo json_encode($data, JSON_UNESCAPED_UNICODE);
                exit;
        }
    }
}