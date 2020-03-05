<?php
/**
 * 路由
 */

namespace Melody;


use Melody\Route\RouteConfig;

class Router
{
    private $requestMethod;

    private $query;

    protected $class = '';
    protected $method = 'index';
    protected $params = '';

    protected $routeConfig = [];

    protected function __construct()
    {
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        parse_str($_SERVER['QUERY_STRING'], $this->query);
        $this->parse();
    }

    /**
     * 注册一条路由
     * @param string $query : 请求
     * @param string $realPath : 映射路径
     * @param string $method : 请求方式 get/post
     */
    public function registerRoute($query, $realPath, $method)
    {
        $this->routeConfig[] = new RouteConfig($query, $realPath, $method);
    }

    /**
     * 路由解析函数注册
     */
    public function parse()
    {
        if (empty($this->query)) {
            return;
        }

        $parseList = [
            'configParse',
            'defaultParse',
        ];
        foreach ($parseList as $function) {
            if (method_exists($this, $function)) {
                if ($this->$function()) {
                    break;
                }
            }
        }
    }

    /**
     * 解析默认路由
     * @return bool
     */
    protected function defaultParse()
    {
        if (empty($this->query['r'])) {
            return false;
        }
        $r = $this->query['r'];
        $r = explode('/', $r);

        $f = 0;
        $class = "";
        do {
            $item = array_shift($r);
            if (empty($item)) continue;
            $class = empty($class) ? $item : "{$class}\\{$item}";
            if (class_exists($class)) {
                $f = 1;
                break;
            }
        } while (!empty($r));
        if ($f == 1) {
            $this->class = $class;
            $this->method = 'index';
            if (!empty($r)) {
                $method = array_shift($r);
                if (method_exists($class, $method)) {
                    $this->method = $method;
                }
            }
            return true;
        }
        return false;
    }

    /**
     * 通过路由配置解析请求
     * @return bool
     */
    protected function configParse()
    {
        if (empty($this->routeConfig)) {
            return false;
        }

        foreach ($this->routeConfig as $routeConfig) {
            if ($routeConfig instanceof RouteConfig && $routeConfig->getReal($this)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return Router
     */
    public static function route()
    {
        $router = new self();
        return $router;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }
}