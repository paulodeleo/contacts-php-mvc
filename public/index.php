<?php

use Contacts\Router;

require_once 'vendor/autoload.php';

$router = new Router($_SERVER['REQUEST_URI']);

$router->callControllerAction();
