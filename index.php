<?php
include "autoloader.php";
use controllers\HomeController;

class Router {
  private $controller = null;

  public function doRoute ($route) {
    if ($route === "") {
      $this->controller = new HomeController();
      $this->controller->action();
    } else {
      echo $routeController = $this->getRouteController($route);
//      $this->controller = new $routeController();
//      if (!$this->controller) {
//        die("Error 404. Page is not found!");
//      } else {
//        $this->controller->action();
//      }
    }
  }

  private function getRouteController ($route) {
    $routeArr = explode("-", $route);

    for ($i = 0; $i < count($routeArr); $i++) {
      $routeArr[$i] = ucfirst($routeArr[$i]);
    }

    return join($routeArr)."Controller";
  }
}

$route = str_replace("/", "", explode("?", $_SERVER["REQUEST_URI"])[0]);

$index = new Router();
$index->doRoute($route);