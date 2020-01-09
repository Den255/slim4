<?php
namespace App;
use Illuminate\Database\Capsule\Manager as Illuminate;
use Psr\Container\ContainerInterface;
use Slim\views\Twig;

session_start();

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
$container->set('auth', function(ContainerInterface $c){
    return new Auth();
});
$container->set('db', function(ContainerInterface $c){
    $settings = $c->get('settings');
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($settings['db'],"default");
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    return $capsule;
});

$controllers = glob('../app/Controllers/*.php');

foreach($controllers as $filename){
    $classname = basename($filename,'.php');
    $container->set($classname, function (ContainerInterface $c) use($classname) {
        $view = $c->get('view');
        $auth = $c->get('auth');
        $classname = 'App\\Controllers\\'.$classname;
        return new $classname($view, $auth);
    });
}
$container->set('Middleware', function(ContainerInterface $c) {
    return new Middleware($c);
});
$db = $container->get('db');
 new Database($db);

?>