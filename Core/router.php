<?php

$core_routes = [
    'LOGIN' => [
        'Model' => 'Apps/Login/Model/LoginModel.php',
        'View' => 'Apps/Login/view',
        'Controller' => 'Apps/Login/controller/LoginController.php',
        'Name' => 'LoginController'
    ],
    'DASHBOARD' => [
        'Model' => 'Apps/Dashboard/Model/DashboardModel.php',
        'View' => 'Apps/Dashboard/view',
        'Controller' => 'Apps/Dashboard/controller/DashboardController.php',
        'Name' => 'DashboardController'
    ]
];