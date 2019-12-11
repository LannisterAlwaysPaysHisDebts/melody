<?php

namespace App\Api;

class Index
{
    /**
     * @return array
     * http://notes.com/melody/?r=/app/api/index
     */
    public function index()
    {
        return ['Code' => 0];
    }

    /**
     * @return array
     * @api http://notes.com/melody/?r=/app/api/index/getArticle
     */
    public function getArticle()
    {
        $id = intval($_POST['Id']);
        if ($id <= 0) {
            return ['Code' => 1, 'Msg' => 'Error', 'Data' => []];
        }

        $sql = "SELECT * FROM Article WHERE Id = {$id}";

        $query = dbR()->prepare($sql);
        $query->execute();
        $data = $query->fetch();
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
     * @return array
     * @api http://notes.com/melody/?r=/app/api/index/getArticleList
     */
    public function getArticleList()
    {
        $offset = (int)$_POST['Offset'];
        $limit = (int)$_POST['Limit'];

        $offset = $offset < 0 ? 0 : $offset;
        $limit = $limit <= 0 ? 10 : $limit;

        $sql = "SELECT Id,Title,UpdateTime FROM Article LIMIT {$limit} OFFSET {$offset}";
        $query = dbR()->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
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