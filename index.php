<?php

session_set_cookie_params([
    "lifetime" => 3600,
    "path" => "/",
    "domain" => "",
    "secure" => true,
    "httponly" => true
]);

session_start();

require_once __DIR__ . '/vendor/autoload.php';

use src\Router;

$router = new Router();

$router->handleRequest();

exit();