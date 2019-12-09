<?php
namespace App;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController
{
    protected $view;

    public function home(Request $request, Response $response){
        $name = "Den";
        return $this->view->render($response, 'index.html', [
            'name' => $name,
        ]);
    }
}
?>