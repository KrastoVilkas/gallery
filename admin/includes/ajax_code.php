<?php require_once("init.php") ?>

<?php


if (isset($_POST['image_name']) && isset($_POST['user_id'])) {

    $user = User::find_by_id($_POST['user_id']);
    $user->ajax_change_user_image($_POST['image_name'], $_POST['user_id']);
}

if (isset($_POST['photo_id'])){

    Photo::ajax_display_photo_data($_POST['photo_id']);
}
















 ?>
