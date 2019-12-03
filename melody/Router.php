<?php
/**
 * 路由
 */

namespace Melody;


class Router
{
    private $method;

    private $query;

    protected function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        parse_str($_SERVER['QUERY_STRING'], $this->query);
    }

    public function load($file = '')
    {
    }

    public static function route()
    {
        $router = new self();

        return $router;
    }
}