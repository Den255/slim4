<?php
return [
        // Slim Settings
        //'determineRouteBeforeAppMiddleware' => false,
        //'displayErrorDetails' => true,
        'templates'=>'../templates',
        'cache' => false,
        'db' => [
            'driver' => 'mysql',
            'host' => getenv('DB_HOST'),
            'database' => getenv('DB_NAME'),
            'username' => getenv('DB_USER'),
            'password' => getenv('DB_PASSWORD'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ];