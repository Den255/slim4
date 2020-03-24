<?php
namespace App\Migrations;

use \Illuminate\Database\Schema\Builder;
use \Illuminate\Database\Schema\Blueprint;
use App\Database as Database;

class Categories
{
    private $name = 'cats';
    public function up()
    {
        Database::$db->schema()->create($name, function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('name');
            $table->timestamps();
        });
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