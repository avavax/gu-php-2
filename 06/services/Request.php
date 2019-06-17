<?php
namespace App\services;

class Request
{
    private $requestString;
    private $controllerName;
    private $actionName;
    private $params;

    public function __construct()
    {
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->parseRequest();
    }

    /**
     * @return mixed
     */
    public function getRequestString()
    {
        return $this->requestString;
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    public function getGET()
    {
        if (isset($_GET)) {
            return $this->$_GET; 
       } else {
            return null; 
       }
        
    }

    public function getPOST()
    {
        if (isset($_POST)) {
            return $this->$_POST; 
       } else {
            return null; 
       }
        
    }

    public function getSession() 
    {
        session_start();
        if (isset($_SESSION)) {
            return $this->$_SESSION; 
       } else {
            return null; 
       }        
    }

    public function setSession($params = []) 
    {
        session_start();
        foreach ($params as $key => $value) {
           $_SESSION[$key] = $value; 
        }

    }

    public function parseRequest()
    {
        $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui";

        if (preg_match_all($pattern, $this->requestString, $matches)) {
            $this->controllerName = $matches['controller'][0];
            $this->actionName = $matches['action'][0];

            $this->params['post'] = $_POST;
            $this->params['get'] = $_GET;
        }

    }

}