<?php
namespace Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController extends Controller
{
    public function home(Request $request, Response $response){
        
        $name = "Den";
        /*
        $this->db->schema()->create('users', function ($table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->timestamps();
        });*/
        return $this->view->render($response, 'index.html', [
            'name' => $name,
            //'data' => $data,
        ]);
    }
}
?>