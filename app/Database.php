<?php
namespace App;

use Illuminate\Database\Capsule\Manager as Illuminate;

class Database
{
    public static $db;
    public function __construct(Illuminate $db) {
        self::$db = $db;
    }
}
?>