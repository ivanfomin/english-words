<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\User;
use App\Models\Word;


abstract class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    protected function pagination($current = 1, $param = 1, $user_id = null)
    {
        if ($current <= 1 && empty($current)) {
            $current = 1;
        }
        if ($user_id !== null) {
            $this->view->count = Word::countWords($user_id);
            $this->view->current = $current;
            $num = 10;
            $this->view->pages = ceil($this->view->count / $num);
            if (empty($this->view->count) && $this->view->count < 0) {
                $current = 1;
            }
            $start = $current * $num - $num;
            switch ($param) {
                case 1:
                    $this->view->words = Word::findPageByUserId($user_id, $start, $num);
                    break;
                case 2:
                    $this->view->words = Word::findPageByDate($user_id, $start, $num);
                    break;
                case 3:
                    $this->view->words = Word::findPageByAlphabetic($user_id, $start, $num);
                    break;
            }
            $this->view->login = User::findById($user_id)->login;
            $this->view->users = User::countActiveUsers();
        }
    }
}