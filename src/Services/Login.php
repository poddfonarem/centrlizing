<?php

namespace src\Services;

use JetBrains\PhpStorm\NoReturn;
use PDO;

class Login
{
    private PDO $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function login($login, $password): array
    {
        if (!$login || !$password) {
            return ['error' => 'Помилка отримання ніку та паролю'];
        }

        $sql = "SELECT * FROM centrlizing.users WHERE login = :login";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':login', $login);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                return [
                    'user_id' => $user['id'],
                    'login' => $user['nickname'],
                    'state' => $user['state'],
                    'logged' => true
                ];
            } else {
                return ['error' => 'Невірний пароль'];
            }
        } else {
            return ['error' => 'Користувача з таким login не знайдено!'];
        }
    }

    public function register(array $data): array
    {
        if (isset($data['c-password'])) {
            $login = $data['c-login'];
            $password = password_hash($data['c-password'], PASSWORD_DEFAULT);
            $state = 1;

            $sql = "INSERT INTO centrlizing.users (login, password, state) 
                        VALUES (:login, :password, :state)";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':state', $state);

            if ($stmt->execute()) {
                return [
                    'success' => 'Ви успішно зареєстрували акаунт!',
                    'redirect' => '/dashboard'
                ];
            } else {
                return [
                    'error' => 'Помилка при реєстрації',
                    'redirect' => '/dashboard'
                ];
            }
        } else {
            return [
                'error' => 'Паролі не співпадають',
                'redirect' => '/dashboard'
            ];
        }
    }

    public function delete(array $data): array
    {
        if (isset($data['d-login'])) {
            $login = $data['d-login'];

            $sql = "DELETE FROM `centrlizing`.users WHERE login = :login";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':login', $login);

            if ($stmt->execute()) {
                return [
                    'success' => 'Ви успішно видалили акаунт!',
                    'redirect' => '/dashboard'
                ];
            } else {
                return [
                    'error' => 'Помилка при видаленні',
                    'redirect' => '/dashboard'
                ];
            }
        } else {
            return [
                'error' => 'Помилка при отриманні логіну',
                'redirect' => '/dashboard'
            ];
        }
    }

    #[NoReturn] public function logout(): void
    {
        session_start();
        session_unset();
        session_destroy();

        if (!empty($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            header("Location: /");
        }
        exit();
    }
}