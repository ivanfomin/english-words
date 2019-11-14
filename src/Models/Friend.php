<?php

namespace App\Models;
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Core\Db;
use App\Core\Model;

class Friend extends Model
{
    public static $table = 'friends';

    public $user_id;
    public $friend_id;

    public static function findByUserIdFriendId($user_id, $friend_id)
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE user_id=:user_id AND friend_id=:friend_id';
        $data = $db->query($sql, [':user_id' => $user_id, ':friend_id' => $friend_id], static::class);
        return $data[0] ?? false;
    }

    public static function findAllMyFriends($user_id)
    {
        $db = Db::getInstance();
        $sql = 'SELECT friend_id, login, email, users.id FROM ' . static::$table . ' INNER JOIN users ON ' . static::$table . '.friend_id = users.id WHERE user_id=:user_id';
        $data = $db->query($sql, [':user_id' => $user_id], static::class);
        return $data;
    }

    public static function deleteMyFriend($user_id, $friend_id)
    {
        $sql = 'DELETE FROM ' . static::$table . ' WHERE user_id= ' . $user_id . ' AND friend_id=' . $friend_id;
        $db = Db::getInstance();
        $db->execute($sql);
    }

}