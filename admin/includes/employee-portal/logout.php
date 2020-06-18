<?php require_once("includes/init.php") ?>

<?php require_once("includes/master.inc.php") ?>

<?php if(!$session->is_signed_in()){redirect('login.php');}?>

<?php
    $session->logout();
    redirect("login.php");
?>
