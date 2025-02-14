<?php
require_once $_SERVER['DOCUMENT_ROOT']. "/vendor/autoload.php";

if(empty($_GET['notice'])){
  header("Location: /");
  exit;
}

use App\Controllers\Notice;

$Notice = new Notice();

$Notice->delete($_GET['notice']);

header("Location: /");
