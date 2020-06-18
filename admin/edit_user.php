<?php require_once("includes/header.php"); ?>
<?php require_once("includes/photo_library_modal.php"); ?>

<?php if(!$session->is_signed_in()){redirect('login.php');}?>

<?php

    if(empty($_GET['id'])){

      redirect("users.php");

    }

    $user = User::find_by_id($_GET['id']);


    if(isset($_POST['update'])){

      if($user){
        $user->user_fName=$_POST['input-fName'];
        $user->user_lName=$_POST['input-lName'];
        $user->username=$_POST['input-username'];
        $user->user_password= $_POST['input-password'];

        if(empty($_FILES)){
          $user->save();
          redirect("users.php");
          $session->message("User: " . $user->username . " has been updated.");
        } else {
          $user->set_file($_FILES['input-image']);
          $user->save_user_and_image();
          $user->save();
          $session->message("User " . $user->username . " has been updated.");

          redirect("users.php");
        }
      }
    }
 ?>




        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->


            <?php include("includes/top_nav.php") ?>


            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->


            <?php include("includes/side_nav.php") ?>


            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

                      <div class="container-fluid">

                          <!-- Page Heading -->
                          <div class="row">
                              <div class="col-lg-12">
                                  <h1 class="page-header">
                                      Edit User
                                      <small> | Id - <?php echo $user->id . ": " . $user->username ?></small>
                                  </h1>
                                  <div class="col-md-6 user_image_box">
                                    <a href="#" data-toggle="modal" data-target="#photo-library"><img class="img-responsive" src="<?php echo $user->image_path_and_placeholder(); ?>" alt=""></a>
                                  </div>
                                  <div class="col-md-6">
                                    <form action="" method="post" enctype="multipart/form-data">
                                      <div class="form-group">
                                        <label for="input-image">User Image</label>
                                        <input type="file" name="input-image" class="form-control">
                                      </div>
                                      <div class="form-group">
                                        <label for="input-username">Username</label>
                                        <input type="text" name="input-username" class="form-control" value="<?php echo $user->username ?>">
                                      </div>
                                      <div class="form-group">
                                        <label for="input-fName">First Name</label>
                                        <input type="text" name="input-fName"  class="form-control" value="<?php echo $user->user_fName ?>">
                                      </div>
                                      <div class="form-group">
                                        <label for="input-lName">Last Name</label>
                                        <input type="text" name="input-lName"  class="form-control" value="<?php echo $user->user_lName ?>">
                                      </div>
                                      <div class="form-group">
                                        <label for="input-password">Password</label>
                                        <input type="password" name="input-password"  class="form-control" value="<?php echo $user->user_password ?>">
                                      </div><div class="info-box-footer clearfix">
                                        <div class="info-box-delete pull-left">
                                            <a id="user-id" href="delete_user.php?id=<?php echo $user->id; ?>" class="btn btn-danger btn-lg ">Delete <?php echo $user->username ?></a>
                                        </div>
                                        <div class="info-box-update pull-right ">
                                            <input type="submit" name="update" value="Update <?php echo $user->username; ?>" class="btn btn-primary btn-lg ">
                                        </div>
                                      </div>
                                  </div>
                                  </div>
                            </form>
                          </div>
                          <!-- /.row -->

                      </div>
                      <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>
