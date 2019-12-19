<?php
/**
 * Viewer接口
 */

namespace App\Api;

use model\Article;

class Index
{
    /**
     * Index
     * @return array
     * http://notes.com/melody/?r=/app/api/index
     */
    public function index()
    {
        return ['Code' => 0];
    }

    /**
     * 获取文章详情
     * @return array
     * @api http://notes.com/melody/?r=/app/api/index/getArticle
     */
    public function getArticle()
    {
        $id = intval($_POST['Id']);
        if ($id <= 0) {
            return ['Code' => 1, 'Msg' => 'Error', 'Data' => []];
        }

        $data = (new Article())->get($id);
        if ($data === false) {
            return ['Code' => 404, 'Msg' => '没有找到对应的文章', 'Data' => []];
        }

        return ['Code' => 0, 'Msg' => '', 'Data' => [
            'Title' => $data['Title'],
            "Content" => $data['Content'],
            'UpdateTime' => $data['UpdateTime'],
            'CreateTime' => $data['CreateTime']
        ]];
    }

    /**
     * 获取文章列表
     * @return array
     * @api http://notes.com/melody/?r=/app/api/index/getArticleList
     */
    public function getArticleList()
    {
        $offset = (int)$_POST['Offset'];
        $limit = (int)$_POST['Limit'];

        $result = (new Article())->getList($offset, $limit);
        if (empty($result)) {
            return ['Code' => 404, 'Msg' => '当前没有文章', 'Data' => []];
        }

        $articleList = [];
        foreach ($result as $item) {
            $articleList[] = [
                'Id' => $item['Id'],
                'Title' => $item['Title'],
                'UpdateTime' => $item['UpdateTime']
            ];
        }

        return ['Code' => 0, 'Msg' => '', 'Data' => ['List' => $articleList]];
    }
}