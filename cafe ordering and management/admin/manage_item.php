<?php
 include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
       <h1>Manage Item</h1>

       <br><br>

               <!-- Button to add admin -->
               <a href="<?php echo SITEURL; ?>admin/add_item.php" class="btn-primary">Add Item</a>
               

               <br>
               <br>

               <?php
                  if(isset($_SESSION['add']))
                  {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                  }
                  if(isset($_SESSION['delete-item']))
                  {
                    echo $_SESSION['delete-item'];
                    unset($_SESSION['delete-item']);
                  }
                  if(isset($_SESSION['upload']))
                  {
                   echo $_SESSION['upload'];
                   unset($_SESSION['upload']);
                  } 
                  if(isset($_SESSION['delete']))
                  {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                  }
                  if(isset( $_SESSION['update']))
                  {
                    echo  $_SESSION['update'];
                    unset($_SESSION['update']);
                  }
               ?>

               <table class="tbl_full">
                  <tr>
                    <th>S.No.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                  </tr>

                  <?php 
                     $sql = "SELECT * FROM tbl_item ";
                     $res = mysqli_query($con,$sql);

                     $sn=1;

                     if(mysqli_num_rows($res)>0)
                     {
                      //have item in database
                      while($row=mysqli_fetch_assoc($res))
                      {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?> 
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>
                            <td>Rs.<?php echo $price; ?></td>
                            <td>
                              <?php
                                 if($image_name=="")
                                 {
                                  echo "<div class='failed'>Image Not Added.</div>";
                                 }
                                 else{
                                  ?>
                                    <img src="<?php echo SITEURL; ?>img/item/<?php echo $image_name; ?>" width="100px">
                                  <?php
                                 }
                              ?>
                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                              <a href="<?php echo SITEURL; ?>admin/update_item.php?id=<?php echo $id; ?>" class="btn-secondary">Update Item</a>
                              <a href="<?php echo SITEURL; ?>admin/delete_item.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" 
                              class="btn-tertary">Delete Item</a>
                           </td>
                        </tr>


                        <?php
                      }
                     }
                     else{
                      //no item in database
                      echo "<tr>
                        <td colspan='7' class='error'>Food Not Added Yet.</td>
                      </tr>";
                     }
                  ?>

                  

               </table>
    </div>
</div>

<?php
 include('partials/footer.php');
?>