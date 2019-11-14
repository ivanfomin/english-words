<?php

require_once __DIR__ . '/vendor/autoload.php';

use Stichoza\GoogleTranslate\GoogleTranslate;

$tr = new GoogleTranslate('ru'); // Translates into English
$tr->setTarget('en');
if (isset($_POST['ru']) && !empty($_POST['ru'])) {
    $ru = $_POST['ru'];
    try {
        $word = $tr->translate($ru);
    } catch (ErrorException $e) {
    }
    echo $word;
}
