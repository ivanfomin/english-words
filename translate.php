<?php
require_once __DIR__ . '/vendor/autoload.php';

use Stichoza\GoogleTranslate\GoogleTranslate;

$tr = new GoogleTranslate('en'); // Translates into Russian
$tr->setTarget('ru');
if (isset($_POST['en']) && !empty($_POST['en'])) {
    $en = $_POST['en'];
    try {
        $word = $tr->translate($en);
    } catch (ErrorException $e) {
    }
    echo $word;
}
