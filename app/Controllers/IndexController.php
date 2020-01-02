<?php
namespace App\Controllers;

//use App\Migrations\User;
use App\Models\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class IndexController extends Controller
{
    public function main(Request $request, Response $response){
        //$result = User::method();
        
        return $this->view->render($response, 'index.twig', [
            'result' => $result,
        ]);
    }
}
?>