<?php include('partials/menu.php'); ?>

<?php 
   if(isset($_GET['id']))
   {
      $id = mysqli_real_escape_string($con, $_GET['id']);

      $sql2 = "SELECT * FROM tbl_item WHERE id=$id";
      $res2 = mysqli_query($con,$sql2);

      $row2 = mysqli_fetch_assoc($res2);

      $title = $row2['title'];
      $description = $row2['description'];
      $price = $row2['price'];
      $current_image = $row2['image_name'];
      $current_category = $row2['category_id'];
      $featured = $row2['featured'];
      $active = $row2['active'];
   }
   else{
    header('location:'.SITEURL.'admin/manage_item.php');
   }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Item</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-35">
                <tr>
                    <td>Title  </td>
                    <td><input type="text" name="title" placeholder="" value="<?php echo $title; ?>"></td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" cols="30" rows="4"> <?php echo $description; ?>

                        </textarea></td>
                </tr>

                <tr>
                    <td>Price  </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image  </td>
                    <td>
                        <?php
                            if($current_image=="")
                            {
                                echo "<div class='failed'>Image Not Available.</div>";
                            }
                            else{
                                ?>
                                   <img src="<?php echo SITEURL; ?>img/item/<?php echo $current_image; ?>" alt="<?php echo $title; ?>" width="173px">
                                <?php
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image   </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category  </td>
                    <td><select name="category" >
                         
                         <?php
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            $res = mysqli_query($con, $sql);

                            if(mysqli_num_rows($res)>0)
                            {
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];
                                    //echo "<option value='$category_id'>$category_title</option>"; we cannot do if so down one is preffered
                                    ?>
                                     <option <?php if($current_category==$category_id) { echo "selected";} ?> value="<?php echo $category_id; ?>"> <?php echo $category_title; ?></option>
                                    <?php
                                    
                                }
                            }
                            else{
                                echo "<option value='0'>Category Not Available.</option>";
                            }
                         ?>
                        
                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured  </td>
                <td>
                    <input <?php if($featured=='Yes'){ echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                    <input <?php if($featured=='No'){ echo "checked";} ?> type="radio" name="featured" value="No">No
                </td>
            </tr>

            <tr>
                <td>Active  </td>
                <td>
                    <input <?php if($active=='Yes'){ echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active=='No'){ echo "checked";} ?> type="radio" name="active" value="No">No
                </td>
            </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                       <input type="submit" name="submit" value="Update Item" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if(isset($_POST['submit']))
            {
                $id = mysqli_real_escape_string($con, $_POST['id']);
                $description = mysqli_real_escape_string($con, $_POST['description']);
                $price = mysqli_real_escape_string($con, $_POST['price']);
                $current_image = mysqli_real_escape_string($con, $_POST['current_image']);
                $category = mysqli_real_escape_string($con, $_POST['category']);
                $featured = mysqli_real_escape_string($con, $_POST['featured']);
                $active = mysqli_real_escape_string($con, $_POST['active']);

                if(isset($_FILES['image']['name']))
                {
                    //upload btn clicked
                    $image_name = $_FILES['image']['name'];
                    //check file is available or not
                    
                    if($image_name!="")
                    {
                        //A. Upload image
                        $ext = end(explode('.',$image_name));//get extension of img
                        $image_name = "Item_Name_".rand(0000,9999).'.'.$ext;

                        //Get source and dest path
                        $src = $_FILES['image']['tmp_name'];
                        $dest = "../img/item/".$image_name;

                        $upload = move_uploaded_file($src, $dest);

                        //check whether img is uploaded or not
                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='failed'>Failed to Upload New Image.</div>";
                            header('location:'.SITEURL.'admin/manage_item.php');
                            die(); //to stop the process
                        }

                        if($current_image!="")
                        {
                            //Current img available
                            //Remove img
                            $remove_path = "../img/item/".$current_image;

                            $remove = unlink($remove_path);

                            //check whether the img is removed or not
                            if($remove==false)
                            {
                                //failed to remove img
                                $_SESSION['remove-failed'] = "<div class='failed'>Failed to Delete Image.</div>";
                                header('location:'.SITEURL.'admin/manage_item.php');
                                die();
                            }
                        }
                    }
                    else{
                        $image_name = $current_image; //default when img is not selected
                    }
                }
                else{
                    $image_name = $current_image; //default img when button is not clicked
                }

                $sql3 = "UPDATE tbl_item SET 
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                category_id='$category',
                featured='$featured',
                active='$active' 
                WHERE id=$id
                ";

                $res3 = mysqli_query($con, $sql3);

                if($res3 == true)
                {
                    $_SESSION['update'] = "<div class='success'>Item Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage_item.php');

                }
                else{
                    $_SESSION['update'] = "<div class='failed'>Failed to Update Item.</div>";
                    header('location:'.SITEURL.'admin/manage_item.php');
                }

            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>