<?php
  //include constants.php file here
  include('../config/constants.php');

  // Get the id of the admin to be deleted
  $id = mysqli_real_escape_string($con, $_GET['id']);

  //Create sql query to delete admin
  $sql = "DELETE FROM tbl_admin WHERE id = $id";

  //Execute the query
  $res = mysqli_query($con, $sql);

  //check whether the query executed successfully or not
  if($res == true)
  {
    //Query executed successfully
    //echo "Admin Deleted Successfully";
    //Create session variable to Display Message
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
    //redirect to manage_admin page
    header('location:'.SITEURL.'admin/manage_admin.php');
  }
  else{
    //echo "Failed to delete Admin";
    $_SESSION['delete'] = '<div class="failed">Failed to delete Admin</div>';
    header('location:'.SITEURL.'admin/manage_admin.php');
  }

  //Redirect to the manage_admin page

?>