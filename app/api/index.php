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
        return ['Code' => 200];
    }

    /**
     * @return array
     * @api http://notes.com/melody/?r=/app/api/getArticle
     */
    public function getArticle()
    {
        return [];
    }

    /**
     * @return array
     * @api http://notes.com/melody/?r=/app/api/getArticleList
     */
    public function getArticleList()
    {
        return [];
    }
}