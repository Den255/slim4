<?php
namespace App\Migrations;

use \Illuminate\Database\Schema\Builder;
use \Illuminate\Database\Schema\Blueprint;
use App\Database as Database;

class Users
{
    private $name = 'users';
    public function up()
    {
        if(Database::$db->schema()->hasTable($name))
            $message = "Table ".$name." already exsists!";
        else{
            Database::$db->schema()->create($name, function (Blueprint $table) {
                $table->increments('id');
                $table->string('login')->unique();
                $table->string('password');
                $table->timestamps();
            });
            $message = "OK!";
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
        Schema::drop($name);
    }
}
?>