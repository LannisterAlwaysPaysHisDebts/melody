<?php
namespace Melody\Db;

use PDO;
use PDOException;
use Melody\Db;

class Mysql extends Db
{
    private $dsn;
    private $userName = null;
    private $passWd = null;
    private $option = null;

    public function connect()
    {
        try{
            $pdo = new PDO($this->dsn, $this->userName, $this->passWd, $this->option);
        }catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return $pdo;
    }
}