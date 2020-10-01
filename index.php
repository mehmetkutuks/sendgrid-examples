<?php
session_start();
date_default_timezone_set('Europe/Istanbul');
try {
  $db = new PDO('mysql:host=localhost;dbname=uyelik;charset=utf8', 'root', '');
} catch (\Exception $e) {
  die($e->getMessage());
}

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/classes/user.class.php';
require __DIR__ . '/helper.php';

$action = array_filter(explode("/", isset($_GET['action']) ? $_GET['action'] : ''));
if (!isset($action[0])) {
  $action[0] = 'index';
}
if (!file_exists('controller/' . strtolower($action[0] . '.php'))) {
  $action[0] = 'index';
}
require 'controller/'.$action[0].'.php';

 ?>
