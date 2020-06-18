<?php require_once("includes/header.php"); ?>

<?php if(!$session->is_signed_in()){redirect('login.php');}?>

<?php
    if(isset($_POST['add-user'])){
      $user = new User();

      if($user){
        $user->user_fName=$_POST['input-fName'];
        $user->user_lName=$_POST['input-lName'];
        $user->username=$_POST['input-username'];
        $user->user_password= $_POST['input-password'];

        $user->set_file($_FILES['input-image']);

        $user->save_user_and_image();
        redirect("users.php");

        $session->message($user->username . " was added.");
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
                                      Users
                                      <small> | Add User</small>
                                  </h1>
                                  <div class="col-md-6 col-md-offset-3">
                                    <form action="" method="post" enctype="multipart/form-data">
                                      <div class="form-group">
                                        <label for="input-image">User Image</label>
                                        <input type="file" name="input-image" class="form-control">
                                      </div>
                                      <div class="form-group">
                                        <label for="input-username">Username</label>
                                        <input type="text" name="input-username" class="form-control">
                                      </div>
                                      <div class="form-group">
                                        <label for="input-fName">First Name</label>
                                        <input type="text" name="input-fName"  class="form-control">
                                      </div>
                                      <div class="form-group">
                                        <label for="input-lName">Last Name</label>
                                        <input type="text" name="input-lName"  class="form-control">
                                      </div>
                                      <div class="form-group">
                                        <label for="input-password">Password</label>
                                        <input type="password" name="input-password"  class="form-control">
                                      </div>
                                      <input type="submit" name="add-user" value="Add User" class="pull-right btn btn-primary btn-lg ">

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
