<?php
namespace App\Models;

use \Illuminate\Database\Schema\Blueprint;
use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Schema\Builder;
use App\Database;

class User extends Model
{
	protected $table = 'users';
	public $first_name;
	public $last_name;
	public $login;
	protected $fillable = ['login', 'name', 'password'];
}