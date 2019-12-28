<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController extends Controller
{
    public function home(Request $request, Response $response){
        //print_r("<pre>");
        $name = "Den";
        if($this->db->schema()->hasTable('users'))
            //print_r("Таблица уже существует");
            ;
        else{
            $this->db->schema()->create('users', function ($table) {
                $table->increments('id');
                $table->string('email')->unique();
                $table->timestamps();
            });
        }
        return $this->view->render($response, 'index.twig', [
            'name' => $name,
            //'data' => $result,
        ]);
    }
}
?>