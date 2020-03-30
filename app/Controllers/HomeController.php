<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Auth;

use App\Models\Category;
use App\Models\User;
use App\Models\Post;

class HomeController extends Controller
{
    public function home(Request $request, Response $response,$args){
        return $this->view->render($response, 'home.twig', [
            'cats' => $cats,
            'posts' => $posts,
        ]);
    }
    public function show_posts(Request $request, Response $response,$args){
        if($args == null){
            if(Category::exist())
                $cats = Category::all();
            if(Post::exist()){
                $posts = Post::all();
            }
            return $this->view->render($response, 'posts.twig', [
                'cats' => $cats,
                'posts' => $posts,
            ]);
        }else{
            $cat = Category::select('id','name')->where('slug',$args["cat-slug"])->first();
            if(Post::exist()){
                $posts = Post::where('cat_id', $cat["id"])->get();
                //var_dump($posts);
                if($posts->isEmpty()){
                    $status = 'OK';
                    $msg = "Posts for ".$cat["name"]." not exists!";
                }else{
                    $status = 'OK';
                    $msg = "Show posts by ".$cat["name"]." category.";
                }
            }
            $payload = json_encode(['status' => $status,'msg'=>$msg,'cat_id'=>$cat["id"],'cat_slug'=>$args["cat-slug"], 'posts' => $posts,], JSON_PRETTY_PRINT);
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json');
        }

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
            $cat_id = Category::select('id')->where('slug',$body["slug"])->first();
        }else{
            $msg = "Category with slug ".$body["slug"]." exists!";
            $status = "fail";
        }
        $payload = json_encode(['status' => $status,'msg'=>$msg,'cat_id'=>$cat_id["id"], 'name' => $body["name"], 'slug' => $body["slug"],], JSON_PRETTY_PRINT);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
    public function add_post(Request $request, Response $response){
        $body = $request->getParsedBody();
        $status = "OK";
        $post = Post::where('slug',$body["slug"])->first();
        if($post == null){
            Post::create([
                'title' => $body["title"],
                'slug' => $body["slug"],
                'cat_id' => $body["cat_id"],
                'content' => $body["content"],
            ]);
            $msg = "Post added!";
            $cat_slug = Category::select('slug')->where('id',$body["cat_id"])->first();
        }else{
            $msg = "Post with slug ".$body["slug"]." exists!";
            $status = "fail";
        }
        $payload = json_encode(['status' => $status,'msg'=>$msg, 'title' => $body["title"], 'slug' => $body["slug"],'cat_slug'=>$cat_slug["slug"],], JSON_PRETTY_PRINT);
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