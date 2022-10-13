<?php

 ob_start();

  //start the session here
  session_start();

  //Create constants to store Non Repeating Values
  define('SITEURL','http://localhost/pro/hcb/');
  define('LOCALHOST','localhost'); //constants are named with capital letter where variable are named in small letter
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '');
  define('DB_NAME','hcb');

  //Execute query and save data in database
  $con = mysqli_connect(LOCALHOST,DB_USERNAME, DB_PASSWORD) or die(mysqli_error());//database connection
  $db_select = mysqli_select_db($con,DB_NAME) or die(mysqli_error()); //select database

?>