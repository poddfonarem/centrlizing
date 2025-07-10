<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use src\Controllers\OrderController;

$orderController = new OrderController();

$orderController->addOrder();

exit();