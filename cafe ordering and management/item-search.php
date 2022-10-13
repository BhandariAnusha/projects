<?php include('partials-front/menu.php'); ?>

    <!-- ITEM SEARCH Section Starts Here -->
    <section class="item-search text-center">
        <div class="container">
            <?php
                //$search = $_POST['search'];
                $search = mysqli_real_escape_string($con, $_POST['search']); //escape all sql queries & unwanted things 
                //will consider string value only & will protect from sql query

            ?>
            
            <h2>Items on Your Search <a href="#" class="text-gray">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- ITEM SEARCH Section Ends Here -->



<!-- Item MEnu Section Starts Here -->
<section class="item-menu">
    <div class="container">
      <h2 class="text-center">Menu</h2>

      <?php
        
        $sql = "SELECT * FROM tbl_item WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
        $res = mysqli_query($con, $sql);

        if(mysqli_num_rows($res)>0)
        {
          while($row = mysqli_fetch_assoc($res))
          {
            $id = $row['id'];
            $title = $row['title'];
            $description = $row['description'];
            $price = $row['price'];
            $image_name = $row['image_name'];
            ?>
                  
            <div class="item-menu-box">
              <div class="item-menu-img">
                  <?php
                      if($image_name == "")
                      {
                         echo "<div class='failed'>Image Not Available.</div>";
                      }
                      else{
                        ?>
                        <img src="<?php echo SITEURL; ?>img/item/<?php echo $image_name; ?>" alt="Adrak Elaichi Tea"
                        class="img-responsive img-curve" />
                        <?php
                      }
                  ?>
                 
              </div>

              <div class="item-menu-desc">
                <h4><?php echo $title; ?></h4>
                <p class="item-price"><?php $price; ?></p>
                <p class="item-detail">
                   <?php echo $description; ?>
                </p>
                <br />

                <a href="<?php echo SITEURL; ?>order.php?item_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
              </div>
            </div>
            <?php
          }
        }
        else{
          echo "<div class='failed'>Item Not Found.</div>";
        }
      ?>

     

      
      <div class="clearfix"></div>
    </div>
  </section>
  <!-- Item Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>