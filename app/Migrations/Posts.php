<?php
namespace App\Migrations;

use \Illuminate\Database\Schema\Builder;
use \Illuminate\Database\Schema\Blueprint;
use App\Database as Database;

class Posts
{
    static $name = 'posts';
    public function up()
    {
        Database::$db->schema()->create(self::$name, function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('cat_id');
            $table->string('slug')->unique();
            $table->string('title');
            $table->binary('content');
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