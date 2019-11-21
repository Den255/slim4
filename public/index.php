<?php
namespace App;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;
use Slim\Middleware\ErrorMiddleware;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;

require __DIR__ . '/../vendor/autoload.php';
//require __DIR__ . '/../vendor/autoload.php';

$container = new \DI\Container();

AppFactory::setContainer($container);

$app = AppFactory::create();

$container = $app->getContainer();

$container->set('view', function(\Psr\Container\ContainerInterface $container){
    return new \Slim\Views\Twig('../templates');
});

$container->set('HomeController', function (ContainerInterface $c) {
    $view = $c->get('view'); // retrieve the 'view' from the container
    return new HomeController($view);
});

$app->get('/', \HomeController::class . ':home');

$app->addErrorMiddleware(true, true, true);
$app->run();