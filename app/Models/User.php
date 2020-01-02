<?php
namespace App\Models;
use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Schema\Builder;
use \Illuminate\Database\Schema\Blueprint;
use App\Database as Database;

class User extends Model
{
	protected $table = 'users';
	public $first_name;
	public $last_name;
	public $login;
	protected $fillable = ['login', 'name', 'password'];
}