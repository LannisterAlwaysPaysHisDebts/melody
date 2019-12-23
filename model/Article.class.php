<?php


namespace model;

use PDO;
use Melody\Db\ObjectMapping;

class Article extends ObjectMapping
{
    protected $table = 'Article';

    /**
     * @param $offset
     * @param $limit
     * @return array|bool
     */
    public function getList($offset, $limit)
    {
        $offset = $offset < 0 ? 0 : $offset;
        $limit = $limit <= 0 ? 10 : $limit;

        $sql = "SELECT Id,Title,UpdateTime FROM Article LIMIT {$limit} OFFSET {$offset}";
        $query = dbR()->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return  empty($result) ? false : $result;
    }
}