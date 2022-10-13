<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php
           if(isset($_GET['id']))
           {
             $id = mysqli_real_escape_string($con, $_GET['id']);

             $sql = "SELECT * FROM tbl_order WHERE id=$id";
             $res = mysqli_query($con, $sql);
             if(mysqli_num_rows($res)==1)
             {
                $row = mysqli_fetch_assoc($res);

                $item = $row['item'];
                $price = $row['price'];
                $quantity = $row['quantity'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
             }
             else{
                //echo "<div class='failed'>Details Not Available</div>";
                header('location:'.SITEURL.'admin/update_order.php');
             }
           }
           else{
            header('location:'.SITEURL.'admin/manage_order.php');
           }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-35">
                <tr>
                    <td>Item Name</td>
                    <td><b><?php echo $item; ?></b></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>
                        <b>Rs.<?php echo $price; ?></b>
                    </td>
                </tr>

                <tr>
                    <td>Quantity</td>
                    <td>
                        <input type="number" name="quantity" value="<?php echo $quantity; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected"; } ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected"; } ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected"; } ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected"; } ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact</td>
                    <td>
                        <input type="tel" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email</td>
                    <td>
                        <input type="email" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Address</td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
           if(isset($_POST['submit']))
           {
             //echo "Clicked";
             $id = mysqli_real_escape_string($con, $_POST['id']);
             $price = mysqli_real_escape_string($con, $_POST['price']);
             $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
             $total = $price * $quantity;

             $status = mysqli_real_escape_string($con, $_POST['status']);
             $customer_name = mysqli_real_escape_string($con, $_POST['customer_name']);
             $customer_contact = mysqli_real_escape_string($con, $_POST['customer_contact']);
             $customer_email = mysqli_real_escape_string($con, $_POST['customer_email']);
             $customer_address = mysqli_real_escape_string($con, $_POST['customer_address']);

             $sql2 = "UPDATE tbl_order SET 
             quantity=$quantity,
             total = $total,
             status = '$status',
             customer_name='$customer_name',
             customer_contact='$customer_contact',
             customer_email='$customer_email',
             customer_address = '$customer_address'
             WHERE id=$id
             ";

            $res2 = mysqli_query($con, $sql2);

            if($res2==true)
            {
                $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                header('location:'.SITEURL.'admin/manage_order.php');
            }
            else{
                $_SESSION['update'] = "<div class='failed'>Failed to Update Order.</div>";
                header('location:'.SITEURL.'admin/manage_order.php');
               }
           }

           
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>