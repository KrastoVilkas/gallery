<?php

require_once("new_config.php");

class Database {

  public $con;

  function __construct(){
    $this->open_db_connection();
  }

  public function open_db_connection(){
      $this->con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

      if($this->con->connect_errno){
        die("Database Connection failed: " . $this->con->connect_error);
      } else {
        //echo "true";
      }

  }


  //REQUIRED METHODS
  //SELECT
  //because this is a mysqli object, instead of mysqli_query($DB, $sql), we use $this->query($sql)
  public function executeSelectQuery($sql){
    $result = $this->con->query($sql);

    $this->confirm_query($result);

    return $result;
  }

  //INSERT/UPDATE/DELETE
  //because this is a mysqli object, instead of mysqli_query($DB, $sql), we use $this->query($sql)
  public function executeQuery($sql){
    $this->con->query($sql);
  }


  //HELPER get_class_methods

  //SQL SELECT validator
  private function confirm_query($result){
    if(!$result){
      die("Query Failed: " . $this->con->error);
    }

  }

  //escape user inputs to prevent SQL injection
  public function escape_string($string){
    $escaped_string = $this->con->real_escape_string($string);
    return $escaped_string;

  }

}

//Instantiate database object
$DB = new Database();


 ?>
