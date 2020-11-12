<?php


namespace app\controllers;


use app\engine\Request;
use app\model\Basket;
use app\model\Users;

class BasketController extends Controller
{
    public function actionIndex() {
    
        $auth = Users::isAuth();
        $username = Users::getName();

        echo $this->render('basket', [
            'basket' => Basket::getBasket(session_id()), // можно прокинуть сессию '123qwerty'
            'count' => Basket::getCountWhere('session_id', session_id()), // можно прокинуть сессию '123qwerty'
            'auth' => $auth,
            'username' => $username,
        ]);
    }

    public function actionBuy() {
        $id = (int)$_POST['id'];
        var_dump($id, session_id());
        (new Basket(session_id(), $id))->save();
        header("Location: /product/catalog");


    }
}