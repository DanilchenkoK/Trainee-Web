<?php

use app\components\Router;

function debug($item)
{
  echo "<pre>";
  var_dump($item);
  echo "</pre>";
  exit();
}


spl_autoload_register(function ($class) {
  $path = str_replace('\\', '/', $class . ".php");
  if (file_exists($path)) {
    require $path;
  }
});
session_start();
$router = new Router;
$router->run();
