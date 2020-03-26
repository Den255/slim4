<?php
namespace App;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;
use Slim\Middleware\ErrorMiddleware;
use Slim\Routing\RouteCollectorProxy;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use App\AuthMiddleware;

require __DIR__ . '/../vendor/autoload.php';

$container = new \DI\Container();
AppFactory::setContainer($container);
$app = AppFactory::create();

require __DIR__ . '/../dependecies.php';
//$app->add(new AuthMiddleware());
$app->get('/', \IndexController::class . ':main');

$app->get('/setup', \SetupController::class . ':main');
$app->post('/setup', \SetupController::class . ':setup');

$app->get('/add-user', \SetupController::class . ':show');
$app->post('/add-user', \SetupController::class . ':add_user');

$app->get('/login', \AuthController::class . ':show');
$app->post('/login', \AuthController::class . ':login');

//$authmw = new AuthMiddleware();
//$app->get('/home', \HomeController::class . ':home')->add($authmw);
/*
$app->group('/home', function (RouteCollectorProxy $group) {
    $group->get('/dashboard', \AdminController::class . ':show')
});*/
$app->group('/', function (RouteCollectorProxy $group) {
    $group->get('home', \HomeController::class . ':home');
    $group->get('home/posts', \HomeController::class . ':showposts');
    $group->get('home/setup-off', \SetupController::class . ':disable_setup');
    $group->get('home/logout', \AuthController::class . ':logout');

    $group->get('home/db-status', \SetupController::class . ':show_db');
    $group->get('home/create-table/{name}', \SetupController::class . ':create_table');

    $group->post('home/add-cat', \HomeController::class . ':add_cat');
})->add(new AuthMiddleware($container));

$app->addErrorMiddleware(true, true, true);
$app->run();