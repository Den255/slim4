<?php
namespace App;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;
use Slim\Middleware\ErrorMiddleware;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;

require __DIR__ . '/../vendor/autoload.php';

$container = new \DI\Container();
AppFactory::setContainer($container);
$app = AppFactory::create();

require __DIR__ . '/../dependecies.php';

$app->get('/', \HomeController::class . ':home');

$app->addErrorMiddleware(true, true, true);
$app->run();