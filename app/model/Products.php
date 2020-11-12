<?php

namespace app\model;

class Products extends ModelDb
{
    protected $id;
    protected $name;
    protected $description;
    protected $price;
    protected $img;


    public $props = [
        'name' => false,
        'description' => false,
        'price' => false,
        'img' => false,
    ];

    public function __construct( $name = null, $description = null, $price = null, $img = null)
    {
        $this->name = $name;
        $this->description = $description; 
        $this->price = $price;
        $this->img = $img;

    }

    public static function getTableName()
    {
        return 'products';
    }
}
