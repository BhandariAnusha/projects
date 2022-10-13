<?php include('../config/constants.php') ?>
<html>
    <head>
        <title>Login - HCB</title>
        <link rel="stylesheet" href="../style/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center color">Login</h1>
            <br><br>

            <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset ($_SESSION['login']);
            }

            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset ($_SESSION['no-login-message']);
            }
            ?>

            <!-- Login form starts here -->
            <form action="" method="POST">
                <table>
                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td><input type="text" name="user_name" placeholder="Enter Username" required></td>
                    </tr>

                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td><input type="password" name="password" placeholder="Enter Password" required></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Login" class="btn-primary">
                        </td>
                    </tr>
                </table>
            </form>
            <!-- Login form ends here -->
        </div>
    </body>
</html>

<?php
  //check whether the submit button is clicked or not
  if(isset($_POST['submit']))
  {
    //Process for login
    //Get the data from login form
    //$user_name= $_POST['user_name'];//name in table
    $user_name= mysqli_real_escape_string($con, $_POST['user_name']);
    //$password = md5($_POST['password']);
    $password = mysqli_real_escape_string($con, md5($_POST['password']));

    //check whether the user with username and password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$user_name' AND password='$password'";

    //3.Execute the query
    $res = mysqli_query($con,$sql);

    //count rows to check whether user exists or not
    {
        if(mysqli_num_rows($res)==1)
    {
        //user availabele and login success
        $_SESSION['login'] = "<div class='success text-center'>Login Successful.</div>";
        $_SESSION['user'] = $user_name; //to check whether the user is logged in or not and logout will unset it
        header('location:'.SITEURL.'admin/');
    }
    else{
        //user not availabele and login failed
        $_SESSION['login'] = "<div class='failed text-center'>Username or Password did not match.</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
   }
  }
?>