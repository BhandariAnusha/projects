<?php include('partials-front/menu.php'); ?>

<?php
  if(isset($_GET['item_id']))
  {
    $item_id = $_GET['item_id'];

    $sql = "SELECT * FROM tbl_item WHERE id=$item_id";
    $res = mysqli_query($con, $sql);

    $count = mysqli_num_rows($res);
    if($count==1)
    {
        $row = mysqli_fetch_assoc($res);

        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    }
    else{
        header('location:'.SITEURL);
    }
  }
  else{
    header('location:'.SITEURL);
  }
?>

    <!-- ITEM SEARCH Section Starts Here -->
    <section class="item-search">
        <div class="container">
            
            <h2 class="text-center text-gray">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Item</legend>

                    <div class="item-menu-img">

                    <?php
                        if($image_name=="")
                        {
                            echo "<div class='failed'>Image is not available.</div>";
                        }
                        else{
                            ?>
                            &nbsp;<img src="<?php echo SITEURL; ?>img/item/<?php echo $image_name; ?>" alt="Adrak Elaichi Chai" class="img-responsive img-curve">
                            <?php
                        }
                      ?>
                        
                    </div>
    
                    <div class="item-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidded" name="item" value="<?php echo $title; ?>" readonly>

                        <p class="item-price">Rs.<?php echo $price; ?></p>
                        <input type="hidded" name="price" value="<?php echo $price; ?>" readonly>

                        <div class="order-label">Qty</div>
                        <input type="number" name="quantity" class="input-responsive" value="1" min="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">&nbsp;Full Name</div>
                    &nbsp;<input type="text" name="fullname" placeholder="E.g. Pooja Kunwar" class="input-responsive" required>

                    <div class="order-label">&nbsp;Phone Number</div>
                    &nbsp;<input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">&nbsp;Email</div>
                    &nbsp;<input type="email" name="email" placeholder="E.g. poojaakunwar@gamil.com" class="input-responsive" required>

                    <div class="order-label">&nbsp;Address</div>
                    &nbsp;<textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    &nbsp;<input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
               if(isset($_POST['submit']))
               {
                 $item = mysqli_real_escape_string($con, $_POST['item']);
                 $price = mysqli_real_escape_string($con, $_POST['price']);
                 $quantity = mysqli_real_escape_string($con, $_POST['quantity']);

                 $total = $price*$quantity;
                 $order_date = date("Y-m-d h:i:sa");
                 $status = "Ordered"; //Ordered, On Delivery, Delivered and Cancelled
                 
                 $customer_name = mysqli_real_escape_string($con, $_POST['fullname']);
                 $customer_contact = mysqli_real_escape_string($con, $_POST['contact']);
                 $customer_email = mysqli_real_escape_string($con, $_POST['email']);
                 $customer_address = mysqli_real_escape_string($con, $_POST['address']);

                 $sql2 = "INSERT INTO tbl_order SET 
                 item='$item',
                 price='$price',
                 quantity='$quantity',
                 total='$total',
                 order_date='$order_date',
                 status='$status',
                 customer_name='$customer_name',
                 customer_contact='$customer_contact',
                 customer_email='$customer_email',
                 customer_address='$customer_address'
                 ";

                 //echo $sql2; die();

                 $res2 = mysqli_query($con,$sql2);

                 if($res2==true)
                 {
                    $_SESSION['order'] = "<div class='success text-center'>Item Ordered Successfully.</div>";
                    header('location:'.SITEURL);
                 }
                 else{
                    $_SESSION['order'] = "<div class='failed text-center'>Failed to Order Item.</div>";
                    header('location:'.SITEURL);
                 }
               }
            ?>

        </div>
    </section>
    <!-- ITEM SEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?>



</body>
</html>