<?php

namespace App\Models;

use App\Core\Model;
use App\Core\Db;

class Word extends Model
{
    public static $table = 'words';

    public $id;
    public $en;
    public $ru;

    public static function findByWord($en)
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE en=:en';
        $data = $db->query($sql, [':en' => $en], static::class);
        return $data[0] ?? false;
    }

    public static function findAllByUserId($user_id)
    {
        $db = Db::getInstance();
        $sql = 'SELECT id, en, ru  FROM users_words INNER JOIN words ON users_words.word_id = words.id WHERE users_words.user_id=:user_id 
            ORDER BY id DESC';
        $data = $db->query($sql, [':user_id' => $user_id], static::class);
        return $data;
    }

    public static function findPageByUserId($user_id, $start, $num)
    {
        $db = Db::getInstance();
        $sql = 'SELECT id, en, ru  FROM users_words INNER JOIN words ON users_words.word_id = words.id WHERE users_words.user_id=:user_id 
            ORDER BY id DESC LIMIT ' . $start . ' ,' . $num;
        $data = $db->query($sql, [':user_id' => $user_id], static::class);
        $sql = 'UPDATE users SET lastuse = NOW() WHERE users.id = ' . $user_id;
        $db->execute($sql);
        return $data;
    }

    public static function findPageByDate($user_id, $start, $num)
    {
        $db = Db::getInstance();
        $sql = 'SELECT id, en, ru  FROM users_words INNER JOIN words ON users_words.word_id = words.id WHERE users_words.user_id=:user_id 
            ORDER BY date DESC LIMIT ' . $start . ' ,' . $num;
        $data = $db->query($sql, [':user_id' => $user_id], static::class);
        return $data;
    }

    public static function findPageByAlphabetic($user_id, $start, $num)
    {
        $db = Db::getInstance();
        $sql = 'SELECT id, en, ru  FROM users_words INNER JOIN words ON users_words.word_id = words.id WHERE users_words.user_id=:user_id 
            ORDER BY en LIMIT ' . $start . ' ,' . $num;
        $data = $db->query($sql, [':user_id' => $user_id], static::class);
        return $data;
    }

    public static function findAllByUserIdSortDate($user_id)
    {
        $db = Db::getInstance();
        $sql = 'SELECT id, en, ru  FROM users_words INNER JOIN words ON users_words.word_id = words.id WHERE users_words.user_id=:user_id 
            ORDER BY date DESC ';
        $data = $db->query($sql, [':user_id' => $user_id], static::class);
        return $data;
    }

    public static function findAllByUserIdSortAlphabetic($user_id)
    {
        $db = Db::getInstance();
        $sql = 'SELECT id, en, ru  FROM users_words INNER JOIN words ON users_words.word_id = words.id WHERE users_words.user_id=:user_id 
            ORDER BY en';
        $data = $db->query($sql, [':user_id' => $user_id], static::class);
        return $data;
    }

    public static function countWords($user_id)
    {
        $db = Db::getInstance();
        $sql = 'SELECT COUNT(1)  FROM users_words INNER JOIN words ON users_words.word_id = words.id WHERE users_words.user_id=:user_id';
        $data = $db->query($sql, [':user_id' => $user_id]);
        return $data[0]["COUNT(1)"];
    }


}