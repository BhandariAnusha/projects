<?php include('partials-front/menu.php'); ?>


    <!--item search section starts here-->
    <section class="item-search text-center" id="search">
      <div class="container">
        <form action="<?php echo SITEURL; ?>item-search.php" method="POST">
          <input type="search" name="search" placeholder="search-for-item.." />
          <input type="submit" name="submit" value="Search" class="btn btn-primary"/>
        </form>
      </div>
    </section>
    <!--item search section ends here-->

    <!-- Item Menu Section Starts Here -->
    <section class="item-menu">
      <div class="container">
        <h2 class="text-center">Menu</h2>

        <?php
          $sql = "SELECT * FROM tbl_item WHERE active='Yes' ";

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
                    if($image_name=="")
                    {
                       echo "<div class='failed'>Image Not Available.</div>";
                    }   
                    else{
                      ?>
                       <img src="<?php echo SITEURL; ?>img/item/<?php echo $image_name ?>"  alt="Adrak Elaichi Tea"
                                class="img-responsive img-curve" />
                      <?php
                    }
                  ?>
                    
                  </div>

                  <div class="item-menu-desc">
                    <h4><?php echo $title; ?></h4>
                    <p class="item-price"><?php echo $price; ?></p>
                    <p class="item-details"><?php echo $description; ?></p>
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
