<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Item</h1>
        <br><br>

        <?php
           if(isset($_SESSION['upload']))
           {
               echo $_SESSION['upload'];
               unset($_SESSION['upload']);
           } 
         ?>   

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-35">
                <tr>
                    <td>Title : </td>
                    <td><input type="text" name="title" value=""></td>
                </tr>

                <tr>
                    <td>Description : </td>
                    <td><textarea name="description" cols="30" rows="5"></textarea></td>
                </tr>

                <tr>
                    <td>Price : </td>
                    <td><input type="number" name="price" value=""></td>
                </tr>

                <tr>
                    <td>Select Image  :  </td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>

                <tr>
                    <td>Category : </td>
                    <td>
                        <select name="category" >

                            <?php 
                               $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                               $res = mysqli_query($con, $sql);

                               if(mysqli_num_rows($res)>0)
                               {
                                 while($row = mysqli_fetch_assoc($res))
                                 {
                                    //get the details from category
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>

                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                    
                                    <?php
                                 }
                               }
                               else{
                                  ?>
                                   <option value="0">No Category Added.</option>
                                  <?php
                               }
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured : </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active : </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Item" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

         <?php 
             if(isset($_POST['submit']))
             {
                $title = mysqli_real_escape_string($con, $_POST['title']);
                $description = mysqli_real_escape_string($con, $_POST['description']);
                $price = mysqli_real_escape_string($con, $_POST['price']);
                $category = mysqli_real_escape_string($con, $_POST['category']);
                
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

                //check whether the select is clicked or not & upload only if it is selected
                if(isset($_FILES['image']['name']))
                {
                     $image_name= $_FILES['image']['name'];

                     //check whether img is selected or not & upload only if it is selected
                     if($image_name != ""){
                        //img selected
                        //get the extention of selected img(jpeg,png,gif,ect)
                        $tmpp = explode('.',$_FILES['image']['name']);
                        $ext = end($tmpp);
                        //$ext = end(explode('.',$image_name));

                        //create new name for img
                        $image_name = "Item_Name_".rand(0000, 9999).".".$ext;

                        //get the source and dest path where the img is located
                        $src_path = $_FILES['image']['tmp_name'];
                        $dest_path = "../img/item/".$image_name;

                        //Upload Image
                        $upload = move_uploaded_file($src_path, $dest_path);

                        //Check whether img uploaded or not
                        if($upload==false){
                            //failed to upload img
                            $_SESSION['upload'] = "<div class='failed'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'admin/add_item.php');
                            die();
                        }
                     }
                }
                else{
                    $image_name = "";
                }

                $sql2 = "INSERT INTO tbl_item SET 
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                category_id='$category',
                featured='$featured',
                active='$active'
                ";

                $res2 = mysqli_query($con, $sql2);

                if( $res2== true)
                {
                  $_SESSION['add'] = "<div class='success'>Item Added Successfully.</div>";
                  header('location:'.SITEURL.'admin/manage_item.php');
                }
                else{
                    $_SESSION['add'] = "<div class='failed'>Failed to Add Item.</div>";
                    header('location:'.SITEURL.'admin/manage_item.php');
                }
             }
         ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>