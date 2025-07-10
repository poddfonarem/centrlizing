<?php

use src\Controllers\PageController;

return [
    'routes' => [

//  pages
        '' => [PageController::class, 'home'],
        'dashboard' => [PageController::class, 'dashboard'],
        'order' => [PageController::class, 'order'],
        'status' => [PageController::class, 'status'],

// errors pages
        '403' => [PageController::class, 'show403'],
        '404' => [PageController::class, 'show404'],
    ],
];
