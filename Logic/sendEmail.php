<?php

if (isset($_POST['header']) && isset($_POST['content']) && isset($_POST['email'])) {

    $to = "<cn17628@pingin.ru> ";

    $subject = $_POST['header'];

    $message = '<p>' . $_POST['content'] . '</p>  </br>';

    $headers = "Content-type: text/html; charset=utf-8 \r\n";
    $headers .= "From: " . $_POST['email'] . "\r\n";
    $headers .= "Reply-To: " . $_POST['email'] . "\r\n";

    mail($to, $subject, $message, $headers);


}

header('Location: /');
