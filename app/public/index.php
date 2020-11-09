<?php
include dirname(__DIR__) . '/config/config.php'; // подключаем конфиг

use app\engine\Autoload;
use app\model\{Products, Users};
use app\controllers\ProductController;
use app\engine\Render;
use app\engine\RenderTwig;

include ROOT_DIR . '/engine/Autoload.php';
include ROOT_DIR . '/vendor/autoload.php';

spl_autoload_register([new Autoload(), 'loadClass']);

$controllerName = $_GET['c'] ?: 'product';
$actionName = $_GET['a'];

$ControllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";
var_dump($ControllerClass);

if (class_exists($ControllerClass)) {
    $controller = new $ControllerClass(new RenderTwig());
    $controller->runAction($actionName);
} else {
    die("Ошибка, контроллер не существует!");
}

die();

// $product = Products::first(9);
//var_dump($product);
//$product->description = 'красный цвет';
//var_dump($product);
// $product->save();
//var_dump($product);
// var_dump(get_class_methods($product));



//CREATE
//$prodNew = new Products('orange','250 ml', '60');
//$prodNew->save();
//var_dump($prodNew);



//$userNew = new Users('kate', 'kate2000');
//$userNew->insert();

//DELETE 
//$prodNew->delete(); 
//$userNew->delete();

//UPDATE
//$prodNew->update();
