<?php

/**
*@package: Scandiweb assignment
*@Author: Nicolas HOQUET
**/

session_start();

require 'vendor/autoloader.php';
require 'models/autoloader.php';
$display = new Router($_SERVER['REQUEST_URI']);
$display->route();

//EOF
