<?php
namespace App\main;

use App\models\repositories\GoodRepository;
use App\models\repositories\UserRepository;
use App\models\repositories\OrderRepository;
use App\services\Db;
use \App\services\renders\TmplRender;
use App\traits\TSingleton;

/**
 * Class App
 * @package App\main
 *
 * @property Db $db
 * @property TmplRender $render
 * @property UserRepository $userRepository
 * @property GoodRepository $goodRepository
 */
class App
{
    use TSingleton;

    static public function call():App
    {
        return static::getInstance();
    }

    public $config = [];
    private $components = [];

    public function run($config)
    {
        $this->config = $config;
        $this->runController();
    }

    private function runController()
    {
        $request = new \App\services\Request();

        $controllerName = $request->getControllerName() ?: 'user';
        $actionName = $request->getActionName();

        $controllerName = 'App\\controllers\\'
            . ucfirst($controllerName) . 'Controller';

        if (class_exists($controllerName)) {
            $render = App::call()->render;
            $controller = new $controllerName($render, $request);
            $controller->run($actionName);
        } else {
            header('Location: /');
        }
    }

    public function __get(string $name)
    {
        if (array_key_exists($name, $this->components)) {
            return $this->components[$name];
        }

        if (array_key_exists($name, $this->config['components'])) {
            $class = $this->config['components'][$name]['class'];
            if (! class_exists($class)) {
                return null;
            }
            if (array_key_exists('config', $this->config['components'][$name])) {
                $config = $this->config['components'][$name]['config'];
                $component = new $class($config);
            } else {
                $component = new $class();
            }
            $this->components[$name] = $component;
            return $component;
        }
        return null;
    }
}