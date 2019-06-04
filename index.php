<?php
include "autoloader.php";
use controllers\HomeController;

class Router {
  private $controller = null;

  public function doRoute ($route) {
    switch ($route) {
      case "":
        $this->controller = new HomeController();
        break;
    }

    $this->controller->action();
  }
}

$route = str_replace("/", "", explode("?", $_SERVER["REQUEST_URI"])[0]);

$index = new Router();
$index->doRoute($route);