<?php

namespace App\Models;

use App\Core\Model;
use App\Core\Db;

class UserWord extends Model
{
    public static $table = 'users_words';

    public $user_id;
    public $word_id;

    public static function findByUserIdWordId($user_id, $word_id)
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE user_id=:user_id AND word_id=:word_id';
        $data = $db->query($sql, [':user_id' => $user_id, ':word_id' => $word_id], static::class);
        return $data[0] ?? false;
    }

    public static function deleteByUserIdWordId($user_id, $word_id)
    {
        $sql = 'DELETE FROM ' . static::$table . ' WHERE user_id= ' . $user_id . ' AND word_id=' . $word_id;
        $db = Db::getInstance();
        $db->execute($sql);
    }
}