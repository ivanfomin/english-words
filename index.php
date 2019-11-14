<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . '/vendor/autoload.php';

$parts = explode('/', $_SERVER['REQUEST_URI']);

$ctrlRequest = !empty($parts[1]) ? $parts[1] : 'Index';

$ctrlClassName = '\App\Controllers\\' . $ctrlRequest;

$ctrl = new $ctrlClassName;

$actRequest = !empty($parts[2]) ? $parts[2] : 'Default';

$param1 = !empty($parts[3]) ? $parts[3] : '';

$param2 = !empty($parts[4]) ? $parts[4] : '';

$act = 'action' . $actRequest;

$ctrl->$act($param1, $param2);


