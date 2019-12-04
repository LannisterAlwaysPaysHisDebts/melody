<?php
/**
 * 路由
 */

namespace Melody;


class Router
{
    private $requestMethod;

    private $query;

    protected $class = '';
    protected $method = 'index';
    protected $params = '';

    protected function __construct()
    {
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        parse_str($_SERVER['QUERY_STRING'], $this->query);
        $this->parse();
    }

    // 加载路由文件
    public function load($file = '')
    {
    }

    // 路由解析
    protected function parse()
    {
        if (empty($this->query)) {
            return;
        }

        $parseList = [
            'defaultParse'
        ];
        foreach ($parseList as $function) {
            if (method_exists($this, $function)) {
                if ($this->$function()) {
                    break;
                }
            }
        }
    }

    public static function route()
    {
        $router = new self();
        return $router;
    }

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
            $class = empty($class) ? $item : "{$class}\\{$item}";
            if (class_exists($class)) {
                $f = 1;
                break;
            }
        } while(!empty($r));
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