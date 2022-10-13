<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <fieldset>
            <legend><strong>Change Password</strong></legend>
            <br><br>

            <?php
                if(isset($_GET['id']))
                {
                    $id = mysqli_real_escape_string($con, $_GET['id']);
                }
            ?>

            <form action="" method="POST">
                <table class="tbl-35">
                    <tr>
                        <td>Current Password</td>
                        <td><input type="password" name="current_password" value="" placeholder="current password"></td>
                    </tr>

                    <tr>
                        <td>New Password</td>
                        <td><input type="password" name="new_password" placeholder="new password"></td>
                    </tr>

                    <tr>
                        <td>Confirm Password</td>
                        <td><input type="password" name="confirm_password" placeholder="confirm password"></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Change Password" class="btn-primary">
                        </td>
                    </tr>

                </table>
            </form>
            <br>

        </fieldset>
    </div>
</div>

<?php
    //Check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Cliked";

        //Get the data from form
        $id = mysqli_real_escape_string($con, $_POST['id']);
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);


        //Check whether the user with current password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password' ";

        //Execute the query
        $res = mysqli_query($con,$sql);

        if($res==true)
        {
            //check whether data is available or not
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                //User Exists and Password can be changed
                if ($new_password==$confirm_password)
                {
                    //update password
                    $sql2 = "UPDATE tbl_admin SET 
                    password='$new_password'
                    WHERE id=$id";

                    //Execute the query
                    $res2 = mysqli_query($con,$sql2);

                    //Check whether the query or not
                    if($res2 == true)
                    {
                        //display success msg
                        $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully.</div>";
                        header('location:'.SITEURL.'admin/manage_admin.php');
                    }
                    else{
                        //display error msg
                        $_SESSION['change-pwd'] = "<div class='failed'>Failed to change Password.</div>";
                        header('location:'.SITEURL.'admin/manage_admin.php');
                    }

                }
                else{
                    //redirect to manage admin page with error message
                    $_SESSION['pwd-not-match'] = "<div class='failed'>Password did not match.</div>";
                    header('location:'.SITEURL.'admin/manage_admin.php');
                }
            }
            else{
                //User does not exist set message and redirect
                $_SESSION['user-not-found'] = "<div class='failed'>User Not Found.</div>";
                header('location:'.SITEURL.'admin/manage_admin.php');
            }
        }

        //Check whether the new password and confirm match or not

        //Change password if all above is true

    }
?>
<?php include('partials/footer.php'); ?>