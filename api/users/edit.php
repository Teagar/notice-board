<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

if($_SERVER['REQUEST_METHOD'] !== 'POST' || (empty($_POST['login']) || empty($_POST['password']))){
  header("Location: /v/users/edit.php");
}

use App\Controllers\User;

$user = new User();

$user->edit($_POST['login'], $_POST['password']);
