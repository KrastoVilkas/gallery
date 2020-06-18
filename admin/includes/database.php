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
      }

  }//End of open_db_connect Method

  public function query($sql){
    $result = $this->con->query($sql);

    $this->confirm_query($result);

    return $result;
  }//End of query Method

  private function confirm_query($result){
    if(!$result){
      die("Query Failed: " . $this->con->error);
    }

  }//End of confirm_query Method

  public function escape_string($string){
    $escaped_string = $this->con->real_escape_string($string);
    return $escaped_string;

  }//End of escape_string Method

  public function insert_id(){
    return $this->con->insert_id;
  } //End of insert_id Method

} //End of Databse Class



//Instantiate DB
$DB = new Database();


 ?>
