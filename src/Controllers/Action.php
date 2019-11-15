<?php

namespace App\Controllers;

use App\Core\LoginUser;

class Action extends Controller
{
    public function actionLogout()
    {
        LoginUser::logout();
        header('Location: /');
        exit;
    }

    public function actionSendFeedBack()
    {
        $this->view->user = LoginUser::check();
        if ($this->view->user == false) {
            $this->view->message = 'Необходимо зарегестрироваться!';
            $this->view->display('index.html');
        } else {
            $this->view->display('sendFeedBack.html');
        }
    }

    public function actionRestore()
    {
        $this->view->display('restore.html');
    }

    public function actionRegister($message)
    {
        $this->view->message = urldecode($message);
        $this->view->display('register.html');
    }

    public function actionConfirm()
    {
        $this->view->display('confirm.html');
    }

    public function actionNotFound($message)
    {
        $this->view->message = urldecode($message);
        $this->view->display('404.html');
    }
}