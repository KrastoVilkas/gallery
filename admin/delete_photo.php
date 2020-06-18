<?php require_once("includes/header.php"); ?>

<?php if(!$session->is_signed_in()){redirect('login.php');}?>

<?php

  if(empty($_GET['id'])){
    redirect("photos.php");
  }

  $photo = Photo::find_by_id($_GET['id']);

  if($photo){
    $session->message($photo->photo_filename . " was deleted.");
    $photo->delete_photo();
    redirect("photos.php");
  } else {
    $session->message("ERROR: " . $photo->photo_filename . " was not deleted.");
    redirect("photos.php");
  }
























?>
