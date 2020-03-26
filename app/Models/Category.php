<?php
namespace App\Models;

use \Illuminate\Database\Schema\Blueprint;
use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Schema\Builder;
use App\Database;

class Category extends Model
{
	protected $table = 'cats';
	public $name;
	public $slug;
	protected $fillable = ['name', 'slug'];

	public function exist(){
        if(Database::$db->schema()->hasTable('cats'))
            return true;
        else
            return false;
    }
}