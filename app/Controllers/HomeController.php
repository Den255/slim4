<?php
namespace App\Controllers;

//use App\Migrations\User;
use App\Models\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController extends Controller
{
    public function home(Request $request, Response $response){        
        return $this->view->render($response, 'home.twig', [
            'result' => $result,
        ]);
    }
}
?>