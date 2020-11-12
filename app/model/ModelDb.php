<?php

namespace app\model;

use \app\engine\Db;

abstract class ModelDb extends Model
{
    abstract static public function getTableName();

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

    public function insert() {
        $tableName = static::getTableName();

        $params = [];
        $columns = [];

        foreach ($this->props as $key => $value) {

            $params[":{$key}"] = $this->$key;
            $columns[] = "`$key`";
        }

        $columns = implode(", ", $columns);
        $values = implode(", ", array_keys($params));
        var_dump($params);
        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$values})";
        Db::getInstance()->execute($sql, $params);
        $this->id = Db::getInstance()->lastInsertId();

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

        var_dump($this->props);
        foreach ($this->props as $key => $value) {
            if ($value == true) {
                $columsAndValues = "{$key} = '{$this->$key}'";
            }
        }

        $sql = "UPDATE {$tableName} SET {$columsAndValues} WHERE id = :id";
        Db::getInstance()->execute($sql, ['id' => $this->id]);
        
        foreach ($this->props as $key => $value) {
            if ($value == true) {
                $this->props[$key] = false;
            }
        }
        var_dump($this->props);
    }

    public static function getLimit($page)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT ?";
        return Db::getInstance()->queryLimit($sql, $page);
    }
    
    public static function getOneWhere($field, $value) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `{$field}` = :value";
        return Db::getInstance()->queryObject($sql,['value' => $value], static::class);
    }
    
    public static function getCountWhere($field, $value) {
        $tableName = static::getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE `{$field}` = :value";
        var_dump($sql);
        return Db::getInstance()->queryOne($sql,['value' => $value])['count'];
    }
}
 