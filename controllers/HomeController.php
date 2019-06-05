<?php
namespace controllers;

class HomeController extends BasicController
{
  public function action () {
    $this->render("Головна сторінка");
  }
}