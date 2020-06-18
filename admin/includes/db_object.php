<?php

class Db_object {
  public $errors = array();
  public $upload_errors_array = array(
    UPLOAD_ERR_OK             =>  "There is no error.",
    UPLOAD_ERR_INI_SIZE       =>  "The uploaded file exceeds the upload_max_filesize directive in php.ini.",
    UPLOAD_ERR_FORM_SIZE      =>  "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.",
    UPLOAD_ERR_PARTIAL        =>  "The uploaded file was only partially uploaded.",
    UPLOAD_ERR_NO_FILE        =>  "No file was uploaded.",
    UPLOAD_ERR_NO_TMP_DIR     =>  "Missing a temporary folder.",
    UPLOAD_ERR_CANT_WRITE     =>  "Failed to write file to disk.",
    UPLOAD_ERR_EXTENSION      =>  "A PHP extension stopped the file upload."
  );

  protected function properties(){
    //photo filename not making it here
    $properties = array();
    foreach (static::$db_table_fields as $db_field) {
      if(property_exists($this, $db_field)){
          $properties[$db_field]= $this->$db_field;
      }
    }
    return $properties;
  }

  protected function clean_properties(){
    global $DB;
    $clean_properties=array();

    foreach($this->properties()as $key => $value){
      $clean_properties[$key] = $DB->escape_string($value);
    }

    return $clean_properties;
  }

  public static function find_all(){
    return static::find_by_query("SELECT * FROM " . static::$db_table . " ");
  }

  public static function find_by_id($lookup_id){
    global $DB;
    $result_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE id  = $lookup_id LIMIT 1");

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

  public static function find_by_query($sql){
    global $DB;
    $result_set = $DB->query($sql);

    $the_object_array = [];
    while($row = mysqli_fetch_array($result_set)){
      $the_object_array[] = static::instantiation($row);
    }
    return $the_object_array;
  } //End of find_this_query Method

  public static function instantiation($the_record){
    $called_class = get_called_class();
    $the_object = new $called_class;

    foreach ($the_record as $the_attribute => $value) {
      if($the_object->has_the_attribute($the_attribute)){
        $the_object->$the_attribute = $value;
        // echo "The attribute: " . $the_attribute;
        // echo ":     The value: " . $value . "<br />";
      }
    }

    return $the_object;

  }//End of instantiation Method

  private function has_the_attribute($the_attribute){
    //returns array of all object vars
    $object_properties = get_object_vars($this);
    //returns true if arg1 in arg2
    return array_key_exists($the_attribute, $object_properties);

  }//End of has_the_attribute Method

  public function save(){
    //if this user's id property is set, then update this objects assoiciated row in tbl_users
    //otherwise, create a new user
    return isset($this->id) ? $this->update() : $this->create();
  }

  public function create(){
    global $DB;
    $properties = $this->clean_properties();

    $sql = "INSERT INTO " . static::$db_table . " (" . implode(",", array_keys($properties)) .  ")";
    $sql .= "VALUES('" . implode("','", array_values($properties)) ."')";

    if($DB->query($sql)){

      $this->id = $DB->insert_id();

      return true;
    }else{
      return false;
    }
  }//End of Create Method

  public function update(){
    global $DB;
    $properties = $this->properties();
    $property_pairs = array();
    foreach ($properties as $key => $value) {
      $property_pairs[] = "{$key}='{$value}'";
    }
    $sql = "UPDATE " . static::$db_table . " SET ";
    $sql .= implode(", ", $property_pairs);
    $sql .= " WHERE id= " . $DB->escape_string($this->id);

    $DB->query($sql);

    //check to make sure that database was effected
    return (mysqli_affected_rows($DB->con) == 1) ? true : false;

  }//End of Update Method

  public function delete(){
    global $DB;
    $sql = "DELETE FROM  " . static::$db_table . " ";
    $sql .= "WHERE id= " . $DB->escape_string($this->id);
    $sql .= " LIMIT 1";

    $DB->query($sql);

    //check to make sure that database was effected
    return (mysqli_affected_rows($DB->con) == 1) ? true : false;
  }//End of Delete Method

  public static function count_all(){
    global $DB;

    $sql = "SELECT COUNT(*) FROM " . static::$db_table;
    $result_set = $DB->query($sql);
    $row = mysqli_fetch_array($result_set);

    return array_shift($row);
  }








}//End of Db_object Class



 ?>
