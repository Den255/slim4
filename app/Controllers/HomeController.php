<?php
namespace App\Controllers;

//use App\Migrations\User;
use App\Models\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Auth as Auth;
use App\Models\Category;
class HomeController extends Controller
{
    public function home(Request $request, Response $response){
        if(Category::exist())
            $cats = Category::all();
        return $this->view->render($response, 'home.twig', [
            'cats' => $cats,
        ]);
    }
    public function add_cat(Request $request, Response $response){
        $body = $request->getParsedBody();
        $status = "OK";
        $cat = Category::where('slug',$body["slug"])->first();
        if($cat == null){
            Category::create([
                'name' => $body["name"],
                'slug' => $body["slug"],
            ]);
            $msg = "Category added!";
        }else{
            $msg = "Category with slug ".$body["slug"]." exists!";
            $status = "fail";
        }
        $payload = json_encode(['status' => $status,'msg'=>$msg, 'name' => $body["name"], 'slug' => $body["slug"],], JSON_PRETTY_PRINT);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
    public function showcats(Request $request, Response $response){  
        return $this->view->render($response, 'home.twig', [
            'result' => $result,
        ]);
    }
}
?>