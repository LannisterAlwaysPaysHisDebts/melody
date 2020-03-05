<?php


namespace Melody\Route;

use Melody\Router;

class RouteConfig
{
    public function __construct($query, $realPath, $method)
    {
    }

    /**
     * 根据当前请求来解析到是否符合该路由匹配规则
     * @param Router $router
     * @return bool
     */
    public function getReal(Router $router)
    {
        return false;
    }
}