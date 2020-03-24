<?php
namespace App;
use Illuminate\Database\Capsule\Manager as Illuminate;
use Psr\Container\ContainerInterface;
use Slim\views\Twig;

session_start();

$container = $app->getContainer();
//Set env
$container->set('env', function(ContainerInterface $c) {
    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
    return $dotenv;
});
$env = $container->get('env');
$env->load();
//Set settings
$container->set('settings', function(ContainerInterface $c){
    $settings = require __DIR__ . '/settings.php';
    return $settings;
});
//Set view
$container->set('view', function(ContainerInterface $c){
    $settings = $c->get('settings');
    return new \Slim\Views\Twig($settings['templates'], [
		'cache' => false,
	]);
});
//Set auth
$container->set('auth', function(ContainerInterface $c){
    return new Auth();
});
//Set db
$container->set('db', function(ContainerInterface $c){
    $settings = $c->get('settings');
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($settings['db'],"default");
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    return $capsule;
});
//Set middleware
$container->set('Middleware', function(ContainerInterface $c) {
    return new Middleware($c);
});

$controllers = glob('../app/Controllers/*.php');

foreach($controllers as $filename){
    $classname = basename($filename,'.php');
    $container->set($classname, function (ContainerInterface $c) use($classname) {
        $classname = 'App\\Controllers\\'.$classname;
        return new $classname($c);
    });
}

$db = $container->get('db');
 new Database($db);

?>