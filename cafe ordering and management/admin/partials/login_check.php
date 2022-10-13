<?php 
    //Authentication - Access Control
    //Check whether the user is logged in or not
    if(!isset($_SESSION['user'])) //if user session is not set
    {
        //user is not logged in
        //redirect to login page with msg
        $_SESSION['no-login-message'] = "<div class='failed text-center'>Please to access Admin Panel!</div>" ;
        header('location:'.SITEURL.'admin/login.php');
    }
?>