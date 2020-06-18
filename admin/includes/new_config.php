<?php
// Database COnnection Constants
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','db_gallery');

$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

if($connection){
  //echo 'true';
}




 ?>
