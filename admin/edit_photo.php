<?php require_once("includes/header.php"); ?>

<?php if(!$session->is_signed_in()){redirect('login.php');}?>

<?php

  if(empty($_GET['id'])){
    redirect("photos.php");
  } else {
    $photo = Photo::find_by_id($_GET['id']);
    global $DB;

    if(isset($_POST['update'])){

      $photo->photo_title=$DB->escape_string($_POST['input-title']);
      $photo->photo_caption=$DB->escape_string($_POST['input-caption']);
      $photo->photo_alt_text=$DB->escape_string($_POST['input-alt']);
      $photo->photo_description= $DB->escape_string($_POST['input-description']);
      $photo->save();
      $photo->photo_title= stripcslashes($photo->photo_title);
      $photo->photo_caption=stripcslashes($photo->photo_caption);
      $photo->photo_alt_text=stripcslashes($photo->photo_alt_text);
      $photo->photo_description= stripcslashes($photo->photo_description);

      $session->message($photo->photo_filename . " was updated.");

      redirect("photos.php");
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
                              <div class="col-lg-8">
                                  <h1 class="page-header">
                                      Admin
                                      <small>Edit Photo</small>
                                  </h1>
                                  <div class="col-md-12">

                                    <form action="" method="post">
                                      <div class="form-group">
                                        <input type="text" name="input-title" class="form-control" value="<?php echo $photo->photo_title; ?>">
                                      </div>
                                      <div class="form-group">
                                        <a class="thumbnail" href="#"><img src="<?php echo $photo->picture_path(); ?>"/></a>
                                      </div>
                                      <div class="form-group">
                                        <label for="">Caption</label>
                                        <input type="text" name="input-caption"  class="form-control" value="<?php echo $photo->photo_caption; ?>">
                                      </div>
                                      <div class="form-group">
                                        <label for="">Alternate Text</label>
                                        <input type="text" name="input-alt"  class="form-control" value="<?php echo $photo->photo_alt_text; ?>">
                                      </div>
                                      <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="input-description" class="form-control" id="description" cols="30" rows="10"><?php echo $photo->photo_description; ?></textarea>
                                      </div>


                                  </div>
                              </div>
                              <div class="col-md-4" >
                              <div  class="photo-info-box">
                                  <div class="info-box-header">
                                     <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                                  </div>
                                  <div class="inside">
                                    <div class="box-inner">
                                       <p class="text">
                                         <span class="glyphicon glyphicon-calendar"></span> Uploaded on: April 22, 2030 @ 5:26
                                        </p>
                                        <p class="text ">
                                          Photo Id: <span class="data photo_id_box"> <?php echo $photo->id; ?></span>
                                        </p>
                                        <p class="text">
                                          Filename: <span class="data"> <?php echo $photo->photo_filename; ?></span>
                                        </p>
                                       <p class="text">
                                        File Type: <span class="data"> <?php echo $photo->photo_type; ?></span>
                                       </p>
                                       <p class="text">
                                         File Size: <span class="data"> <?php echo $photo->photo_size; ?></span>
                                       </p>
                                    </div>
                                    <div class="info-box-footer clearfix">
                                      <div class="info-box-delete pull-left">
                                          <a  href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg ">Delete</a>
                                      </div>
                                      <div class="info-box-update pull-right ">
                                          <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                      </div>
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
