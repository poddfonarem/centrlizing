<?php

namespace src\Services;

use PDO;
use PDOException;

class Order
{
    private PDO $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function addOrder($firstName, $lastName, $phone, $link, $text): array
    {
        try {
            $status = 0;

            $sql = "INSERT INTO centrlizing.orders (name, surname, phone, link, text, status) VALUES  
                                                                    (:name, :surname, :phone, :link, :text, :status)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':name', $firstName);
            $stmt->bindParam(':surname', $lastName);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':link', $link);
            $stmt->bindParam(':text', $text);
            $stmt->bindParam(':status', $status);

            if ($stmt->execute()) {
                return ['success' => 'Заявка успішно відправлена!'];
            } else {
                return ['error' => 'Користувача з таким login не знайдено!'];
            }
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function findOrder($phone): array
    {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $this->conn->prepare("
            SELECT id, name, surname, status 
            FROM centrlizing.orders WHERE phone = :phone");
            $stmt->bindValue(':phone', $phone);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getPaginatedOrders($page = 1, $limit = 10): array
    {
        try {
            $offset = ($page - 1) * $limit;

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $this->conn->prepare("
            SELECT id, name, surname, phone, date, link, text, status 
            FROM centrlizing.orders 
            ORDER BY date DESC 
            LIMIT :limit OFFSET :offset
        ");
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
            $stmt->execute();
            $calls = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'data' => $calls,
                'page' => (int)$page,
                'limit' => (int)$limit
            ];
        } catch (PDOException $e) {
            return ['error' => 'Помилка: ' . $e->getMessage()];
        }
    }

    public function updateOrderStatus($id, $status): array
    {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $this->conn->prepare("UPDATE centrlizing.orders SET status = :status WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return ['success' => 'Статус успішно оновлено'];
            } else {
                return ['error' => 'Помилка при оновленні статусу!'];
            }
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

}