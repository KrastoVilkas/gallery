<?php require_once("includes/init.php") ?>

<?php if(!$session->is_signed_in()){redirect('login.php');}?>

<?php $user = User::find_user_by_id($session->user_id);?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="device-width, initial-scale=1">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  </head>
  <body>
    <?php require 'includes/master.inc.php' ?>

    <div class="container text-center">
      <h1 class="profile-title">Employee <s>Test Subject</s> Profile</h1>
    </div>
    <div class="profile-message">
      <h2>Welcome Test Subject <?php echo $user->user_lname ?></h2>
      <p>Please ensure the following information is correct.</p>
      <p>If any fields require correction, please note that the wait time is currently
        <strong class="wait-time">200 years.</strong></p>
    </div>
      <table class="table table-hover profile-table">
        <thead>
          <th>Employee ID</th>
          <th>Email</th>
          <th>Password</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Address</th>
          <th>Phone</th>
          <th>Salary</th>
          <th>SSN</th>
        </thead>
        <tr>
          <td><?php echo $user->user_id ?></td>
          <td><?php echo $user->user_email ?></td>
          <td><?php echo $user->user_password ?></td>
          <td><?php echo $user->user_fname ?></td>
          <td><?php echo $user->user_lname ?></td>
          <td><?php echo $user->user_addr ?></td>
          <td><?php echo $user->user_phone ?></td>
          <td><?php echo $user->user_salary ?></td>
          <td><?php echo $user->user_SSN?></td>
        </tr>
      </table>


    <?php require_once 'includes/footer.inc.php'?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

  </body>
</html>
