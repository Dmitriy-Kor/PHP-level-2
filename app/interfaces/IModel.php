<?php
namespace app\interfaces;
interface IModel
{
    // только имена методов
    public static function first($id);
    public static function get();
    public static function getTableName();
}