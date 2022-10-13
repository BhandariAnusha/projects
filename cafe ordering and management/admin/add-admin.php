<?php
   include('partials/menu.php');
?>

<div class="ma-in-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add']))//checking whether the session is set or not
            {
                echo $_SESSION['add'];  //display session message
                unset($_SESSION['add']); //display session message
            }
        ?>

        <form action="" method="POST" ><!-- if we leave action empty then the form will process in 
    the same page -->
            <table class="tbl-35">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" placeholder="Enter your full name" required></td>
                </tr>

                <tr>
                    <td>Username</td>
                    <td><input type="text" name="user_name" placeholder="Enter your username" required></td>
                </tr>

                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" placeholder="Enter your password" required></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <br>
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
   include('partials/footer.php');
?>

<?php
   //Process the value from form and save it in database
   //Check whether the submit button is clicked or not

   if(isset($_POST['submit']))//whether the value is passed using post method or not
   {
     // button clicked
    
     //Get the data from form
     $full_name = mysqli_real_escape_string($con, $_POST['full_name']);
     $user_name = mysqli_real_escape_string($con, $_POST['user_name']);
     $password = md5($_POST['password']); //md5 is used to encrypt our password
     
     //SQL Query to save data into database
     $sql = "INSERT INTO tbl_admin
     SET fullname= '$full_name', 
     username= '$user_name',
     password = '$password'
     ";


     //executing query and saving data in database
    
     $res = mysqli_query($con, $sql) or die('Error: ' . mysqli_error($con));

     //Check whether the (Query is executed) data is inserted or not and display appropriate med=ssage
     if($res == TRUE)
     {
        //data inserted
        //echo "Data Inserted";

        //create a session variable to display message
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";

        //redirect Page to manage admin
        header("location:".SITEURL.'admin/manage_admin.php');
     }
     else{
        //echo "Failed to insert data";

        //create a session variable to display message
        $_SESSION['add'] = "Failed to Add Admin";

        //redirect Page to add admin
        header('location:'.SITEURL.'admin/add-admin.php');
     }

   }
   else{
    
   }

?>