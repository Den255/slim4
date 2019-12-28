<?php
return [
        // Slim Settings
        //'determineRouteBeforeAppMiddleware' => false,
        //'displayErrorDetails' => true,
        'templates'=>'../templates',
        'cache' => false,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'db_slim',
            'username' => 'root',
            'password' => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ];