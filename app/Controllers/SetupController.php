<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\Controller;

use \Dotenv\Store\File\Paths as Envpath;

class SetupController extends Controller
{
    function check(){
        $this->env->load();
        if(getenv('SETUP_MODE')=='true')
            return true;
        else
            return false;
    }
    function main(Request $request, Response $response){

        if($this->check()){
            return $this->view->render($response, 'setup.twig', [
                'result' => $result,
            ]);
        }else{
            return $response->withHeader('Location', '/')->withStatus(302);
        }
        
    }
    function setup(Request $request, Response $response){
        print_r("<pre>");
        if($this->check()){
            //Setup db
           
            $path = $_SERVER["SCRIPT_FILENAME"];
            $pos=strripos($path, "/");
            $path=substr($path, 0, $pos);
            $pos=strripos($path, "/");
            $path=substr($path, 0, $pos);
            $path = $path."/.env";
            var_dump($path);

            $content = file_get_contents($path); 
            // Осуществляем замену 
            $content = explode("\n",$content);
            foreach($content as &$line){
                if(!(stristr($line, "SETUP_MODE") === FALSE)){
                    $line = "SETUP_MODE = false\n";
                }
            }
            // Перезаписываем файл 
            file_put_contents($path,$content); 

            $body = $request->getParsedBody();
            $result = $this->auth->attempt($body['name'],$body['password']);
        }else{

        }
    }
}
?>