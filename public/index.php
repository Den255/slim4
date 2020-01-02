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
//$app->add(new AuthMiddleware());

$app->get('/', \IndexController::class . ':main');
$app->get('/login', \AuthController::class . ':show');
$app->post('/login', \AuthController::class . ':login');
//$app->post('/login', \AuthController::class . ':register');

$app->get('/logout', \AuthController::class . ':logout');
$app->get('/home', \HomeController::class . ':home');
/*
$app->group('/home', function (RouteCollectorProxy $group) {
    $group->get('/dashboard', \AdminController::class . ':show')
})->add(new AuthMiddleware());
*/

$app->addErrorMiddleware(true, true, true);
$app->run();