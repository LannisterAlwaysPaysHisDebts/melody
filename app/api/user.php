<?php
/**
 * User接口
 */

namespace App\Api;

use model\Account;
use model\Article;
use model\Todo;

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

    /**
     * 登陆
     * @return array
     */
    public function login()
    {
        if (empty($_POST['PassWd']) || empty($_POST['Account'])) {
            return ['Code' => 1,'Msg' => '账号密码不能为空'];
        }
        if (!Account::login($_POST['Account'], $_POST['PassWd'])) {
            return ['Code' => 1, "Msg" => '账号或密码错误'];
        }

        return ['Code' => 0, "Msg" => "登录成功"];
    }

    /**
     * 文章列表
     * @return array
     */
    public function articleList()
    {
        if (!Account::checkLogin()) {
            return ['Code' => 201, 'Msg' => '请先登录'];
        }

        return ['Code' => 0, 'Msg' => '', 'Data' => ['List' => []]];
    }

    /**
     * 文章详情
     */
    public function articleDesc()
    {
        $id = $_POST['Id'];
        if ($id <= 0) return ['Code' => 404];

        $result = (new Article())->get($id);
        if ($result === false) return ['Code' => 404];

        return ['Code' => 0, "Msg" => '', "Data" => ['Article' => $result]];
    }
}