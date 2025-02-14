<?php
namespace App\Controllers;
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Models\User as Model;

class User {
  private $model = null;

  function __construct()
  {
    $this->model = new Model();
  }


  function create($login, $password){
    $result = $this->model->insert($login, $password);
    
    if ($result !== false) {
      header("Location: /v/users/login.php");
    } else {
      header("Location: /v/users/register.php");
    }
    exit;
  }

  function edit($login, $password){
    $data = [
      'login' => $login
    ];

    if(!empty($password)) {
      $data['password'] = $password;
    }

    $result = $this->model->update($data);
    
    if ($result !== false) {
      header("Location: /");
    } else {
      header("Location: /v/users/edit.php");
    }
    exit;
  }

  function select($where = null){
    return $this->model->select($where);
  }

  function login($login, $password){
    $where = [
      ["login", $login]
    ];

    $user = $this->model->select($where);
    if((bool)$user){
      $user = $user[0];
      if(password_verify($password, $user['password'])){
        $_SESSION['id'] = $user['id'];
      }
    }
    header("Location: /");
  }
}
