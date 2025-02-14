<?php
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

date_default_timezone_set('America/Bahia');
session_start();
