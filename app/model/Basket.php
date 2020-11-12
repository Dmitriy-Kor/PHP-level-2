<?php


namespace app\model;

use app\engine\Db;

class Basket extends ModelDb
{
    protected $id;
    protected $session_id;
    protected $product_id;

    protected $props = [
        'session_id' => false,
        'product_id' => false
    ];

    public function __construct($session_id = null, $product_id = null)
    {
        $this->session_id = $session_id;
        $this->product_id = $product_id;
    }

    public static function getTableName()
    {
        return "basket";
    }

    public static function getBasket($session) {
        $sql = "SELECT p.id id_prod, b.id id_basket, p.name, p.description, p.price, p.img FROM basket b, products p WHERE b.product_id=p.id AND session_id = :session";
        var_dump($sql, $session);
        var_dump(Db::getInstance()->queryAll($sql, ['session' => $session]));
        return Db::getInstance()->queryAll($sql, ['session' => $session]);
    }

   
}