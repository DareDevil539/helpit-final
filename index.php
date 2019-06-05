<?php
include "autoloader.php";
require "DB.php";

use controllers\HomeController;
use controllers\AuthController;
use controllers\DashboardController;
use controllers\MyController;

class Router {
  private $controller = null;

  public function doRoute ($route) {
    switch ($route) {
      case "":
        $this->controller = new HomeController();
        break;
      case "auth":
        $this->controller = new AuthController();
        break;
      case "dashboard":
        $this->controller = new DashboardController();
        break;
      case "my":
        $this->controller = new MyController();
        break;
      default:
        echo "Error 404. Page is not found";
    }

    $this->controller->action();
  }
}

$route = str_replace("/", "", explode("?", $_SERVER["REQUEST_URI"])[0]);

$index = new Router();
$index->doRoute($route);