<?php include('partials-front/menu.php'); ?>

<?php
  if(isset($_GET['category_id']))
  {
     $category_id = $_GET['category_id'];

     $sql = "SELECT title FROM tbl_category WHERE id='$category_id'"; //Get the category title based on category_id
     $res = mysqli_query($con, $sql);

     $row = mysqli_fetch_assoc($res);
     $category_title = $row['title'];
  }
  else{
    header('location:'.SITEURL);
  }
?>

    <!--item search section starts here-->
    <section class="item-search text-center" id="search">
    <div class="container">
            
            <h2>Items on <a href="" class="text-gray">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!--item search section ends here-->


    <!-- Item Menu Section Starts Here -->
    <section class="item-menu">
      <div class="container">
        <h2 class="text-center">Item Menu</h2>

        <?php
            $sql2 = "SELECT * FROM tbl_item WHERE category_id='$category_id'";//Get item based onselected category

            $res2 = mysqli_query($con, $sql2);
            $count2 = mysqli_num_rows($res2);

            if($count2>0)
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
                               echo "<div class='failed'>Image Not Available.</div>";
                            }
                            else{
                               ?>

                                 <img src="<?php echo SITEURL; ?>img/item/<?php echo $image_name; ?>" 
                                 alt="Latte" class="img-responsive img-curve" />
                               <?php
                            }
                        ?>
                          
                      </div>

                      <div class="item-menu-desc">
                          <h4><?php echo $title; ?></h4>
                          <p class="item-price">Rs.<?php echo $price; ?></p>
                          <p class="item-details">
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
              echo "<div class='failed'>Item Not Available.</div>";
            }
        ?>

        

        

        <div class="clearfix"></div>
      </div>
    </section>
    <!-- Item Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>