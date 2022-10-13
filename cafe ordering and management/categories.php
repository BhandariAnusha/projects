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

    <!-- CAtegories Section Starts Here -->
    <section class="categories" id="category">
        <div class="container">
          <h2 class="text-center">Catagories</h2>

          <?php
              $sql = "SELECT * FROM tbl_category WHERE active='Yes' ";

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
      </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php'); ?>


</body>
</html>