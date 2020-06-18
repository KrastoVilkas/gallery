<?php require_once("includes/init.php") ?>

<?php require_once ('includes/master.inc.php') ?>

<?php

if($session->is_signed_in()){
  redirect("index.php");
}

if(isset($_POST['submit'])){
  $username = trim($_POST['inputEmail']);
  $password = trim($_POST['inputPassword']);

    //Method to check database for user, returns User object or false
    $user_found = User::verify_user($username, $password);

    if($user_found){
      $session->login($user_found);
      //echo "test";
      redirect("index.php");
    } else {
      $message = "Incorrect password and/or email.<br>The cake is a lie.";
    }
} else {
  $message = "";
  $username = "";
  $password = "";
}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="device-width, initial-scale=1">
    <title>Employee Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>

    <div class="container text-center" style="padding-top: 5%;">
      <form class="form-signin" action="" method="post">


      <img class="mb-4" src="images/200px-Portal_Cake.png" alt="Chocolate cake" title="A lie" width="100" height="100">
      <h1 class="h3 mb-3 font-weight-normal">Sign in to receive Cake</h1>
      <div>
      <h4 class="bg-danger">
        <?php
          echo $message;
        ?>
      </h4>
    </div>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email"
             name="inputEmail"
             id="inputEmail"
             class="form-control"
             placeholder="Email address"
             value="<?php echo htmlentities($username);?>"
             required
             autofocus
             autocomplete="off">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password" required autocomplete="off">
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
    </form>
      <p class="text-center">Need an account? <a href="registration.php">Register</a> </p>
    </div>

    <?php require_once 'includes/footer.inc.php'?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

  </body>
</html>
