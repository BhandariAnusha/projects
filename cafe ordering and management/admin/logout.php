<?php

    include('../config/constants.php');
    //Destroy the session
    session_destroy();//unset $_SESSION['user']

    //Redirect to login page
    header('location:'.SITEURL.'admin/login.php');
?>