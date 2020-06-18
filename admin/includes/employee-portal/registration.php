<?php require_once("includes/init.php") ?>

<?php if($session->is_signed_in()){redirect('profile.php');}?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="device-width, initial-scale=1">
    <title>Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link rel="stylesheet" href="css/registration.css">
  </head>
  <body>
    <?php
      require 'includes/master.inc.php';

      $fname = '';
      $lname = '';
      $email = '';
      $password = '';
      $addr = '';
      $phone = '';
      $salary = '';
      $ssn = '';

      if (isset($_POST['submit'])) {
        $ok = true;
        if (!isset($_POST['fname']) || $_POST['fname'] === '') {
            $ok = false;
        } else {
            $fname = $_POST['fname'];
        }
        if (!isset($_POST['lname']) || $_POST['lname'] === '') {
            $ok = false;
        } else {
            $lname = $_POST['lname'];
        }
        if (!isset($_POST['email']) || $_POST['email'] === '') {
            $ok = false;
        } else {
            $email = $_POST['email'];
        }
        if (!isset($_POST['password']) || $_POST['password'] === '') {
            $ok = false;
        } else {
            $password = $_POST['password'];
        }
        if (!isset($_POST['addr']) || $_POST['addr'] === '') {
            $addr = NULL;
        } else {
            $addr = $_POST['addr'];
        }
        if (!isset($_POST['phone']) || $_POST['phone'] === '') {
            $phone = NULL;
        } else {
            $phone = $_POST['phone'];
        }
        if (!isset($_POST['salary']) || $_POST['salary'] === '') {
            $salary = NULL;
        } else {
            $salary = $_POST['salary'];
        }
        if (!isset($_POST['ssn']) || $_POST['ssn'] === '') {
            $ssn = NULL;
        } else {
            $ssn = $_POST['ssn'];
        }

        if ($ok) {
            $pHashed = password_hash($password, PASSWORD_DEFAULT);
            // add database code here
            $sql = sprintf("INSERT INTO tbl_users (user_fname, user_lname, user_email, user_password, user_addr, user_phone, user_salary, user_SSN) VALUES (
              '%s', '%s', '%s', '%s','%s', '%s', '%d', '%s'
            )", $DB->escape_string($fname),
                $DB->escape_string($lname),
                $DB->escape_string($email),
                $DB->escape_string($pHashed),
                $DB->escape_string($addr),
                $DB->escape_string($phone),
                $DB->escape_string($salary),
                $DB->escape_string($ssn));
            $DB->executeQuery($sql);
            //echo '<p><s>Test Subject</s> Added.</p>';
            redirect('login.php');
        }
      }
    ?>

<div class="container">
  <div style="text-align: center; padding-top:3%;">
    <h1>New <s>Test Subject</s> Employee Registration</h1>
  </div>

  <hr style="margin-bottom: 0;">
<div class="row">

  <div class="col text-center">
    <img src="images\kindpng_2027226.png" class="glados" alt="">
  </div>

  <div class="col">
    <div class="container">
    <div class="card bg-light" style="margin-top: 10%">
    <article class="card-body mx-auto" style="max-width: 400px;">
    	<form method="post" action="">
        <!-- First Name -->
        <div class="form-group input-group">
      		<div class="input-group-prepend">
      		    <span class="input-group-text"> <i class="fa fa-user fa-fw"></i> </span>
      		 </div>
              <label for="fname"  class="sr-only">First Name</label>
              <input id="fname" name="fname" class="form-control required" placeholder="First Name" type="text" autocomplete="off" required>
        </div>

        <!-- Last Name -->
        <div class="form-group input-group">
      	<div class="input-group-prepend">
      	    <span class="input-group-text"> <i class="fa fa-user fa-fw"></i> </span>
      	 </div>
            <label for="lname" class="sr-only">Last Name</label>
            <input id="lname" name="lname" class="form-control required" placeholder="Last Name" type="text" autocomplete="off" required>
      </div>

      <!-- Email -->
      <div class="form-group input-group">
        	<div class="input-group-prepend">
    		    <span class="input-group-text"> <i class="fa fa-envelope  fa-fw"></i> </span>
    		 </div>
            <label for="email" class="sr-only">Email</label>
            <input id="email" name="email" class="form-control required" placeholder="Email address" type="email" autocomplete="off" required>
      </div>

      <!-- Password -->
        <div class="form-group input-group">
        	<div class="input-group-prepend">
    		    <span class="input-group-text"> <i class="fa fa-lock fa-fw"></i> </span>
    		</div>
           <label for="password" class="sr-only">Create Password</label>
           <input id="password" name="password" class="form-control" placeholder="Create password" type="password" autocomplete="off" required>
        </div>

        <!-- Address -->
        <div class="form-group input-group">
          <div class="input-group-prepend">
              <span class="input-group-text"> <i class="fa fa-home fa-fw"></i> </span>
           </div>
              <label for="addr" class="sr-only">Address</label>
              <input id="addr" name="addr" class="form-control" placeholder="Address" type="text" autocomplete="off" >
        </div>

        <!-- Phone -->
        <div class="form-group input-group">
          <div class="input-group-prepend">
              <span class="input-group-text"> <i class="fa fa-mobile-alt fa-fw"></i> </span>
           </div>
              <label for="phone" class="sr-only">Phone</label>
              <input id="phone" name="phone" class="form-control" placeholder="Phone" type="text" autocomplete="off" >
        </div>

        <!-- Salary -->
        <div class="form-group input-group">
          <div class="input-group-prepend">
              <span class="input-group-text"> <i class="fa fa-dollar-sign fa-fw"></i> </span>
           </div>
              <label for="salary" class="sr-only">Salary</label>
              <input id="salary" name="salary" class="form-control" placeholder="Salary" type="text" autocomplete="off" >
        </div>

        <!-- SSN -->
        <div class="form-group input-group">
          <div class="input-group-prepend">
              <span class="input-group-text"> <i class="fa fa-id-card fa-fw"></i> </span>
           </div>
              <label for="ssn" class="sr-only">SSN</label>
              <input id="ssn" name="ssn" class="form-control" placeholder="SSN" type="text" autocomplete="off" >
        </div>

         <!-- Submit Button -->
        <div class="form-group">
            <button id="submit" name="submit" type="submit" class="btn btn-primary btn-block"> Create Account  </button>
        </div>
        <p class="text-center">Already have an account? <a href="login.php">Log In</a> </p>
    </form>
    </article>
    </div>

    </div>
  </div>
</div>

</div>

    <?php require_once 'includes/footer.inc.php'?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

  </body>
</html>


<!--
  require_once('protected/config.php');

  <div class="glados">
    <img src="images\kindpng_2027226.png" class="mb-4" alt="glados">
  </div>
-->
