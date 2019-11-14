<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

if (empty($_POST['email']) || empty($_POST['password'])) {
    $message = 'Оба поля обязательны!';
    header('Location: ' . "/Index/Enter/" . $message);
    exit;
}

$email = $_POST['email'];
$password = $_POST['password'];

$user = \App\Core\LoginUser::checkEmailPassword($email, $password);
if (!$user) {
    $message = 'Не правильный email - пароль!';
    header('Location: ' . "/Index/Enter/" . $message);
    exit;
}

if ($user->active != 1) {
    $message = 'Не пройдено подтверждение!';
    header('Location: ' . "/Index/Enter/" . $message);
    exit;
}

$_SESSION['email'] = $email;

\App\Core\LoginUser::login($email);

header('Location: /');
exit;