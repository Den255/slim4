<?php
namespace App\Migrations;

use \Illuminate\Database\Schema\Builder;
use \Illuminate\Database\Schema\Blueprint;
use App\Database as Database;

class Categories
{
    static $name = 'cats';
    public function up()
    {
        Database::$db->schema()->create(self::$name, function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('name');
            $table->timestamps();
        });
        return $message;
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