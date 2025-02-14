<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

  if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header("Location: /v/notices/edit.php");
    exit;
  }

  if(empty($_POST['title']) || empty($_POST['description'])){
    header("Location: /v/notices/edit.php");
    exit;
  }

  use App\Controllers\Notice;

  $Notice = new Notice();

  $Notice->edit($_POST['title'], $_POST['description'], $_POST['link'], $_POST['notice']);

  header("Location: /");
  exit;
