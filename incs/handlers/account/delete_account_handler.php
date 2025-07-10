<?php

require_once __DIR__ . "/../../../vendor/autoload.php";

use src\Controllers\LoginController;

$loginController = new LoginController();

$loginController->deleteAccount();

exit();