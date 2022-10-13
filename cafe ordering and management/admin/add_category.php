<?php
 include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset ($_SESSION['add']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset ($_SESSION['upload']);
            }
        ?>

        <br><br>

        <!-- Add Category Form Starts Here -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-35">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title" required >
                    </td>
                </tr>

                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" >&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="featured" value="No" >&nbsp;&nbsp;No
                    </td>
                </tr>

                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" value="Yes" >&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="active" value="No" >&nbsp;&nbsp;No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <!-- Add Category Form Starts Here -->
        

    </div>
</div>

<?php
   if(isset($_POST['submit']))
   {
     $title = mysqli_real_escape_string($con, $_POST['title']);
     if(isset($_POST['featured']))
     {
        $featured = mysqli_real_escape_string($con, $_POST['featured']);
     }
     else{
        $featured = "No";
     }

     if(isset($_POST['active']))
     {
        $active = mysqli_real_escape_string($con, $_POST['active']);
     }
     else{
        $active = "No";
     }

     if(isset($_FILES['image']['name']))
     {
        $image_name = $_FILES['image']['name'];
        
        if($image_name!="")
        {
        
        $ext = end(explode('.', $image_name));

        $image_name = "Item_Category_".rand(000,999).'.'.$ext;

        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../img/category/".$image_name;

        $upload = move_uploaded_file($source_path, $destination_path);
        if($upload==false)
        {
            $_SESSION['upload'] = "<div class='failed'>Failed to Upload Image.</div>";
            header('location:'.SITEURL.'admin/add_category.php');
            die();
        }
      }
     }
     else{
        $image_name = "";
     }


     $sql = "INSERT INTO `tbl_category` SET 
     `title`='$title',
     `image_name`='$image_name',
     `featured`='$featured',
     `active`='$active'
      ";


    /* $clean['qText'] = sprintf("
      INSERT INTO tbl_category (title, image_name, featured, active)
      VALUES ('$title', '$image_name', '$featured','$active')",

      mysqli_real_escape_string($con, $clean['title']),
      mysqli_real_escape_string($con, file_get_contents($_FILES['image']['tmp_name'])),
      mysqli_real_escape_string($con, $clean['featured']),
      mysqli_real_escape_string($con, $clean['active'])
    );

     $res = mysqli_query($con, $clean['qText']);*/

     $res = mysqli_query($con, $sql);

      if($res==true)
      {
        $_SESSION['add'] = "<div class='success'>Category Added Successfully!</div>";
        header('location:'.SITEURL.'admin/manage_category.php');
      }
      else{
        $_SESSION['add'] = "<div class='failed'>Failed to Add Category.</div>";
        header('location:'.SITEURL.'admin/add_category.php');
      }
   }
?>

<?php include('partials/footer.php'); ?>