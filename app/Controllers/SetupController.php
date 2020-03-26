<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\Controller;
use App\Models\User;
use App\Migrations\Users;
use App\Migrations\Categories;

use \Dotenv\Store\File\Paths as Envpath;

class SetupController extends Controller
{
    function main(Request $request, Response $response){

        if($this->check()){
            return $this->view->render($response, 'setup.twig', [
                'result' => $result,
            ]);
        }else{
            return $response->withHeader('Location', '/')->withStatus(302);
        }
        
    }
    function show(Request $request, Response $response){

        if($this->check()){
            return $this->view->render($response, 'add_user.twig', [
                'result' => $result,
            ]);
        }else{
            return $response->withHeader('Location', '/')->withStatus(302);
        }
        
    }
    function setup(Request $request, Response $response){
        $body = $request->getParsedBody();
        if($this->check()){
            $path = $this->getenvpath();
            $content = file_get_contents($path); 
            // Осуществляем замену 
            $content = explode("\n",$content);
            foreach($content as &$line){
                $chg_line = false;
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
            return $response->withHeader('Location', '/adduser')->withStatus(302);
        }else{

        }
    }
    function disable_setup(Request $request, Response $response){
        $this->putenv("SETUP_MODE","false");
        print_r("OK");
        return $response;
    }
    function add_user(Request $request, Response $response){
        if($this->check()){
        $body = $request->getParsedBody();
        //Add table users
        $users = new Users();
        $users->up();
        //Add user
        User::create([
            'login' => $body["name"],
            'password' => password_hash($body["password"], PASSWORD_DEFAULT),
        ]);
        }else{
            //Error message
        }
        return $response->withHeader('Location', '/login')->withStatus(302);
    }
    function show_db(Request $request, Response $response){
        $users = new Users();
        $cats = new Categories();
        $result = array(
            "Users"=>[
                "name"=>$users::$name,
                "exist"=>$users::exist()
            ],
            "Categories"=>[
                "name"=>$cats::$name,
                "exist"=>$cats::exist()
            ],
        );
        //print_r("<div style='height:60px;'></div><div><pre>");
        //$path = $this->get_migrations_path();
        //$result = glob($path.'/*.php');
        //foreach($result as &$class_name){
        //    $class_name = basename($class_name,'.php');
        //}
        //var_dump($result);
        //print_r("</div>");
        return $this->view->render($response, 'db-page.twig', [
            'result' => $result,
        ]);
    }
    function create_table(){
        
    }
    #########################
    #### Other functions ####
    #########################
    function check(){
        $this->env->load();
        if(getenv('SETUP_MODE')=='true')
            return true;
        else
            return false;
    }
    function getenvpath(){
        $path = $_SERVER["SCRIPT_FILENAME"];
        $pos=strripos($path, "/");
        $path=substr($path, 0, $pos);
        $pos=strripos($path, "/");
        $path=substr($path, 0, $pos);
        $path = $path."/.env";
        return $path;
    }
    function get_migrations_path(){
        $path = $_SERVER["SCRIPT_FILENAME"];
        $path = $_SERVER["SCRIPT_FILENAME"];
        $pos=strripos($path, "/");
        $path=substr($path, 0, $pos);
        $pos=strripos($path, "/");
        $path=substr($path, 0, $pos);
        $path=$path."/app/Migrations";
        return $path;
    }
    function putenv($key, $value){
        $path = $this->getenvpath();
        $content = file_get_contents($path); 
        // Осуществляем замену 
        $content = explode("\n",$content);
        foreach($content as &$line){
            $chg_line = false;
            if(!(stristr($line, $key) === FALSE)){
                $line = $key." = ".$value;
                $chg_line = true;
            }else{
                $line = "\n".$line;
            }
        }
        file_put_contents($path,$content);
        return true;
    }
}
?>