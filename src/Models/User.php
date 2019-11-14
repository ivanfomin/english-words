<?php

namespace App\Models;
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Core\Db;
use App\Core\Model;

class User
    extends Model
{

    public static $table = 'users';

    public $id;
    public $email;
    public $login;

    public static function findByLog($login)
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE login=:login';
        $data = $db->query($sql, [':login' => $login], static::class);
        return $data[0] ?? false;
    }

    public static function findByEmail($email)
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE email=:email';
        $data = $db->query($sql, [':email' => $email], static::class);
        return $data[0] ?? false;
    }

    public static function findByToken($token)
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE token=:token';
        $data = $db->query($sql, [':token' => $token], static::class);
        return $data[0] ?? false;
    }

    public static function countActiveUsers()
    {
        $db = Db::getInstance();
        $sql = "SELECT COUNT(1)  FROM " . static::$table . " WHERE addtime(lastuse, '00:05:00') > NOW()";
        $users = $db->query($sql);
        return $users[0]["COUNT(1)"];

    }


}