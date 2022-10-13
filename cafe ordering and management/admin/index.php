<?php
  include('partials/menu.php');
?>

        <!-- Main Content section starts here -->
        <div class="main-content">

            <div class="wrapper">
               <h1>DASHBOARD</h1>
               <br><br>

               <?php
                 if(isset($_SESSION['login']))
                  {
                     echo $_SESSION['login'];
                     unset ($_SESSION['login']);
                  }
               ?>
               <br><br>

               <div class="col text-center">

                 <?php

                    $sql = "SELECT * FROM tbl_category";
                    $res = mysqli_query($con , $sql);

                    $count = mysqli_num_rows($res);
                  ?>
                  <h1><?php echo $count; ?></h1>
                  Categories
               </div>

               <div class="col text-center">
               <?php

                  $sql2 = "SELECT * FROM tbl_item";
                  $res2 = mysqli_query($con , $sql2);

                  $count2 = mysqli_num_rows($res2);
               ?>
                  <h1><?php echo $count2; ?></h1>
                  Items
               </div>

               <div class="col text-center">

               <?php

                  $sql3 = "SELECT * FROM tbl_order";
                  $res3 = mysqli_query($con , $sql3);

                  $count3 = mysqli_num_rows($res3);
               ?>
                  <h1><?php echo $count3; ?></h1>
                  Total Orders
               </div>

               <div class="col text-center">

               <?php
                  //Aggregate function in sql
                  $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
                  $res4 = mysqli_query($con, $sql4);

                  //Get the value
                  $row4 = mysqli_fetch_assoc($res4);

                  $total_revenue = $row4['Total'];
               ?>
                  <h1>Rs.<?php echo $total_revenue; ?></h1>
                  Revenue Generated
               </div>

               <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main Content ends here -->

        <?php
          include('partials/footer.php');
        ?>