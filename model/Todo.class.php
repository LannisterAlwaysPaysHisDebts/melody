<?php


namespace model;


use Melody\Db\ObjectMapping;

class Todo extends ObjectMapping
{
    /**
     * @return array
     */
    public function getList()
    {
        return [];
    }
}