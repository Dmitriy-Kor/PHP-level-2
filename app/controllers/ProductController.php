<?php

namespace app\controllers;

use app\model\Products;

class ProductController extends Controller
{
    
    public function actionIndex()
    {
        $catalog = Products::get();
        echo $this->render('main');
    }
    public function actionCatalog()
    {
        $page = (int)$_GET['page'];
        $products = Products::getLimit(($page +1) * GOODS_PER_PAGE);
        var_dump($products);
    }
    public function actionCard()
    {
        $id = (int)$_GET['id'];
        $product = Products::first($id);
        echo $this->render('card', ['product' => $product]);
    }

}
