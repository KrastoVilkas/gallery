<?php require_once("includes/header.php"); ?>

<?php if(!$session->is_signed_in()){redirect('login.php');}?>

<?php

  if(empty($_GET['id'])){
    redirect("users.php");
  }

  $user = User::find_by_id($_GET['id']);

  if($user){
    $session->message($user->username . " was deleted.");
    $user->delete_user();
    redirect("users.php");
  } else {
    $session->message("ERROR: user not deleted.");
    redirect("users.php");
  }























?>
