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
}