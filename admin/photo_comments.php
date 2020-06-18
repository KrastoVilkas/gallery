<?php require_once("includes/header.php"); ?>

<?php if(!$session->is_signed_in()){redirect('login.php');}?>

<?php

  if(empty($_GET['id'])){
    redirect("photos.php");
  }

  $comments = Comment::find_comments($_GET['id']);
  if($comment = $comments[0]){
    $photo = Photo::find_by_id($comment->photo_id);
  } else {
    redirect("photos.php");
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
                                      <?php echo $photo->photo_title; ?>
                                      <small>Comments</small>
                                  </h1>
                                  <div style='display: inline-block;'>
                                    <p class="btn-success"><?php echo $message; ?> </p>
                                  </div>
                                  <div class="col-md-12">
                                    <table class="table table-hover">
                                      <thead>
                                        <tr>
                                          <th>ID</th>
                                          <th>Author</th>
                                          <th>Body</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          foreach ($comments as $comment) : ?>
                                            <tr>
                                              <td><?php echo $comment->id; ?></td>
                                              <td><?php echo $comment->author; ?>
                                              <div class="action-links">
                                                <a href="delete_photo_comment.php?id=<?php echo $comment->id; ?>">Delete</a>
                                              </div>
                                          </td>
                                              <td><?php echo $comment->body; ?></td>
                                            </tr>


                                        <?php endforeach; ?>

                                      </tbody>
                                    </table>

                                  </div>
                              </div>
                          </div>
                          <!-- /.row -->

                      </div>
                      <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>
