<?php
namespace App\controllers;


abstract class Controller
{
    protected $action;
    protected $defaultAction;

    public function run($action, $id)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = $this->action . 'Action';
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            echo "404";
        }
    }

    protected function render($template, $params = [])
    {
        $content = $this->renderTmpl($template, $params);
        return $this->renderTmpl(
            'layouts/main',
            ['content' => $content]
        );
    }

    protected function renderTmpl($template, $params = [])
    {
        ob_start();
        extract($params);
        include $_SERVER['DOCUMENT_ROOT']
            . '/../views/'
            . $template . '.php';
        return ob_get_clean();
    }
}