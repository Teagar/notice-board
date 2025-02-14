<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

  if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header("Location: /v/notices/register.php");
    exit;
  }

  if(empty($_POST['title']) || empty($_POST['description'])){
    header("Location: /v/notices/register.php");
    exit;
  }

  use App\Controllers\Notice;

  $Notice = new Notice();

  $Notice->create($_POST['title'], $_POST['description'], $_POST['link']);

  header("Location: /");
  exit;
