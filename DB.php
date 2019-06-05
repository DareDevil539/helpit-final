<?php
require "libs/rb.php";

R::setup("mysql:host=localhost;dbname=helpit",
  "root", "toor");

session_start();