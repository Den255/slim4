<?php
namespace App\Migrations;

use \Illuminate\Database\Schema\Builder;
use \Illuminate\Database\Schema\Blueprint;
use App\Database as Database;

class Users
{
    static $name = 'users';
    public function up()
    {
        Database::$db->schema()->create(self::$name, function (Blueprint $table) {
            $table->increments('id');
            $table->string('login')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }
    public function exist(){
        if(Database::$db->schema()->hasTable(self::$name))
            return true;
        else
            return false;
    
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(self::$name);
    }
}
?>