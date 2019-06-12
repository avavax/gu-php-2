<?php
use \App\services\renders\TmplRender;

include ($_SERVER['DOCUMENT_ROOT'] . '/../vendor/Autoload.php');
//include ($_SERVER['DOCUMENT_ROOT'] . '/../services/Autoload.php');
//spl_autoload_register([new \App\services\Autoload(), 'loadClass']);

$controllerName = $_GET['c'] ?: 'user';
$actionName = $_GET['a'];

$controllerName = 'App\\controllers\\'
    . ucfirst($controllerName) . 'Controller';

if (class_exists($controllerName)) {
    $controller = new $controllerName(new TmplRender());
    $controller->run($actionName);
}