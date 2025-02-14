<?php

namespace App\Models;
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}

use App\Models\Connection;

class Usuario {
  function insert($login, $password){
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    return Connection::executeSQL("INSERT INTO users (`login`, password) VALUES (?,?)", $login, $password);
  }

  function update($data){
    if(isset($data['password'])){
      $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    }

    $data = Connection::prepareToUpdate($data);
    $set_sql = $data['set_sql'];
    $values = $data['values'];
    
    $values[] = $_SESSION['id'];
    
    return Connection::executeSQL("UPDATE users SET $set_sql WHERE id = ?", ...$values);
  }
  
  function select($where = null){
    $SQL = "SELECT * FROM users ";
    
    $res_where = Connection::prepareToWhere($where);
    $where  = $res_where['where'];
    $values = $res_where['values'];
    
    $SQL .= $where;

    return Connection::executeSQL($SQL, ...$values);
  }
}
