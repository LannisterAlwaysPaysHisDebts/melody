<?php
/**
 * 应用容器
 */

namespace Melody;

class App
{
    public function run()
    {
        // 自动加载
        require 'Load.php';
        $load = Load::autoloadRegister();
        Register::getInstance()['Load'] = $load;

        // 执行请求
        Register::getInstance()['Router'] = Router::route();




        // 最后再加载Helper
//        require "Helper.php";
    }
}