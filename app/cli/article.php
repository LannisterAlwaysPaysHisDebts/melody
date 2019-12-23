<?php

namespace App\Cli;

use Melody\Model\CliModel;
use model\Article as MArticle;

class Article extends CliModel
{
    public function _list()
    {
        $article = new MArticle();
        $result = $article->getList(0, 10);
        if (empty($result)) {
            self::exit("没有文章");
        }

        self::table($result, ['ID', "Title", "UpdateTime"]);


    }
}