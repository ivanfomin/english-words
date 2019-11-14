<?php

session_start();


require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\User;
use App\Core\ConfirmUser;

if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['email'])) {

    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);
    $repeat_password = htmlspecialchars($_POST['repeat_password']);
    $email = htmlspecialchars($_POST['email']);

    $user = User::findByLog($login);
    $find_email = User::findByEmail($email);

    $message = '';
    if ($user) {
        $message = "Пользователь уже существует!";
    } elseif ($find_email) {
        $message = "Пользователь с таким почтовым ящиком уже существует!";
    } elseif ($password !== $repeat_password) {
        $message = "Пароли не совпадают! ";
    } elseif (strlen($password) < 6) {
        $message = "Пароль слишком короткий!";
    }

    if ($message !== '') {
        header('Location: /Action/Register/' . $message);
        exit;
    }
    $user = new User();
    $user->login = $login;
    $user->password = password_hash($password, PASSWORD_DEFAULT);
    $user->role = 1;
    $user->email = $email;
    $user->save();
    $confirmUser = new ConfirmUser($user);
    $confirmUser->sendConfirm();
    //$_SESSION['login'] = $login;
    //\Core\LoginUser::login($login);

    header('Location: /Action/Confirm');
} else {
    header('Location: /Action/Register');
}

