<?php

namespace App\Core;

use App\Models\User;

class ConfirmUser
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function sendConfirm()
    {
        $rand = rand();
        $this->user->token = $rand;
        $this->user->save();
        $to = "<" . $this->user->email . ">";
        $subject = 'Подтверждение регистрации';
        $message = '<p> Перейдите по ссылке для подтверждения регистрации</p> <a href="https://wordsenglish.ru/Friends/Confirm/' . $rand . '">Подтвердить регистрации на wordsenglish.ru</a>  </br>
            <p>Если Вы этого не делали, пожалуйста игнорируйте это письмо</p>';
        $headers = "Content-type: text/html; charset=utf-8 \r\n";
        $headers .= "From: cn17628@pingin.ru \r\n";
        $headers .= "Reply-To: cn17628@pingin.ru \r\n";
        mail($to, $subject, $message, $headers);
    }

    public function restore()
    {
        $to = "<" . $this->user->email . ">";
        $subject = 'Восстановление пароля';
        $message = '<p> Перейдите по ссылке для восстановления пароля</p> <a href="https://wordsenglish.ru/Friends/Restore/' . $this->user->id . '">Перейти для восстановления пароля на wordsenglish.ru</a></p></br>
                <p>Если Вы этого не делали, пожалуйста игнорируйте это письмо</p>';
        $headers = "Content-type: text/html; charset=utf-8 \r\n";
        $headers .= "From: cn17628@pingin.ru \r\n";
        $headers .= "Reply-To: cn17628@pingin.ru \r\n";
        mail($to, $subject, $message, $headers);
    }
}