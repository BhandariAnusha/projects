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

    <?php
        if(isset($_SESSION['order']))
        {
          echo $_SESSION['order'];
          unset($_SESSION['order']);
        }
    ?>

    <!-- Category Section starts here -->
    <section class="categories" id="category">
        <div class="container">
          <h2 class="text-center">Catagories</h2>

          <?php
              $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' Limit 4";

              $res = mysqli_query($con, $sql);

              if(mysqli_num_rows($res)>0)
              {
                while($row = mysqli_fetch_assoc($res))
                {
                  $id = $row['id'];
                  $title = $row['title'];
                  $image_name = $row['image_name'];
                  ?>
                   <a href="<?php echo SITEURL; ?>category-items.php?category_id=<?php echo $id; ?>">
                    <div class="box float-container">

                    <?php
                         if($image_name=="")
                         {
                           echo "<div class='failed'>Image Not Found.</div>";
                         }
                         else{
                         ?>
                            <img src="<?php echo SITEURL; ?>img/category/<?php echo $image_name; ?>" 
                              alt="Latte" class="img-responsive img-curve" />
                        <?php
                         }
                    ?>
                     
  
                    <h3 class="float-text text-gray"><?php echo $title; ?></h3>
                   </div>
                  </a>

                  <?php
                }
              }
              else{
                 echo "<div class='failed'>Category Not Available.</div>";
              }
          ?>

        
        
        <div class="clearfix"></div>
      </div>

      <p class="text-center">
            <a href="<?php echo SITEURL; ?>categories.php">See All Categories</a>
        </p>
    </section>
    <!-- category section ends here -->

    <!-- menu section starts here -->
    <section class="item-menu" id="explore">
      <div class="container">
        <h2 class="text-center">Explore Items</h2>

        <?php 
           $sql2 = "SELECT * FROM tbl_item WHERE active='Yes' AND featured='Yes' Limit 6";
           $res2 = mysqli_query($con, $sql2);
           
           if(mysqli_num_rows($res2)>0)
           {
             while($row2 = mysqli_fetch_assoc($res2))
             {
               $id = $row2['id'];
               $title = $row2['title'];
               $price = $row2['price'];
               $description = $row2['description'];
               $image_name = $row2['image_name'];
               ?>
                 <div class="item-menu-box">
                    <div class="item-menu-img">
                      <?php
                          if($image_name=="")
                          {
                             echo "<div class='failed'>Image not Available.</div>";
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
                      <p class="item-price">Rs.<?php echo $price; ?></p>
                      <p class="item-details"><?php echo $description; ?></p>
                       <br />
                      <a href="<?php echo SITEURL; ?>order.php?item_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                    </div>
                    <div class="clearfix"></div>
                  </div>
               <?php
             }
           }
           else{
            echo "<div class='failed'>No Item Available.</div>";
             
           }
        ?>
       



        <div class="clearfix"></div>
      </div>

      <p class="text-center">
            <a href="<?php echo SITEURL; ?>items.php">See All Items</a>
        </p>
    </section>
    <!-- menu section ends here-->

    <?php include('partials-front/footer.php'); ?>
  </body>
</html>
