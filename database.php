<?php
class Database{
  public $conn;
  public $host = "localhost";
  public $user = "root";
  public $pass = "";
  public $db   = "proyek_1";

  public function __construct(){
    $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
    if(!$this->conn){
      die($this->conn->error);
    }
  }

  public function login($table, $where){
    $sql = "SELECT * FROM $table WHERE $where";
    $query = $this->conn->query($sql);
    return $query->num_rows;
  }

  public function read($collums, $table, $where=null, $join=null){
    $sql = "SELECT $collums FROM $table";
    if($where != null){
      if($join != null){
        $sql .= " $join WHERE $where";
      }
      else{
        $sql .= " WHERE $where";
      }
    }else{
      $sql .= " $join";
    }
    $query = $this->conn->query($sql);
    return $query->fetch_all(MYSQLI_BOTH);
    //echo $sql;
  }
}
?>
