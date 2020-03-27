<?php
namespace App;

use Slim\Middleware\ErrorMiddleware;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$container = new \DI\Container();
AppFactory::setContainer($container);
$app = AppFactory::create();

require __DIR__ . '/../dependecies.php';

require __DIR__ . '/../routes.php';

$app->addErrorMiddleware(true, true, true);
$app->run();