<?php
 include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
       <h1>Manage Categories</h1>

       <br><br>
       <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset ($_SESSION['add']);
            }
            if(isset($_SESSION['remove']))
            {
              echo $_SESSION['remove'];
              unset($_SESSION['remove']);
            }
            if(isset($_SESSION['delete']))
            {
              echo $_SESSION['delete'];
              unset($_SESSION['delete']);
            }
            if(isset($_SESSION['no-catagory-found']))
            {
              echo $_SESSION['no-catagory-found'];
              unset($_SESSION['no-catagory-found']);
            }
            if(isset($_SESSION['update']))
            {
              echo $_SESSION['update'];
              unset($_SESSION['update']);
            }
            if(isset($_SESSION['upload']))
            {
              echo $_SESSION['upload'];
              unset($_SESSION['upload']);
            }
            if(isset($_SESSION['failed-to-remove']))
            {
              echo $_SESSION['failed-to-remove'];
              unset($_SESSION['failed-to-remove']);
            }
        ?>
        <br><br>

               <!-- Button to add admin -->
               <a href="<?php echo SITEURL; ?>admin/add_category.php" class="btn-primary">Add Category</a>
               

               <br>
               <br>

               <table class="tbl_full">
                  <tr>
                    <th>S.No.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                  </tr>

                  <?php
                    $sql = "SELECT * FROM tbl_category";

                    $res = mysqli_query($con, $sql);

                    $sn = 1;
                    if(mysqli_num_rows($res)>0)
                    {
                      while($row = mysqli_fetch_assoc($res))
                      {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>

                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>
                          <?php 
                            if($image_name != "")
                            {
                              ?>

                              <img src="<?php echo SITEURL; ?>img/category/<?php echo $image_name; ?>" width="100px" >
                              
                              <?php
                            } 
                            else{
                              echo "<div class='failed'>Image Not Added!</div>";
                            }
                          ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                          <a href="<?php echo SITEURL; ?>admin/update_category.php?id=<?php echo $id;  ?>" class="btn-secondary">Update Category</a>

                          <a href="<?php echo SITEURL; ?>admin/delete_category.php?id=<?php echo $id; ?>
                          &image_name=<?php echo $image_name; ?>" class="btn-tertary">Delete Category</a>
                        </td>
                    </tr>
                        
                        <?php
                      }
                    }
                    else{
                      ?>

                      <tr>
                         <td colspan='6'><div class="failed">No Category Added.</div></td>
                      </tr>
                      
                      <?php
                    }
                    
                  ?>

      
            </table>
     </div>
</div>

<?php
 include('partials/footer.php');
?>