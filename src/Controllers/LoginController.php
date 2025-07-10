<?php

namespace src\Controllers;

use JetBrains\PhpStorm\NoReturn;
use src\Services\Login;
class LoginController extends Controller
{
    protected Login $login;
    public function __construct()
    {
        parent::__construct();
        $this->login = new Login($this->conn);
    }
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['login']) && isset($_POST['password'])) {
                $login = htmlspecialchars($_POST['login']);
                $password = htmlspecialchars($_POST['password']);

                $result = $this->login->login($login, $password);

                if (isset($result['logged']) && $result['logged'] === true) {
                   print_r($_SESSION['user'] = [
                        'id' => htmlspecialchars($result['user_id']),
                        'login' => htmlspecialchars($result['login']),
                        'state' => htmlspecialchars($result['state']),
                        'logged' => true
                    ]);
                } else {
                    $_SESSION['error'] = $result['error'];
                }
            } else {
                $_SESSION['error'] = 'Помилка отримання ніку та паролю';
            }
        } else {
            $_SESSION['error'] = 'Помилка отримання POST';
        }
        header('Location: /');
    }

    public function register(): void
    {
        $result = $this->login->register($_POST);

        header('Location: ' . $result['redirect']);
        if (isset($result['success'])) {
            $_SESSION['success'] = $result['success'];
        } else {
            $_SESSION['error'] = $result['error'];
        }
    }

    public function deleteAccount(): void
    {
        $result = $this->login->delete($_POST);

        header('Location: ' . $result['redirect']);
        if (isset($result['success'])) {
            $_SESSION['success'] = $result['success'];
        } else {
            $_SESSION['error'] = $result['error'];
        }
    }

    public function isLoggedIn(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user']['logged']);
    }

    public function redirectIfNotLoggedIn(): void
    {
        if (!$this->isLoggedIn()) {
            header('Location: /');
            $_SESSION['error'] = "У Вас відсутні права доступу";
            exit();
        }
    }

    public function renderLoginButton(): string
    {
        if ($this->isLoggedIn()) {
            return '<a href="/dashboard" class="blue-btn m-0 p-2 text-white">
                        <i class="icon-cog"></i>
                    </a>
                    <a href="/logout" class="blue-btn m-0 p-2 text-white">
                        <i class="icon-sign-out"></i> Вихід
                    </a>';
        } else {
            return '<a href="#" data-toggle="modal" data-target="#loginModal" class="blue-btn p-2 text-white">
                        <i class="icon-user"></i> Вхід
                    </a>';
        }
    }

    #[NoReturn] public function logout(): void
    {
        $this->login->logout();
    }
}