<?php

class Photo extends Db_object{

  protected static $db_table = "tbl_photos";
  protected static $db_table_fields = array("id","photo_title","photo_description","photo_type","photo_size", "photo_filename", "photo_alt_text", "photo_caption");
  public $id;
  public $photo_title;
  public $photo_caption;
  public $photo_description;
  public $photo_filename;
  public $photo_alt_text;
  public $photo_type;
  public $photo_size;

  public $tmp_path;
  public $upload_directory = "images";

  //This passed $_FILES['upload_file'] as an argument
  public function set_file($file){
      if(empty($file) || !$file || !is_array($file)){
      $this->errors[] = "There was no file uploaded here.";
      return false;

      } elseif($file['error'] !=0){
      $this->errors[] = $this->upload_errors_array[$file['error']];
      return false;

      } else{
      $this->photo_filename = basename($file['name']);
      $this->tmp_path = $file['tmp_name'];
      $this->photo_type = $file['type'];
      $this->photo_size = $file['size'];


      }
      $this->check_empty_props();

  }//End of set_file() Method

  public function check_empty_props(){
    if($this->photo_title === "" || empty($this->photo_title)){
      $this->photo_title = $this->photo_filename;
    }
    if($this->photo_description === "" || empty($this->photo_description)){
      $this->photo_description = "No description provided.";
    }
  }

  public function picture_path(){
    return $this->upload_directory.DS.$this->photo_filename;
  }

  public function save(){

    if($this->id){

      $this->update();

    }else{

      if(!empty($this->errors)){
        return false;

      }

      if(empty($this->photo_filename) || empty($this->tmp_path)){

        $this->error[] = "No file was available.";
        return false;
      }

      $target_path = SITE_ROOT.DS.'admin'.DS.$this->upload_directory.DS.$this->photo_filename;

      if(file_exists($target_path)){

        $this->errors[] = "The file {$this->photo_filename} already exists.";
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

    }

  } //End of save() Method

  public function delete_photo(){
    //if entry for file successfully deleted from database
    if($this->delete()){
      $target_path = IMAGES_PATH.DS.$this->photo_filename;
      //delete file, return success bool
      if(!unlink($target_path)){
        echo "Unable to unlink: " . $target_path;
      }

    } else {
      return false;
    }
  }//End of delete_photo Method

  public static function ajax_display_photo_data($photo_id){

    $photo = Photo::find_by_id($photo_id);
    $output  = "<a class='thumbnail' href='#'><img width ='100' src='{$photo->picture_path()}'</a>";
    $output .= "<p>{$photo->photo_filename}</p>";
    $output .= "<p>{$photo->photo_type}</p>";
    $output .= "<p>{$photo->photo_size}</p>";

    echo $output;


  }//End of ajax_display_photo_data() Method













}//End of Photo Class







 ?>
