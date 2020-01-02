<?php
namespace App\Migrations;

use \Illuminate\Database\Schema\Builder;
use \Illuminate\Database\Schema\Blueprint;
use App\Database as Database;

class User
{
    private $name = 'users';
    public function up()
    {
        if(Database::$db->schema()->hasTable($name))
            $message = "Table ".$name." already exsists!";
        else{
            Database::$db->schema()->create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('login')->unique();
                $table->string('password');
                $table->timestamps();
            });
        }
        return $message;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
?>