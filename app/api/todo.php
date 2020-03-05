<?php

namespace App\Api;

use model\Todo as MTodo;

class Todo
{
    /**
     * 1. 获取list列表
     * 2. 完成todo
     * 3.
     *
     */

    public function todoList()
    {
        return ['Code' => 0, 'Msg' => '', 'Data' => (new MTodo())->getList()];
    }

    public function todoEdit()
    {
        $id = $_POST['Id'];
        $data = $_POST['Data'];
        $result = (new MTodo())->edit($id, $data);
        if ($result === false) return ['Code' => 404];
        return ['Code' => 0, 'Msg' => '编辑成功'];
    }
}