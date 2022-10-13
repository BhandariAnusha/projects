<?php
  
  include('../config/constants.php');

  if(isset($_GET['id']) && isset($_GET['image_name']))
  {
    //echo "Get value from delete";
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $image_name = mysqli_real_escape_string($con, $_GET['image_name']);

    if($image_name != "")
    {
        $path = "../img/category/".$image_name;//if image is available now remove  it
        $remove = unlink($path);//will have boolean value

        if($remove == false)  //if failed to remove img then add error msg and stop the process
        {
            $_SESSION['remove'] = "<div class='failed'>Failed to Remove Category Image.</div>";
            header('location:'.SITEURL.'admin/manage_category.php');
            die(); //Stop the process
        }
    }
  
  $sql = "DELETE FROM tbl_category WHERE id = $id ";

  $res = mysqli_query($con, $sql);

  if($res == true)
  {
    $_SESSION['delete'] = "<div class ='success'>Category Deleted Successfully.</div>";
    header('location:'.SITEURL.'admin/manage_category.php');
  }
  else{
    $_SESSION['delete'] = "<div class ='failed'>Failed to Delete Category.</div>";
    header('location:'.SITEURL.'admin/manage_category.php');
  }
}  

  else{
    header('location:'.SITEURL.'admin/manage_category.php');
  }
?>