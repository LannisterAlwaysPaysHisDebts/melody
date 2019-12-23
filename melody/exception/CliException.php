<?php
namespace Melody\Exception;

use \Exception;

class CliException extends Exception
{
    public function except()
    {
        switch ($this->getCode()) {
            case 404:
                $this->notFound();
                break;
            default:
                $this->error();
                break;
        }
    }

    /**
     * 错误页面
     */
    public function error()
    {
        echo debug_print_backtrace();
        exit;
    }

    // 404
    public function notFound()
    {
        echo <<<EOF
未找到对应命令! 

EOF;
        exit;
    }
}