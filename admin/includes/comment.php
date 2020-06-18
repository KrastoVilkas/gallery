<?php

class Comment extends Db_object {

  protected static $db_table = "tbl_comments";
  protected static $db_table_fields = array("id","photo_id","author","body");
  public $id;
  public $photo_id;
  public $author;
  public $body;

  public static function create_comment($photo_id, $author, $body=""){

    if(!empty($photo_id) && !empty($body)){

        $comment = new Comment();
        $comment->photo_id = (int)$photo_id;
        if(!empty($author)){
          $comment->author = $author;
        } else {
          $comment->author = "Anonymous";
        }
        $comment->body = $body;

        return $comment;

    } else {

      return false;

    }
  }//End of create_comment() Method

  public static function find_comments($photo_id=0){

    global $DB;

    $sql = "SELECT * FROM " . self::$db_table;
    $sql .= " WHERE photo_id = " . $DB->escape_string($photo_id);
    $sql .= " ORDER BY photo_id ASC";

    return self::find_by_query($sql);

  }//End of find_comments() Method

































} //End of Class Comment

?>
