<?php
namespace App\Models;

use \Illuminate\Database\Schema\Blueprint;
use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Schema\Builder;
use App\Database;

class Post extends Model
{
	protected $table = 'posts';

	protected $fillable = ['title', 'cat_id','slug','content',];

	public function exist(){
        if(Database::$db->schema()->hasTable('posts'))
            return true;
        else
            return false;
    }
}