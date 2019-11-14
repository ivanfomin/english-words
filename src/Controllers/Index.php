<?php

namespace App\Controllers;

use App\Core\LoginUser;
use App\Models\UserWord;


class Index extends Controller
{
    public function actionDefault()
    {
        $this->actionPage(1);
    }

    public function actionEnter($message)
    {
        $this->view->user = LoginUser::check();
        if ($this->view->user != null) {
            $this->actionDefault();
        } else {
            $this->view->message = urldecode($message);
            $this->view->display('enter.html');
        }

    }

    public function actionPage($current = 1)
    {
        $this->view->user = LoginUser::check();
        if ($this->view->user != null) {
            $this->pagination($current, 1, $this->view->user->id);
        }
        $method = __FUNCTION__;
        $method = substr($method, 6);
        $this->view->method = $method;
        $this->view->display('index.html');

    }

    public function actionSortDate($current = 1)
    {
        $this->view->user = LoginUser::check();

        $this->pagination($current, 2, $this->view->user->id);
        $method = __FUNCTION__;
        $method = substr($method, 6);
        $this->view->method = $method;
        $this->view->display('index.html');

    }

    public function actionSortAlphabetic($current = 1)
    {
        $this->view->user = LoginUser::check();

        $this->pagination($current, 3, $this->view->user->id);
        $method = __FUNCTION__;
        $method = substr($method, 6);
        $this->view->method = $method;
        $this->view->display('index.html');

    }

    public function actionDeleteWord($word_id)
    {
        $this->view->user = LoginUser::check();
        UserWord::deleteByUserIdWordId($this->view->user->id, $word_id);
        header('Location: /');
    }
}