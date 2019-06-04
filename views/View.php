<?php
namespace views;
class View
{
  private $viewPath;
  private $title;

  public function __construct($viewPath, $title, array $params)
  {
    $this->viewPath = array("content" => $viewPath);
    $this->title = array("title" => $title);
    $this->view($params);
  }

  public function view(array $params) {
    $params = array_merge($this->viewPath, $this->title, $params);
    extract($params);
    include "router-view.php";
  }
}