<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\User;

class IndexController extends Controller
{
    public function main(Request $request, Response $response){
        return $this->view->render($response, 'index.twig', [
            'result' => $result,
        ]);
    }
}
?>