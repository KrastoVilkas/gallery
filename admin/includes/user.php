<?php

class User extends Db_object {

  protected static $db_table = "tbl_users";
  protected static $db_table_fields = array("username","user_password","user_fName","user_lName", "user_image");
  public $id;
  public $username;
  public $user_password;
  public $user_fName;
  public $user_lName;
  public $user_image;
  public $tmp_path;
  public $image_placeholder = "http://placehold.it/400x400&text=image";
  public $upload_directory="images";

  //This passed $_FILES['upload_file'] as an argument
  public function set_file($file){
      if(empty($file) || !$file || !is_array($file)){
      $this->errors[] = "There was no file uploaded here.";
      return false;

      } elseif($file['error'] !=0){
      $this->errors[] = $this->upload_errors_array[$file['error']];
      return false;

      } else{
      $this->user_image = basename($file['name']);
      $this->tmp_path = $file['tmp_name'];
      $this->photo_type = $file['type'];
      $this->photo_size = $file['size'];


      }
  }//End of set_file() Method

  public function save_user_and_image(){


      if(!empty($this->errors)){
        return false;

      }

      if(empty($this->user_image) || empty($this->tmp_path)){

        $this->error[] = "No file was available.";
        return false;
      }

      $target_path = SITE_ROOT.DS.'admin'.DS.$this->upload_directory.DS.$this->user_image;

      if(file_exists($target_path)){

        $this->errors[] = "The file {$this->user_image} already exists.";
        return false;

      }

      if(move_uploaded_file($this->tmp_path, $target_path)){

        if($this->create()){

          unset($this->tmp_path);
          return true;

        }

      } else {

        $this->errors[] = "May not have permission to access file directory. <br />If this error persists, contact your administrator.";

      }
  } //End of  save_user_and_image() Method

  public static function verify_user($username, $password){
    global $DB;

    //scrub user input to prevent SQL injection
    $username = $DB->escape_string($username);
    $password = $DB->escape_string($password);

    //generate SQL query string, call find_by_query() an assign value to $rfeult_array
    $sql = "SELECT * FROM " . self::$db_table . " WHERE ";
    $sql .= "username = '{$username}' ";
    $sql .= "AND user_password = '{$password}' ";
    $sql .= "LIMIT 1";
    $result_array = self::find_by_query($sql);
    //if result_array isn't empty, return the first row, otherwise return false
    return !empty($result_array) ? array_shift($result_array) : false;

  }//End of vefify_user Method

  public function image_path_and_placeholder(){
    return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
  }

  public function delete_user(){
    $target_path = IMAGES_PATH.DS.$this->user_image;
    //if entry for user successfully deleted from database
    if($this->delete()){
      //delete user_image, return success bool
      if(!unlink($target_path)){
        echo "Unable to unlink: " . $target_path;
      }

    } else {
      return false;
    }
  }//End of delete_user() Method

  public function ajax_change_user_image($user_image, $user_id){

    $this->user_image = $user_image;
    $this->user_id = $user_id;
    $this->update();

    echo $this->image_path_and_placeholder();
  }

} //End of Class User

?>
