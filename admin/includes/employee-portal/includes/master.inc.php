<?php require_once("init.php") ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="device-width, initial-scale=1">
    <title>Portal</title>


    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<link rel="stylesheet" href="css/styles.css">
</head>
  <body>
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
   <!-- Brand -->
   <a class="navbar-brand" href="index.php">
     <img class="brand-image" src="images/logo.png" width="25" height="25"  alt="" style="margin:auto;"></a>

   <!-- Navbar links -->
   <div class="collapse navbar-collapse" id="collapsibleNavbar">
     <ul class="nav navbar-nav">
       <li><a href="index.php">Home</a></li>
       <li><a href="contact.php">Contact</a></li>
       <li><a href="about.php">About</a></li>
       <li><a href="careers.php">Careers</a></li>
     </ul>
     <ul class="nav navbar-nav ml-auto">
       <?php
           if(isset($_SESSION['user_id'])){
             echo '<li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>';
             echo '<li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>';
           } else {
               echo '<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Log In</a></li>';
               echo '<li><a href="registration.php"><span class="glyphicon glyphicon-pencil"></span> Register</a></li>';
           }
        ?>
      </ul>

   </div>
   <!-- Toggler/collapsibe Button -->
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
     <span class="navbar-toggler-icon"></span>
   </button>
  </nav>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>
