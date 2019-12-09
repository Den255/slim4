<?php
namespace App;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\Capsule\Manager as Illuminate;
use Slim\views\Twig as Twig;

class Controller
{
    protected $view,$db;

    public function __construct(Twig $view,Illuminate $db) {
        $this->view = $view;
        $this->db = $db;
    }
}
?>