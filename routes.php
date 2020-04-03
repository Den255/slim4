<?php
namespace App;

use Slim\Routing\RouteCollectorProxy;
use App\AuthMiddleware;

$app->get('/', \IndexController::class . ':main');

$app->get('/setup', \SetupController::class . ':main');
$app->post('/setup', \SetupController::class . ':setup');

$app->get('/add-user', \SetupController::class . ':show');
$app->post('/add-user', \SetupController::class . ':add_user');

$app->get('/login', \AuthController::class . ':show');
$app->post('/login', \AuthController::class . ':login');

$app->group('/', function (RouteCollectorProxy $group) {
    $group->get('home', \HomeController::class . ':home');
    $group->get('home/setup-off', \SetupController::class . ':disable_setup');
    $group->get('home/logout', \AuthController::class . ':logout');

    $group->get('home/db-status', \SetupController::class . ':show_db');
    $group->get('home/create-table/{name}', \SetupController::class . ':create_table');
    //Create
    $group->post('home/add-cat', \HomeController::class . ':add_cat');
    $group->post('home/add-post', \HomeController::class . ':add_post');
    //Show
    $group->get('home/cat/{cat-slug}', \HomeController::class . ':show_posts');
    $group->get('home/posts', \HomeController::class . ':show_posts');
    //Edit
    $group->get('home/edit/cat-{id}', \HomeController::class . ':edit_cat');
    $group->get('home/edit/post-{id}', \HomeController::class . ':edit_post');
    //Delete
    $group->get('home/delete/cat-{id}', \HomeController::class . ':del_cat');
    $group->get('home/delete/post-{id}', \HomeController::class . ':del_post');
})->add(new AuthMiddleware($container));

$app->get('/blog', \IndexController::class . ':show_post');
$app->get('/blog/{cat-slug}', \IndexController::class . ':show_post');
$app->get('/blog/{cat-slug}/{post-slug}', \IndexController::class . ':show_post');
?>