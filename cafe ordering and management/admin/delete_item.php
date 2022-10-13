<?php

include('../config/constants.php');

   if(isset($_GET['id'])&& isset($_GET['image_name'])) //either double & or single
   {
    
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $image_name = mysqli_real_escape_string($con, $_GET['image_name']);

    //remove img if available
    if($image_name != "")
    {
        $path = "../img/item/".$image_name;

        $remove = unlink($path);
        if($remove==false)
        {
            $_SESSION['upload']="<div class='failed'>Failed to Remove Image File.</div>";
            header('location:'.SITEURL.'admin/manage_item.php');
            die();
        }
    }
    
     $sql = "DELETE FROM tbl_item WHERE id=$id";
     $res = mysqli_query($con, $sql);

     if($res==true)
     {
        $_SESSION['delete-item'] = "<div class='success'>Item Deleted Successfully!</div>";
        header('location:'.SITEURL.'admin/manage_item.php');
     }
     else{
        $_SESSION['delete-item'] = "<div class='failed'>Failed to Delete Item!</div>";
        header('location:'.SITEURL.'admin/manage_item.php');
     }

   }
   else{
    $_SESSION['delete'] = "<div class='failed'>Failed to Delete Item.</div>";
    header('location:'.SITEURL.'admin/manage_item.php');
   }
?>