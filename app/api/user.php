<?php
/**
 * User接口
 */

namespace App\Api;

use Melody\Register;

class User
{
    /**
     * User
     * @return array
     */
    public function index()
    {
        return ['Code' => 0, "SERVER" => $_SERVER, "HEADER" => $http_response_header];
    }

    public function login()
    {
        if (empty($_POST['PassWd']) || empty($_POST['Account'])) {
            return ['Code' => 1,'Msg' => '账号密码不能为空'];
        }
        if ($_POST['Account'] != Register::get("Config")['user_account']) {
            return ['Code' => 1, "Msg" => '密码错误'];
        }
        if ($_POST['PassWd'] != Register::get("Config")['user_passWd']) {
            return ['Code' => 1, "Msg" => '密码错误'];
        }

        $_SESSION["Hash"] = Register::get("Config")['login_hash'];

        return ['Code' => 0, "Msg" => "登录成功"];
    }

    public function articleList()
    {
        if ($_SESSION['Hash'] != Register::get("Config")['login_hash']) {
            return ['Code' => 201, 'Msg' => '请先登录'];
        }

        return ['Code' => 0, 'Msg' => '', 'Data' => ['List' => []]];
    }
}