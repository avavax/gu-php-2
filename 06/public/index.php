<?php
use \App\services\renders\TmplRender;

include ($_SERVER['DOCUMENT_ROOT'] . '/../vendor/Autoload.php');

$request = new \App\services\Request();

$controllerName = $request->getControllerName() ?: 'user';
$actionName = $request->getActionName();

$controllerName = 'App\\controllers\\'
    . ucfirst($controllerName) . 'Controller';

if (class_exists($controllerName)) {
    $controller = new $controllerName(new TmplRender(), $request);
    $controller->run($actionName);
} else {
	include ($_SERVER['DOCUMENT_ROOT'] . '/../views/layouts/404.php');
}