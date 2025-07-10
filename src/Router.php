<?php

namespace src;

use Exception;

class Router
{
    private array $routes;
    /**
     * @throws Exception
     */
    public function __construct()
    {
        $routesConfig = require 'config/routes.php';

        if (!is_array($routesConfig) || !isset($routesConfig['routes'])) {
            throw new Exception("Помилка у файлі конфігурації маршрутів.");
        }

        $this->routes = $routesConfig['routes'];
    }

    /**
     * Request router logic
     */
    public function handleRequest(): void
    {
        $route = filter_var($_GET['route'] ?? '', FILTER_SANITIZE_URL);

        if (array_key_exists($route, $this->routes)) {
            [$controllerClass, $method] = $this->routes[$route];

            if (str_contains($_SERVER['REQUEST_URI'], '?')) {
                header('Location: /403');
                exit;
            }

            $controller = new $controllerClass();

            require_once 'incs/build/html.php';
            require_once 'incs/build/header.php';

            if (method_exists($controller, $method) || method_exists($controller, '__call')) {
                $controller->$method();
            } else {
                header('Location: /404');
                exit;
            }

            require_once 'incs/build/footer.php';

            return;
        }

        header('Location: /404');
        exit;
    }
}