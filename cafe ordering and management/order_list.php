<?php  include('partials-front/menu.php'); 
    include('partials-front/access_check.php');
?>


 
  <div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Lists of Your Order</h1>
        <br><br>

        <?php
               if(isset($_SESSION['access']))
               {
                 echo $_SESSION['access'];
                 unset($_SESSION['access']);
               }
            ?>

          <table class="tbl_full">
                <tr>
                  <th>S.No.</th>
                  <th>Item</th>
                  <th>Price</th>
                  <th>Qty</th>
                  <th>Total</th>
                  <th>Order Date</th>
                  <th>Status</th>
                  <th>Customer Name</th>
                  <th>Contact</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Actions</th>
                </tr>
                <?php
                      $customer_name = isset($_POST['customer_name']);
                      $customer_contact = isset($_POST['customer_contact']);
                      $customer_email = isset($_POST['customer_email']);
                      $customer_address = isset($_POST['customer_address']);
                      
                      $sql = "SELECT * FROM tbl_order ORDER BY id DESC WHERE 
                      custmer_name='$customer_name' AND
                      customer_contact='$customer_contact' AND
                      customer_email='$customer_email' AND
                      customer_address='$customer_address'
                      "; //display latest order at first
                      $res = mysqli_query($con, $sql);

                      $sn = 1; //if (!$dbc || mysqli_num_rows($dbc) == 0)

                      if(!$sql || mysqli_num_rows($sql)>0)
                      {
                         while($row=mysqli_fetch_assoc($res))
                         {
                           $id = $row['id'];
                           $item = $row['item'];
                           $price = $row['price'];
                           $quantity = $row['quantity'];
                           $total = $row['total'];
                           $order_date = $row['order_date'];
                           $status = $row['status'];
                           $customer_name = $row['customer_name'];
                           $customer_contact = $row['customer_contact'];
                           $customer_email = $row['customer_email'];
                           $customer_address = $row['customer_address'];

                           ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $item; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $quantity; ?></td>
                                <td><?php echo $total; ?></td>
                                <td><?php echo $order_date; ?></td>

                                <td>
                                  <?php
                                      //Ordered, On Delivery, Delivered, Cancelled
                                       if($status=="Ordered")
                                       {
                                         echo "<label>$status</label>";
                                       }
                                       else if($status=="On Delivery")
                                       {
                                         echo "<label style='color:orange;'>$status</label>";
                                       }
                                       else if($status=="Delivered")
                                       {
                                         echo "<label style='color:Green;'>$status</label>";
                                       }
                                       else
                                       {
                                         echo "<label style='color:red;'>$status</label>";
                                       }
                                  ?>
                                </td>

                                <td><?php echo $customer_name; ?></td>
                                <td><?php echo $customer_contact; ?></td>
                                <td><?php echo $customer_email; ?></td>
                                <td><?php echo $customer_address; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>delete_orde.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                                </td>
                            </tr>
                           <?php
                         }
                      }
                      else{
                        echo "<tr><td colspan='12' class='failed'>Orders Not Available</td></tr>";
                      }
                    ?>
        </table>


         


    </div>
  </div>
<?php include('partials-front/footer.php'); ?>