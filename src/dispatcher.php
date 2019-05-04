<?php
namespace MVC;

use MVC\Router;
use MVC\Request;

class Dispatcher
{
    private $request;

    public function dispatch()
    {
        $this->request = new Request();
        
        Router::parse($this->request->url, $this->request);
        
        $controller = $this->loadController();

        call_user_func_array([$controller, $this->request->action], $this->request->params);
    }

    public function loadController()
    {
        $name = 'MVC\Controllers\\' . $this->request->controller . "Controller";
        $file = str_replace("MVC\Controllers\\", "", ROOT . 'Controllers/' . $name . '.php');
        require($file);
        $repo = "MVC\Models\\".ucfirst(substr($this->request->controller, 0, -1)) . "Repository";

        $repository = new $repo();
        $controller = new $name($repository);
        return $controller;
    }
}
?>