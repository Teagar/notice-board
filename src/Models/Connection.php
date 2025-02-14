<?php
namespace App\Models;

use Exception;
use PDOException;
use PDO;

class Connection {
  const DB_HOST = 'localhost';
  const DB_USER = 'root';
  const DB_PASS = '2005';
  const DB_NAME = 'noticeboard';

  private static function connect(){
    return new PDO("mysql:host=".self::DB_HOST.";dbname=".self::DB_NAME . ";charset=utf8mb4", self::DB_USER, self::DB_PASS);
  }

  public static function executeSQL($SQL, ...$values){
    $SQL = trim($SQL);
    
    $pdo = self::connect();
    $stmt = $pdo->prepare($SQL);

    
    if(is_array($values) && !empty($values)){
      foreach($values as $k => $v){
        $stmt->bindParam(($k+1), $values[$k]);
      }
    }
    
    try{
      $result = $stmt->execute();
    } catch(PDOException $e){
      echo $e->getMessage();
      return false;
    }
    
    $command = explode(' ', $SQL)[0];

    try{
      return self::returnsFormat($command, $pdo, $result, $stmt);
    } catch (Exception $e) {
      echo $e->getMessage() . "<br>";
      echo $SQL;
    }
  }

  private static function returnsFormat($command, $pdo, $result, $stmt){
    try {
      switch(strtolower($command)){
        case 'select':
          return $stmt->fetchAll(\PDO::FETCH_ASSOC);
          break;
        case 'insert':
          return $pdo->lastInsertId();
          break;
        case 'update':
        case 'delete':
          return $stmt->rowCount();
          break;
        default:
          return [$result, $stmt];
      }
    }catch(Exception $e){
      echo $e->getMessage();
    }
  }

  static function prepareToInsert($data){
    $columns = array_keys($data);
    $values  = array_values($data);
    
    $placeholder_values  = array_map(function ($v){
      return '?';
    }, $values);

    $columns_sql = "`" . implode("`, `", $columns) . "`";
    $values_sql  = implode(", ", $placeholder_values);

    return [
      'columns_sql' => $columns_sql,
      'values_sql' => $values_sql,
      'values' => $values
    ];
  }

  static function prepareToUpdate($data){
    $set    = [];
    $values = [];

    foreach($data as $k => $v){
      $set[] = "$k=?";
      $values[] = $v;
    }

    return [
      'set_sql' => implode(', ', $set),
      'values'  => $values
    ];
  }

  static function prepareToWhere($where){
    if(!is_array($where) || (count($where) <= 0) || (empty($where))) return ['where'=>'', 'values'=> []];

    $where_arr = [];
    $values    = [];

    foreach($where as $k => $v){
      if(is_array($v)){
        $where_arr[] = "{$v[0]} = ?";
        $values[]    = $v[1];
      } else $where_arr[] = $v;
    }

    $where = implode(" AND ", $where_arr);

    return [
      "where"  => " WHERE " . $where,
      "values" => $values
    ];
  }
}
