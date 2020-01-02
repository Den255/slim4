<?php
namespace App\Controllers;
use App\Controllers\Controller as Controller;
use App\Models\User;

//use App\Migrations\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

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
		if (! $result) {
            return $this->view->render($response, 'auth.twig', [
                'result' => "Login failure!",
            ]);	
		}
        return $this->view->render($response, 'home.twig', [
            'result' => "OK",
        ]);
    }
    public function logout(Request $request, Response $response){
        $result = $this->auth->logout();
        return $this->view->render($response, 'auth.twig',[
            'result' => $result,
        ]);
    }
    public function register(Request $request, Response $response){
        $body = $request->getParsedBody();
        $user = User::create([
			'login' => $body["name"],
			'password' => password_hash($body["password"], PASSWORD_DEFAULT),
        ]);
        return $this->view->render($response, 'index.twig', [
            'result' => $user,
        ]);
    }
}
?>