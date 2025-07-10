<?php

namespace src\Controllers;

use JetBrains\PhpStorm\NoReturn;

class PageController
{
    public function __call(string $name, array $arguments): void
    {
        $view = "views/$name.php";
        if (file_exists($view)) {
            require $view;
        } else {
            header('Location: /404');
            exit;
        }
    }

    #[NoReturn] public function show404(): void
    {
        http_response_code(404);
        require 'views/errors/404.php';
    }

    #[NoReturn] public function show403(): void
    {
        http_response_code(403);
        require 'views/errors/403.php';
    }

}