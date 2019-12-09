<?php
namespace Melody\Exception;

use \Exception;

class AppException extends Exception
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
        header("Content-type: application/json;charset=utf-8");
        echo json_encode([
            'Code' => 404,
            'Msg' => $this->getMessage()
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
}