<?php
namespace Melody\Exception;

use \Exception;

class AppException extends Exception
{
    /**
     * 错误页面
     */
    public function error()
    {
        echo 'error';
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