<?php

namespace App\Controllers;

use App\Core\LoginUser;
use App\Models\Friend;
use App\Models\User;


class Friends extends Controller
{
    public function actionFriends()
    {
        $this->view->user = LoginUser::check();

        $this->view->friends = Friend::findAllMyFriends($this->view->user->id);

        $this->view->display("friends.html");
    }

    public function actionAddedFriend($name)
    {
        $this->view->user = LoginUser::check();

        $this->view->friend = $name;

        $this->view->display("addedFriend.html");
    }

    public function actionNoUser()
    {
        $this->view->user = LoginUser::check();

        $this->view->display("noUser.html");
    }

    public function actionWordsFriends($friend_id, $current)
    {
        if (User::findById($friend_id) === false) {
            $message = 'Друг не найден!';
            header('Location: /Action/NotFound/' . $message);
            exit;
        }
        $this->view->friend_id = $friend_id;

        $this->view->friend_name = User::findById($friend_id)->login;

        $this->view->user = LoginUser::check();

        $this->pagination($current, 1, $friend_id);

        $method = __FUNCTION__;
        $method = substr($method, 6);
        $this->view->method = $method;


        $this->view->display("friend_words.html");

    }

    public function actionDeleteFriend($friend_id)
    {
        $this->view->user = LoginUser::check();
        if ($this->view->user != null) {
            Friend::deleteMyFriend($this->view->user->id, $friend_id);
            Friend::deleteMyFriend($friend_id, $this->view->user->id);
        }
        header('Location: /Friends/Friends');
    }

    public function actionConfirm($token)
    {
        $user = User::findByToken($token);
        if ($user != false) {
            $user->active = 1;
            $user->save();
        }

        header('Location: /');
        exit;
    }

    public function actionRestore($id, $message)
    {
        $this->view->message = urldecode($message);
        $this->view->id = $id;
        $this->view->display("newPassword.html");
    }

    public function actionSortDate($friend_id, $current = 1)
    {
        $this->view->user = User::findById($friend_id);
        if ($this->view->user == false) {
            header('Location: /Friends/Friends');
            exit;
        }
        $this->pagination($current, 2, $this->view->user->id);
        $method = __FUNCTION__;
        $method = substr($method, 6);
        $this->view->method = $method;
        $this->view->friend_id = $friend_id;

        $this->view->friend_name = User::findById($friend_id)->login;
        $this->view->display("friend_words.html");


    }

    public function actionSortAlphabetic($friend_id, $current = 1)
    {
        $this->view->user = User::findById($friend_id);
        if ($this->view->user == false) {
            header('Location: /Friends/Friends');
            exit;
        }
        $this->pagination($current, 3, $this->view->user->id);
        $method = __FUNCTION__;
        $method = substr($method, 6);
        $this->view->method = $method;
        $this->view->friend_id = $friend_id;

        $this->view->friend_name = User::findById($friend_id)->login;
        $this->view->display("friend_words.html");

    }

}