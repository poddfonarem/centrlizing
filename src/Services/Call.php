<?php

namespace src\Services;

use PDO;
use PDOException;

class Call
{

    private PDO $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function addCall($phone): array
    {
        try {
            $status = 0;

            $sql = "INSERT INTO centrlizing.calls (phone, status) VALUES  (:phone, :status)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':status', $status);

            if ($stmt->execute()) {
                return ['success' => 'Очікуйте на дзвінок від Нас!'];
            } else {
                return ['error' => 'Помилка при надсиланні дзвінка!'];
            }
        }catch (PDOException $e){
            return ['error' => $e->getMessage()];
        }
    }

    public function getPaginatedCalls($page = 1, $limit = 10): array
    {
        try {
            $offset = ($page - 1) * $limit;

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $this->conn->prepare("
            SELECT id, phone, date, status 
            FROM centrlizing.calls 
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

    public function updateCallStatus($id): array
    {
        try {
            $status = 1;

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $this->conn->prepare("UPDATE centrlizing.calls SET status = :status WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return ['success' => 'Заявка успішно закрита'];
            } else {
                return ['error' => 'Помилка при закриванні заявки'];
            }
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

}