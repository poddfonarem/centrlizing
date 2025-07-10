<?php

namespace src\Controllers;

use PDO;
use src\Services\Database;

class Controller
{
    protected PDO $conn;

    /**
     * Constructor: start session and connect to database
     */
    public function __construct()
    {
        session_start();
        $database = new Database();
        $this->conn = $database->getConnection();
    }
}