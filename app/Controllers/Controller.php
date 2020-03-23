<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;

class Controller
{
    //protected $c;

    public function __construct(ContainerInterface $c) {
        $this->view = $c->get('view');
        $this->auth = $c->get('auth');
        $this->env = $c->get('env');
    }
}
?>