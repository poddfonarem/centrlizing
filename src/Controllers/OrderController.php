<?php

namespace src\Controllers;

use src\Services\Order;

class OrderController extends Controller
{
    protected Order $order;

    public function __construct()
    {
        parent::__construct();
        $this->order = new Order($this->conn);
    }

    public function addOrder(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = htmlspecialchars($_POST['user_name']);
            $surname = htmlspecialchars($_POST['user_surname']);
            $phone = htmlspecialchars($_POST['user_phone']);
            $link = htmlspecialchars($_POST['user_link']);
            $message = htmlspecialchars($_POST['user_message']);
            $result = $this->order->addOrder($name, $surname, $phone, $link, $message);

            header('Location: /order');

            if (isset($result['success'])) {
                $_SESSION['success'] = $result['success'];
            } else {
                $_SESSION['error'] = $result['error'];
            }
        }
    }

    public function showOrders(): array
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 20;

        return $this->order->getPaginatedOrders($page, $limit);
    }

    public function findOrder($phone): array
    {
        return $this->order->findOrder($phone);
    }

    public function findOrderStatus($status): string
    {
        return match ($status) {
            '1' => "<i class='icon-money text-green'></i> Очікуйте фінанси на свій рахунок",
            '2' => "<i class='icon-check-circle text-green'></i> Фінанси виплачено",
            '3' => "<i class='icon-check-circle text-green'></i> Заявка закрита!",
            '4' => "<i class='icon-error text-danger'></i> Заявка відхилена!",
            default => "<i class='icon-warning text-warning'></i> Очікує",
        };
    }

    public function adminOrderStatus(string $status, int $id): string
    {
        return match ($status) {
            '1' => $this->renderStatusForm(
                icon: 'icon-money text-green',
                message: 'Очікує фінанси',
                actions: [
                    '2' => 'Виплачено'
                ],
                formId: $id
            ),
            '2' => $this->renderStatusForm(
                icon: 'icon-check-circle text-green',
                message: 'Фінанси виплачено',
                actions: [
                    '3' => 'Закрити'
                ],
                formId: $id
            ),
            '3' => $this->renderStaticStatus('icon-check-circle text-green', 'Заявка закрита!'),
            '4' => $this->renderStaticStatus('icon-error text-danger', 'Заявка відхилена!'),
            default => $this->renderStatusForm(
                icon: 'icon-warning text-yellow',
                message: 'Очікує',
                actions: [
                    '4' => 'Відмовити',
                    '1' => 'Підтвердити'
                ],
                formId: $id
            )
        };
    }

    private function renderStatusForm(string $icon, string $message, array $actions, int $formId): string
    {
        $options = "<option selected disabled>Виберіть дію</option>";
        foreach ($actions as $value => $label) {
            $options .= "<option value='$value'>$label</option>";
        }

        return "
                <form class='p-0 m-0' action='/incs/handlers/orders/update_order_status_handler.php' method='post'>
                    <input type='hidden' name='id' value='$formId'>
                    <label for='select-order' class='d-none'></label>
                    <i class='$icon'></i> $message
                    <select class='btn p-0 text-blue' name='select-order' id='select-order'>
                        $options
                    </select>
                    <button class='btn blue-btn' type='submit'><i class='icon-save'></i></button>
                </form>
                ";
    }

    private function renderStaticStatus(string $icon, string $message): string
    {
        return "<i class='$icon'></i> $message";
    }

    public function updateOrderStatus(): void
    {
        $status = htmlspecialchars($_POST['select-order']);
        $id = htmlspecialchars($_POST['id']);

        $result = $this->order->updateOrderStatus($id, $status);

        header("Location: " . $_SERVER['HTTP_REFERER']);
        if (isset($result['success'])) {
            $_SESSION['success'] = $result['success'];
        } else {
            $_SESSION['error'] = $result['error'];
        }
    }

}