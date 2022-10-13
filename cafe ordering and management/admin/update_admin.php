<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php
            //Get the id of Selected admin
            $id= mysqli_real_escape_string($con, $_GET['id']);

            //Create sql query to get details
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";

            //Execute the query
            $res = mysqli_query($con,$sql);

            //Check whether the query is executed or not
            if($res==true)
            {
                //Check whether the data is available or not
                $count = mysqli_num_rows($res);
                //Check whether we have admin data or not
                if($count==1)
                {
                    //echo "Availabel Data";
                    $row = mysqli_fetch_assoc($res);

                    $full_name=$row['fullname'];
                    $user_name = $row['username'];
                }
                else{
                    header('location:'.SITEURL.'admin/manage_admin.php');
                }
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-35">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="fullname" value="<?php echo $full_name; ?>"></td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td><input type="" name="username" value="<?php echo $user_name; ?>" ></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" >
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    //Check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Button Clicked";
        //GET all the values from form to update
        $id = mysqli_real_escape_string($con, $_POST['id']);
        $full_name = mysqli_real_escape_string($con, $_POST['fullname']);
        $user_name = mysqli_real_escape_string($con, $_POST['username']);

        //Create sql query to update admin
        $sql2 = "UPDATE `tbl_admin` SET 
        fullname = '$full_name', 
        username = '$user_name' 
        WHERE id = $id 
        ";

      

        

        //Execute the query
        $res2 = mysqli_query($con,$sql2);

        //Check whether the query executed or not
        if($res2==true)
        {
            //Query executed and admin updated
            $_SESSION['update'] =  "<div class='success'>Admin Updated Successfully!</div>";
            header('location:'.SITEURL.'admin/manage_admin.php');
        }
        else{
            //failed to update admin
            $_SESSION['update'] =  "<div class='failed'>FAILED To Update.</div>";
            header('location:'.SITEURL.'admin/manage_admin.php');
        }
        
    }
?>


<?php include('partials/footer.php') ?>