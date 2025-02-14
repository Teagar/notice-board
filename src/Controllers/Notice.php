<?php
namespace App\Controllers;
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Models\Notice as Model;

class Notice {
  private $model;

  function __construct(){
    $this->model = new Model();
  }

  function create($title, $description, $link){
    $data = [
      "titulo" => $title,
      "description" => $description,
      "link" => $link
    ];

    $result = $this->model->insert($data);
    
    if ($result !== false) {
      header("Location: /");
    } else {
      header("Location: /v/notice/register.php");
    }
    exit;
  }

  function edit($title, $description, $link, $id){
    $data = [];

    if(!empty($title)) $data['title'] = $title; 
    if(!empty($description)) $data['description'] = $description; 
    if(!empty($link)) $data['link'] = $link; 

    $result = $this->model->update($data, $id);
    
    if ($result !== false) {
      header("Location: /");
    } else {
      header("Location: /v/notice/edit.php");
    }
    exit;
  }

  function select($where = null){
    return $this->model->select($where);
  }

  function delete($notice_id){
    $where = [
      ['id', $notice_id]
    ];
    
    return $this->model->delete($where);
  }

  function noticeExists(){
    $notice = $this->select();
    return is_array($notice) && count($notice)>0;
  }
}
