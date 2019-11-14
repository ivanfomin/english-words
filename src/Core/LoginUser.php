<?php
/**
 * Created by PhpStorm.
 * User: ioan
 * Date: 09.12.16
 * Time: 13:10
 */

namespace App\Core;

use App\Models\User;

class LoginUser
{
    public static function checkEmailPassword($email, $password)
    {
        $user = User::findByEmail($email);
        if (password_verify($password, $user->password)) {
            return $user;
        }
        return null;
    }

    public static function login($email)
    {
        setcookie('auth', $email, time() + 86400, '/');
    }

    public static function logout()
    {
        unset($_COOKIE['auth']);
        setcookie('auth', '', time() - 1, '/');
    }

    public static function check()
    {
        if (isset($_COOKIE['auth'])) {
            return User::findByEmail($_COOKIE['auth']);
        }

        return null;

    }
}