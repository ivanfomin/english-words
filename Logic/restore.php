<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\User;
use App\Core\ConfirmUser;

if (!empty($_POST['email'])) {

    $email = htmlspecialchars($_POST['email']);

    $user = User::findByEmail($email);


    if ($user) {
        $confirmUser = new ConfirmUser($user);
        $confirmUser->restore();
    }


}
header('Location: /');
