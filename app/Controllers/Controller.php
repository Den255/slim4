<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\views\Twig as Twig;
use App\Auth as Auth;

class Controller
{
    protected $view,$db;

    public function __construct(Twig $view,Auth $auth) {
        $this->view = $view;
        $this->auth = $auth;
    }
}
?>