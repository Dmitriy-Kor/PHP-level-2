<?php

namespace app\model;

use \app\engine\Db;

abstract class ModelDb extends Model
{
    public static function first($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        //return Db::getInstance()->queryOne($sql,['id' => $id]);
        return Db::getInstance()->queryObject($sql, ['id' => $id], static::class); // get_class($this)
    }
    public static function get()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    public function insert()
    {
        $tableName = static::getTableName();
        $placeholders = ":";
        $params = [];
        foreach ($this->props as $key => $value) {
            if ($key == 'id') continue;
            $placeholders .= $key . ', :';
            $params[":{$key}"] = $value;
        }
        $colums  = substr((str_replace(":", "", $placeholders)), 0, -2);
        $placeholders = substr($placeholders, 0, -3);

        //var_dump($params);
        $sql = "INSERT INTO {$tableName} ($colums) VALUES ($placeholders)";
        //echo $sql . '<br>';   

        Db::getInstance()->execute($sql, $params);
        $this->id = Db::getInstance()->lastInsertId();
        //echo "This new id: " . $this->id . '<br>';
        return $this;
    }

    public function delete()
    {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        var_dump($sql);
        Db::getInstance()->execute($sql, ['id' => $this->id]);
    }

    public function save()
    {
        if (is_null($this->id))
            $this->insert();
        else
            $this->update();
    }

    public function update()
    {
        $tableName = static::getTableName();
        $columsAndValues = '';
        $columsName = '';
        var_dump($this->props);
        foreach ($this->props as $key => $value) {
            if ($value == true) {
                $columsAndValues = "{$key} = '{$this->$key}'";
                $columsName = $key;
            }
        }

        $sql = "UPDATE {$tableName} SET {$columsAndValues} WHERE id = :id";
        Db::getInstance()->execute($sql, ['id' => $this->id]);
        //$this->props[$columsName] = false;
        
        foreach ($this->props as $key => $value) {
            if ($value == true) {
                $this->props[$key] = false;
            }
        }
        var_dump($this->props);
    }

    public static function getLimit($page){
        $tableName = static::getTableName();
    $sql = "SELECT * FROM {$tableName} LIMIT ?";
    return Db::getInstance()->queryLimit($sql, $page);
    }
    abstract static public function getTableName();
}
