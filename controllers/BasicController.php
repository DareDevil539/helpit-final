<?php
namespace controllers;
use views\View;

class BasicController
{
  private $__defaultParams = [
    "materializeIcons" => "https://fonts.googleapis.com/icon?family=Material+Icons",
    "materializeCss" => "https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css",
    "materializeJs" => "https://cdn.jsdelivr.net/npm/materialize-css",
    "favicon" => "resources/img/favicon.ico",
    "style" => "resources/css/style.css",
    "jquery" => "https://cdn.jsdelivr.net/npm/jquery",
    "header" => "components/header.php"
  ];

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