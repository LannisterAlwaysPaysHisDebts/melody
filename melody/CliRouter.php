<?php

namespace Melody;

use Melody\Exception\CliException;

class CliRouter
{
    const CLI_ORDER_LIST = [
        '-h' => ['class' => 'index', 'method' => 'index'],
        'help' => ['class' => 'index', 'method' => 'index'],
    ];

    private $query;
    private $class;
    private $method;
    private $params;
    private $publicFileName;

    /**
     * CliRouter constructor.
     * @throws CliException
     */
    public function __construct()
    {
        $this->query = $_SERVER['argv'];
        $this->parse();
    }

    /**
     * @throws CliException
     */
    private function parse()
    {
        if (empty($this->query)) {
            throw new CliException("", 404);
        }

        $this->publicFileName = $this->query[0];
        $params = $this->query;
        unset($params[0]);
        $params = array_values($params);

        $configOrderList = Register::get('Config')['order_list'];
        $configOrderList = empty($configOrderList) ? [] : $configOrderList;

        if (empty($params)) {
            throw new CliException("", 404);

        } elseif (isset(self::CLI_ORDER_LIST[$params[0]])) {
            $class = self::CLI_ORDER_LIST[$params[0]]['class'];
            $method = self::CLI_ORDER_LIST[$params[0]]['method'];
            unset($params[0]);

        } elseif (isset($configOrderList[$params[0]])) {
            $class = $configOrderList[$params[0]]['class'];
            $method = $configOrderList[$params[0]]['method'];
            unset($params[0]);

        } else {
            if (strpos($params[0], ":") !== false) {
                list($class, $method) = explode(":", $params[0]);
                unset($params[0]);
            } else {
                $class = $params[0];
                unset($params[0]);
                $method = "index";
                if (!empty($params[1])) {
                    $method = $params[1];
                    unset($params[1]);
                }
            }
        }

        $this->params = array_values($params);
        $this->class = "App\cli\\{$class}";
        $this->method = $method;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return CliRouter
     * @throws CliException
     */
    public static function route()
    {
        $router = new self();
        return $router;
    }
}