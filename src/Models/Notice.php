<?php

namespace App\Models;
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Models\Connection;

class Notice {
  function insert($data){
    $data = Connection::prepareToInsert($data);
    
    $columns             = $data['columns_sql'];
    $placeholder_values  = $data['values_sql'];
    $values              = $data['values'];
    
    return Connection::executeSQL("INSERT INTO notices ($columns) VALUES ($placeholder_values)", ...$values);
  }
  
  function update($data, $id_registro){
    $data = Connection::prepareToUpdate($data);
    $set_sql = $data['set_sql'];
    $values = $data['values'];
    
    $values[] = $id_registro;

    return Connection::executeSQL("UPDATE notices SET $set_sql WHERE id = ?", ...$values);
  }
  
  function select($where = null){
    $SQL = "SELECT * FROM notices ";
    
    $res_where = Connection::prepareToWhere($where);
    $where  = $res_where['where'];
    $values = $res_where['values'];
    
    $SQL .= $where;

    return Connection::executeSQL($SQL, ...$values);
  }

  function delete($where) {
    if(empty($where)) return false;
    
    $SQL = "DELETE FROM notices ";
    
    $res_where = Connection::prepareToWhere($where);
    $where  = $res_where['where'];
    $values = $res_where['values'];
    
    $SQL .= $where;

    return Connection::executeSQL($SQL, ...$values);
  }
}
