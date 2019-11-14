<?php
require_once __DIR__ . '/../vendor/autoload.php';

if (isset($_POST['en']) && !empty($_POST['en']) && isset($_POST['ru']) && !empty($_POST['ru'])) {

    $en = (trim($_POST['en']));
    $ru = (trim($_POST['ru']));
    $user_id = $_POST['user_id'];

    $word = \App\Models\Word::findByWord($en);

    if ($word === false) {
        $paste = new \App\Models\Word();
        $paste->en = $en;
        $paste->ru = $ru;
        $paste->save();
        $word = $paste;
    }

    if (\App\Models\UserWord::findByUserIdWordId($user_id, $word->id) === false) {
        $userWord = new \App\Models\UserWord();
        $userWord->user_id = $user_id;
        $userWord->word_id = $word->id;
        $userWord->save();
    }

}
header('Location: /');