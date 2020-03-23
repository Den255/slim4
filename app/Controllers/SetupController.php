<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\Controller;
use App\Migrations\User;

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
        $body = $request->getParsedBody();
        print_r("<pre>");
        if($this->check()){
        //Setup env
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
                $chg_line = false;
                if(!(stristr($line, "SETUP_MODE") === FALSE)){
                    $line = "SETUP_MODE = false";
                    $chg_line = true;
                }
                if(!(stristr($line, "DB_HOST") === FALSE)){
                    $line = "\nDB_HOST = '".$body["dbhost"]."'";
                    $chg_line = true;
                }
                if(!(stristr($line, "DB_NAME") === FALSE)){
                    $line = "\nDB_NAME = '".$body["dbname"]."'";
                    $chg_line = true;
                }
                if(!(stristr($line, "DB_USER") === FALSE)){
                    $line = "\nDB_USER = '".$body["dbuser"]."'";
                    $chg_line = true;
                }
                if(!(stristr($line, "DB_PASSWORD") === FALSE)){
                    $line = "\nDB_PASSWORD = '".$body["dbpassword"]."'\n";
                    $chg_line = true;
                }
                if(!$chg_line){
                    $line = "\n".$line;
                }
            }
            // Перезаписываем файл 
            file_put_contents($path,$content); 
            $user = new User();
            $user->up();
            /*
            $body = $request->getParsedBody();
            User::create([
                'login' => $body["name"],
                'password' => password_hash($body["password"], PASSWORD_DEFAULT),
            ]);
            */
            return $response->withHeader('Location', '/login')->withStatus(302);
        }else{

        }
    }
}
?>