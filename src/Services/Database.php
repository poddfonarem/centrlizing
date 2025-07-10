<?php

namespace src\Services;

use PDO;
use PDOException;

class Database
{
    private PDO $conn;
    public function __construct() {
        $this->connect();
    }

    private function connect(): void
    {
        try {
            $config = require __DIR__ . '/../../config/database.php';

            $this->conn = new PDO(
                "mysql:host={$config['hostname']};dbname={$config['database']}",
                $config['username'],
                $config['password'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_PERSISTENT => true
                ]
            );
        } catch (PDOException $e)
        {
            $_SESSION['error'] = $e->getMessage();
            die('Помилка підключення до бази данних');
        }
    }

    public function getConnection(): PDO
    {
        return $this->conn;
    }
}