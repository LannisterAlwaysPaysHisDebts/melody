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

    public function __construct($config)
    {
        $this->userName = $config["db_username"];
        $this->passWd = $config["db_password"];
        $this->dsn = "mysql:dbname={$config['db_name']};host={$config['db_host']}";
    }

    /**
     * @return bool|PDO
     */
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