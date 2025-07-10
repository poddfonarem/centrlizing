<?php

require_once __DIR__ . "/../../../vendor/autoload.php";

use src\Controllers\CallController;

$callController = new CallController();

$callController->updateCallStatus();
