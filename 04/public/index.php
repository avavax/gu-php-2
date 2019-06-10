<?php
use App\models\User;

include ($_SERVER['DOCUMENT_ROOT'] . '/../services/Autoload.php');
spl_autoload_register([new \App\services\Autoload(), 'loadClass']);


$user1 = new User();

echo '<pre>';

//var_dump($user1->getOne(1));

/*$user1->fio = 'oleg';
$user1->login = 'oleg_oleg';
$user1->password = '12345';
$user1->save();*/

echo '</pre>';
//var_dump(App\models\Good::getAll());

$controllerName = $_GET['c'] ?: 'product';
$actionName = $_GET['a'];

$controllerName = 'App\\controllers\\'
    . ucfirst($controllerName) . 'Controller';

if (class_exists($controllerName)) {
    $controller = new $controllerName();
    $controller->run($actionName, $idName);
}