<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

if (!empty($_POST['friend_email']) && isset($_POST['friend_email']) && filter_var($_POST['friend_email'], FILTER_VALIDATE_EMAIL)) {

    $email = $_POST['friend_email'];
    $friend_id = $_POST['user_id'];

    $user = \App\Models\User::findByEmail($email);
    if ($user === false) {
        header('Location: /Friends/NoUser/');
        die;
    }
    $friend = new \App\Models\Friend();
    $friend->user_id = $user->id;
    $friend->friend_id = $friend_id;
    if (\App\Models\Friend::findByUserIdFriendId($user->id, $friend_id) === false) {
        $friend->save();
    }
    header('Location: /Friends/AddedFriend/' . $user->login);

}