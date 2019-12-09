<?php
namespace App;
use Illuminate\Database\Capsule\Manager as Illuminate;
use Psr\Container\ContainerInterface;
use Slim\views\Twig;

$container = $app->getContainer();
$container->set('settings', function(ContainerInterface $c){
    $settings = require __DIR__ . './settings.php';
    return $settings;
});

$container->set('view', function(ContainerInterface $c){
    $settings = $c->get('settings');
    return new \Slim\Views\Twig($settings['templates']);
});

$container->set('db', function(ContainerInterface $c){
    $settings = $c->get('settings');
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($settings['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    return $capsule;
});



$container->set('Controller', function (ContainerInterface $c) {
    $view = $c->get('view');
    $db = $c->get('db');
    return new Controller($view,$db);
});

$container->set('HomeController', function (ContainerInterface $c) {
    $view = $c->get('view');
    $db = $c->get('db');
    return new HomeController($view,$db);
});
?>