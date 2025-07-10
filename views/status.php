<?php

use src\Controllers\OrderController;

$orderController = new OrderController();
?>

<div class="site-section bg-image my-rounded box-shadow" style="background-image: url('/assets/images/hero3.jpg')">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 text-center bg-glass p-4 my-rounded box-shadow-yellow">
                <h2 class="font-weight-bold text-white text-uppercase">Статус заявки</h2>
                <p class="font-weight-bold text-white">Щоб перевірити статус заявки введіть свій номер телефону
                    у поле нижче</p>
                <form method="POST">
                    <label for="phone"></label>
                    <input autocomplete="on" id="phone" name="phone" class="form-control mb-3"
                           placeholder="380665375577" type="tel" maxlength="12">
                    <button type="submit" class="btn btn-primary box-shadow-yellow text-white py-3 px-4">Перевірити
                    </button>
                </form>
                <?php if (isset($_POST['phone'])):
                    $phone = htmlspecialchars($_POST['phone']);

                    if ($phone > 0):
                        $findOrder = $orderController->findOrder($phone);

                        if (!empty($findOrder)):
                            foreach ($findOrder as $order):
                                $findOrderStatus = $orderController->findOrderStatus($order['status']);
                                ?>
                                <div class="mt-4 bg-glass border-top text-center my-rounded p-4">
                                    <h2 class="font-weight-bold text-white text-uppercase">Результат пошуку:</h2>
                                    <p class="font-weight-bold text-yellow">
                                        <span class="text-white">Ім'я:</span>
                                        <?= htmlspecialchars($order['name']) . " " . htmlspecialchars($order['surname']) ?>
                                    </p>
                                    <p class="font-weight-bold text-yellow">
                                        <span class="text-white">Номер телефону:</span>
                                        <?= htmlspecialchars($phone) ?>
                                    </p>
                                    <p class="font-weight-bold text-yellow">
                                        <span class="text-white">Статус:</span>
                                        <?= $findOrderStatus ?>
                                    </p>
                                </div>
                            <?php endforeach;
                        else: ?>
                            <div class="mt-3 text-center p-4 my-rounded">
                                <h2 class="font-weight-bold text-white text-uppercase">Результат пошуку:</h2>
                                <p class="font-weight-bold text-yellow">
                                    <span class="text-white">Нічого</span> НЕ ЗНАЙДЕНО
                                </p>
                            </div>
                        <?php endif;
                    endif;
                endif; ?>
            </div>
        </div>
    </div>
</div>