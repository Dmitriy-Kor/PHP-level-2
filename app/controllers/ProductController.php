<?php

namespace app\controllers;

use app\model\Basket;
use app\model\Products;
use app\model\Users;

class ProductController extends Controller
{

    public function actionIndex()
    {
        $catalog = Products::get();
        
        $auth = Users::isAuth();
        $username = Users::getName();
        $count = Basket::getCountWhere('session_id', session_id());

        echo $this->render(
            'main',
            [
                'catalog' => $catalog,
                'auth' => $auth,
                'username' => $username,
                'count' => $count,
            ]
        );
    }
    public function actionCatalog()
    {
        $auth = Users::isAuth();
        $username = Users::getName();
        $page = (int)$_GET['page'];
        $count = Basket::getCountWhere('session_id', session_id());
        
        $products = Products::getLimit(($page + 1) * GOODS_PER_PAGE);
        echo $this->render('catalog', 
        ['catalog' => $products, 
        'page' => ++$page,
        'auth' => $auth,
        'username' => $username,
        'count' => $count,

        ]);
    }
    public function actionCard()
    {
        $id = (int)$_GET['id'];
        $product = Products::first($id);
        
        $auth = Users::isAuth();
        $username = Users::getName();
        $catalog = Products::get();
        $count = Basket::getCountWhere('session_id', session_id());

        echo $this->render(
            'card',
            [
                'product' => $product,
                'auth' => $auth,
                'username' => $username,
                'catalog' => $catalog,
                'count' => $count,
            ]
        );
    }

    public function actionApiCatalog()
    {
        $catalog = Products::get();
        header('Content-Type: application/json');
        echo json_encode($catalog, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
