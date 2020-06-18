<?php require_once("includes/header.php"); ?>

<?php if(!$session->is_signed_in()){redirect('login.php');}?>

<?php

  if(empty($_GET['id'])){
    redirect("comments.php");
  }

  $comment = Comment::find_by_id($_GET['id']);

  if($comment){
    $session->message("Comment ID: " . $comment->comment_id . " was deleted.");
    $comment->delete();
    redirect("comments.php");
  } else {
    $session->message("ERROR: " . $comment->comment_id . " was NOT deleted.");
    redirect("comments.php");
  }























?>
