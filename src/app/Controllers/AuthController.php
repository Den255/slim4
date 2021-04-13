<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function show(Request $request, Response $response){
        return $this->view->render($response, 'auth.twig', [
            'data' => $data
        ]);    
    }

    public function login(Request $request, Response $response){
        $body = $request->getParsedBody();
        $result = $this->auth->attempt($body['name'],$body['password']);
		if (!$result) {
            return $response->withHeader('Location', '/login')->withStatus(302);	
        }
        return $response->withHeader('Location', '/home')->withStatus(302);
    }

    public function logout(Request $request, Response $response){
        $this->auth->logout();
        return $response->withHeader('Location', '/login')->withStatus(302);
    }

    public function register(Request $request, Response $response){
        $body = $request->getParsedBody();
        User::create([
			'login' => $body["name"],
			'password' => password_hash($body["password"], PASSWORD_DEFAULT),
        ]);
        return $response->withHeader('Location', '/home')->withStatus(302);
    }
}
?>