<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\Post;
use App\Models\Category;

class IndexController extends Controller
{
    public function main(Request $request, Response $response){
        $categories = Category::all();
        $posts = Post::paginate(10);
        $result = "Hello!";
        return $this->view->render($response, 'blog/index.twig', [
            'categories' => $categories,
            'posts' => $posts,
        ]);
    }
    public function show_post(Request $request, Response $response, $args){
        $categories = Category::all();
        if($args["cat-slug"]==NULL){
            $posts = Post::paginate(10);
            $template = 'blog/post-list.twig';
        }elseif($args["post-slug"]==NULL){
            foreach($categories as $cat){
                if($cat["slug"]==$args["cat-slug"]){
                    $cat_id = $cat["id"];
                    break;
                }
            }
            $posts = Post::select()->where('cat_id',$cat_id)->paginate(10);
            $template = 'blog/post-list.twig';
        }else{
            $posts = Post::select()->where('slug',$args["post-slug"])->first();
            $template = 'blog/single-post.twig';
        }
        return $this->view->render($response, $template, [
            'categories' => $categories,
            'posts' => $posts,
            'cat_slug'=> $args["cat-slug"],
        ]);
    }
}
?>