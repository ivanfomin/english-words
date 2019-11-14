<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\User;

if (!empty($_POST['password']) && !empty($_POST['repeat_password'])) {
    $message = '';
    $user = User::findById($_POST['id']);
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];
    if (strlen($password) < 6) {
        $message = "Пароль слишком короткий!";
    } elseif ($password !== $repeat_password) {
        $message = "Пароли не совпадают!";
    }
    $id = $_POST['id'];
    if ($message !== '') {
        header('Location: /Friends/Restore/' . $id . '/' . $message);
        exit;
    }
    $user = User::findById($id);

    $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user->save();

    $login = $user->login;
    $_SESSION['login'] = $login;

    App\Core\LoginUser::login($login);
    header('Location: /');


}





