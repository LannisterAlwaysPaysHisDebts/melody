<?php
namespace Melody\Db;

/**
 * Class ObjectMapping
 * @package Melody\Db
 */
abstract class ObjectMapping
{
    protected $table = null;

    public function get($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE `Id` = {$id}";
        $query = dbR()->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
}