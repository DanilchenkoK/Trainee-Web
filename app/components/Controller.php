<?php

namespace app\components;

use app\components\View;

abstract class Controller
{
    public $route;
    public $view;
    public $model;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
        $this->model =  $this->loadModel($route['controller']);
    }
    private function loadModel($name)
    {
        $path = 'app\\models\\' . ucfirst($name);
        if (class_exists($path)) {
            return new $path;
        }
    }
}
