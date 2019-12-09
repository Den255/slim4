<?php
namespace App;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController extends Controller
{
    public function home(Request $request, Response $response){
        $name = "Den";
        $data = $this->db;
        var_dump($data);
        //print_r($data);
        return $this->view->render($response, 'index.html', [
            'name' => $name,
            //'data' => $data,
        ]);
    }
}
?>