<?php
namespace App;

use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Psr7\Response as NewResponse;

class AuthMiddleware extends Middleware
{
    public function __invoke(Request $request, RequestHandler $handler): Response{
		if( $this->container->get('auth')->check()) {
            $response = $handler->handle($request);
			return $response;//->withHeader('Location', '/home')->withStatus(302);
        }else{
            $response = new NewResponse();
            return $response->withHeader('Location', '/login')->withStatus(302);   
        }
    }

}