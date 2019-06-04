<?php
namespace controllers;
use views\View;

class BasicController
{
  private $__defaultParams = [];

  public function render ($title, $params = []) {
    $viewPath = $this->parseViewPath();
    $viewPath = $viewPath."/".$viewPath.".php";
    $params = array_merge($this->__defaultParams, $params);
    new View($viewPath, $title, $params);
  }

  private function parseViewPath () {
    return strtolower(str_replace("Controller", "", explode("\\", get_class($this))[1]));
  }
}