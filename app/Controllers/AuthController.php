<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthController extends Controller
{
    public function show(Request $request, Response $response){
        $data = "It works";
        return $this->view->render($response, 'auth.twig', [
            'data' => $data
        ]);    
    }
}
?>