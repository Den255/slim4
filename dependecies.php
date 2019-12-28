<?php
namespace App\Controllers;
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
    return new \Slim\Views\Twig($settings['templates'], [
		'cache' => false,
	]);
});

$container->set('db', function(ContainerInterface $c){
    $settings = $c->get('settings');
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($settings['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    return $capsule;
});

foreach(glob('../app/Controllers/*.php') as $filename){
    $classname = basename($filename,'.php');
    $container->set($classname, function (ContainerInterface $c) use($classname) {
        $view = $c->get('view');
        $db = $c->get('db'); 
        $classname = 'App\\Controllers\\'.$classname;
        return new $classname($view,$db);
    });
}
?>