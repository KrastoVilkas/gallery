<?php

class User{

  public $user_id;
  public $user_password;
  public $user_fname;
  public $user_lname;
  public $user_email;
  public $user_addr;
  public $user_phone;
  public $user_salary;
  public $user_SSN;

  private static $userCount;

  public static function find_all_users(){
    return self::find_this_query("SELECT * FROM tbl_users");
  }

  public static function find_user_by_id($lookup_id){
    global $DB;
    $result_array = self::find_this_query("SELECT * FROM tbl_users WHERE user_id = $lookup_id LIMIT 1");

    //make sure that array isn't empty
    // if(!empty($result_array)){
    //   $first_item = array_shift($result_array);
    //   return $first_item;
    // } else {
    //   return false;
    // }
    //same as the above
    return !empty($result_array) ? array_shift($result_array) : false;
  }

  public static function find_this_query($sql){
    global $DB;
    $result_set = $DB->executeSelectQuery($sql);

    $the_object_array = [];
    while($row = mysqli_fetch_array($result_set)){
      $the_object_array[] = self::instantiation($row);
    }
    return $the_object_array;
  }

  public static function verify_user($input_email, $input_password){
    global $DB;
    //scrub user input to prevent SQL injection
    $input_email = $DB->escape_string($input_email);
    $input_password = $DB->escape_string($input_password);
    $sql = "SELECT user_password FROM tbl_users WHERE user_email = '{$input_email}' LIMIT 1";
    $result = $DB->executeSelectQuery($sql);

    if($result){
      $hash = $result->fetch_object()->user_password;
      $correct_password = password_verify($input_password, $hash);

      if($correct_password){
          //echo "Password verified";
          $sql = "SELECT * FROM tbl_users WHERE ";
          $sql .= "user_email = '{$input_email}' ";
          $sql .= "LIMIT 1";
          $result_array = self::find_this_query($sql);
          return array_shift($result_array);
      }else {
        return false;
      }
    }
      //might have to chekc and make sure that hashed pw from $DB is in single quotes vs double

  }

  public static function instantiation($the_record){
    $the_object = new self;

    foreach ($the_record as $the_attribute => $value) {
      if($the_object->has_the_attribute($the_attribute)){
        $the_object->$the_attribute = $value;
      }
      
    }

    return $the_object;
  }

  private function has_the_attribute($the_attribute){
    //returns array of all object vars
    $object_properties = get_object_vars($this);

    //returns true if arg1 in arg2
    return array_key_exists($the_attribute, $object_properties);
  }
}

?>
