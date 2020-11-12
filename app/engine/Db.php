<?php

namespace app\engine;

use app\traits\Tsingleton;
//use PDO;

class Db
{
    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'login' => 'root',
        'password' => 'root',
        'dbname' => 'shop',
        'charset' => 'utf8',
    ];

    use Tsingleton;

    private $conection = null;

    private function getConection()
    {
        if (is_null($this->conection)) {
            $this->conection = new \PDO(
                $this->prepareDsnString(),
                $this->config['login'],
                $this->config['password']
            );
            $this->conection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return $this->conection;
    }

    private function prepareDsnString()
    {
        return sprintf(
            '%s:host=%s;dbname=%s;charset=%s',
            $this->config['driver'],
            $this->config['host'],
            $this->config['dbname'],
            $this->config['charset']
        );
    }

    private function query($sql, $params)
    {
        $proStatment = $this->getConection()->prepare($sql);
        $proStatment->execute($params);
        return $proStatment;
    }

    public function execute($sql, $params = [])
    {
        return $this->query($sql, $params);
    }

    public function queryObject($sql, $params, $className)
    {
        $proStatment = $this->query($sql, $params);
        $proStatment->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $className);
        return $proStatment->fetch();
    }

    public function lastInsertId()
    {
        return $this->conection->lastInsertId();
    }
    public function queryOne($sql, $params = [])
    {
        return $this->query($sql, $params)->fetch();
    }

    public function queryAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function queryLimit($sql, $page)
    {
        $proStatment = $this->getConection()->prepare($sql);
        $proStatment->bindValue(1, $page, \PDO::PARAM_INT);
        $proStatment->execute();
        return $proStatment->fetchAll();
    }
} 
