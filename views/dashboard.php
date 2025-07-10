<?php

use src\Controllers\LoginController;
use src\Controllers\OrderController;
use src\Controllers\CallController;

$loginController = new LoginController();
$loginController->redirectIfNotLoggedIn();

$orderController = new OrderController();
$ordersArray = $orderController->showOrders();

$callController = new CallController();
$callArray = $callController->showCalls();

?>

<div class="container">
    <div class="form-toggle">
        <button data-form="orders" class="active">Оброблення заявок</button>
        <button data-form="calls">Зателефонувати</button>
        <button data-form="users">Керування користувачами</button>
    </div>
    <div class="row">
        <!-- Таблиця оброблення заявок -->
        <main class="form-container active col-md-12 ms-sm-auto col-lg-12 px-md-4" id="orders">
            <h2> Оброблення заявок</h2>
            <div class="table-responsive small">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ім'я Прізвище</th>
                        <th scope="col">Номер телефону</th>
                        <th scope="col">Дата</th>
                        <th scope="col">Посилання</th>
                        <th scope="col">Опис</th>
                        <th scope="col">Статус</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($ordersArray['data'] as $order):
                        $int_order = +1;
                        $orderStatus = $orderController->adminOrderStatus($order['status'], $order['id']);
                        $timestamp = strtotime($order['date']);
                        $date = date("d.m.Y H:i", $timestamp);
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($int_order) ?></td>
                            <td><?= htmlspecialchars($order['name']) . " " . htmlspecialchars($order['surname']) ?></td>
                            <td><?= htmlspecialchars($order['phone']) ?></td>
                            <td><?= htmlspecialchars($date) ?></td>
                            <td><?= htmlspecialchars($order['link']) ?></td>
                            <td><?= htmlspecialchars($order['text']) ?></td>
                            <td><?= $orderStatus ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <div class="d-flex justify-content-between mt-3">
                        <?php
                        $currentPage1 = $ordersArray['page'];
                        $limit1 = $ordersArray['limit'];

                        if ($currentPage1 > 1) {
                            echo '<a class="btn btn-outline-primary" href="/dashboard/orders/' . ($currentPage1 - 1) . '">⬅️ Попередня</a>';
                        } else {
                            echo '<span></span>';
                        }

                        if (count($ordersArray['data']) === $limit1) {
                            echo '<a class="btn btn-outline-primary" href="/dashboard/orders/' . ($currentPage1 + 1) . '">Наступна ➡️</a>';
                        } ?>
                    </tbody>
                </table>
            </div>
        </main>

        <!-- Таблиця Зателефонувати -->
        <main class="form-container col-md-12 ms-sm-auto col-lg-12 px-md-4 mt-3" id="calls">
            <h2> Зателефонувати</h2>
            <div class="table-responsive small">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Дата</th>
                        <th scope="col">Номер телефону</th>
                        <th scope="col">Статус</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($callArray['data'] as $call):
                        $int_calls = +1;
                        $callStatus = $callController->callStatus($call['status'], $call['id']);
                        $timestamp = strtotime($call['date']);
                        $date = date("d.m.Y H:i", $timestamp);
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($int_calls) ?></td>
                            <td><?= htmlspecialchars($date) ?></td>
                            <td><?= htmlspecialchars($call['phone']) ?></td>
                            <td><?= $callStatus ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <div class="d-flex justify-content-between mt-3">
                        <?php
                        $currentPage = $callArray['page'];
                        $limit = $callArray['limit'];

                        if ($currentPage > 1) {
                            echo '<a class="btn btn-outline-primary" href="/dashboard/calls/' . ($currentPage - 1) . '">⬅️ Попередня</a>';
                        } else {
                            echo '<span></span>';
                        }

                        if (count($callArray['data']) === $limit) {
                            echo '<a class="btn btn-outline-primary" href="/dashboard/calls/' . ($currentPage + 1) . '">Наступна ➡️</a>';
                        } ?>
                    </div>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<main id="users" class="form-container">
    <h2 class="text-center mt-3 mb-3">Керування користувачами</h2>
    <div class="d-flex justify-content-center align-items-start flex-wrap mb-5" style="gap: 30px;">
        <!-- Форма реєстрації -->
        <form action="/incs/handlers/account/registration_handler.php" method="POST"
              style="max-width: 400px; width: 100%;">
            <h5 class="text-center mb-3">Реєстрація</h5>
            <div class="form-group">
                <input id="c-login" type="text" class="form-control" name="c-login" placeholder="Придумайте логін"
                       required autocomplete="off">
            </div>
            <div class="form-group">
                <input id="c-password" type="password" class="form-control" name="c-password"
                       placeholder="Придумайте пароль"
                       required autocomplete="off">
            </div>
            <input type="submit" class="btn text-white btn-primary w-100" value="Зареєструвати">
        </form>

        <!-- Форма видалення -->
        <form action="/incs/handlers/account/delete_account_handler.php" method="POST"
              style="max-width: 400px; width: 100%;">
            <h5 class="text-center mb-3">Видалення</h5>
            <div class="form-group">
                <input id="d-login" type="text" class="form-control" name="d-login" placeholder="Введіть логін"
                       required autocomplete="off">
            </div>
            <input type="submit" class="btn text-white btn-danger w-100" value="Видалити">
        </form>
    </div>
</main>