<?php 
  include('../config/constants.php');
  include('login_check.php');
?>

<html>
    <head>
       <title>HCB</title>
       <link rel="stylesheet" href="../style/admin.css">
    </head>

    <body>
        <!-- Menu section starts here -->
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manage_admin.php">Admin</a></li>
                    <li><a href="manage_category.php">Category</a></li>
                    <li><a href="manage_item.php">Item</a></li>
                    <li><a href="manage_order.php">Order</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <!-- Menu section ends here -->

    </body>
</html>    