<?php

namespace App;

use PDO;

class DBConnection
{
    private PDO $connection;
    //private static ?DBConnection $instance = null;

    public function __construct(
        private string $dsn,
        private string $username,
        private string $password
    )
    {
    }

    public function initConnection()
    {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE =>
                PDO::FETCH_ASSOC // данные из бд получаем в виде ассоциативного массива
        ];

        $this->connection = new PDO($this->dsn, $this->username, $this->password, $options);
    }

//    public static function getInstance(){
//        if (self::$instance === null){
//            self::$instance = new DBConnection();
//        }
//        return self::$instance;
//    }

    public function query($sql)
    {
        $statement = $this->connection->query($sql);
        if (!$statement) return null;
        return $statement->fetch();
    }

    public function queryAll($sql)
    {
        $statement = $this->connection->query($sql);
        if (!$statement) return null;
        return $statement->fetchAll();
    }

    public function exec($sql)
    {
        return $this->connection->exec($sql);
    }

    public function execute($sql, $params, $all = true)
    {
        $statement = $this->connection->prepare($sql);
        $statement->execute($params);

        if (!$all){
            return $statement->fetch();
        }
        return $statement->fetchAll();
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
