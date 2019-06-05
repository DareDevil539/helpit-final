<?php
namespace controllers;
use views\View;

class BasicController
{
  private $__defaultParams = [
    "materializeIcons" => "https://fonts.googleapis.com/icon?family=Material+Icons",
    "materializeCss" => "resources/css/materialize.min.css",
    "materializeJs" => "resources/js/materialize-css.js",
    "favicon" => "resources/img/favicon.ico",
    "comfortaa" => "https://fonts.googleapis.com/css?family=Comfortaa:400,700&display=swap&subset=cyrillic-ext,latin-ext",
    "style" => "resources/css/style.css",
    "jquery" => "resources/js/jquery.min.js",
    "parallax" => "resources/js/parallax.min.js",
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