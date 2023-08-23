<!-- Samyam Pandey worked on this file -->
<!-- This is the page that comes up after clicking submit in the select_order_driver.php. 
In this page it shows the orders the driver selected from the orders that have not been completed. 
This file uses SELECT, DELETE, UPDATE. 
This file also asks the driver to type in the order id for the orders the driver has completed. 
After the driver has clicked on the completed button it deletes the order from the orders table because the order is completed. -->


<?php
include('include/config.php');
session_start();
$user_id = $_SESSION["user_id"];


if(isset($_GET['order_id'], $_GET['user_id'])){
   $order_id = $_GET['order_id'];
   $user_id = $_GET['user_id'];
  
   $query = mysqli_query($sql, "SELECT * FROM orders WHERE order_id='$order_id'");
  
  
  
  
  
  
}


if(isset($_POST['delete'])){
   $order_id = $_POST['order_id'];
   $query = mysqli_query($sql, "DELETE FROM list WHERE order_id='$order_id'");
   $query = mysqli_query($sql, "DELETE FROM items WHERE item_id='$order_id'");
   $query = mysqli_query($sql, "DELETE FROM orders WHERE order_id='$order_id'");
  
   header('Location: driver_order.php?order_id='.$order_id.'&user_id='.$user_id);
   exit();
}








?>


<!DOCTYPE html>
<html>
<head>
   <title>Orders Selected </title>
   <!-- Include Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>


   <div class="container">
       <div class="row">
           <div class="col-md-6 offset-md-3 mt-5">
               <h3 class="text-center mb-4">Orders</h3>
               <?php if(mysqli_num_rows($query) > 0){ ?>
               <table class="table table-bordered">
                   <thead>
                       <tr>
                           <th>Order ID</th>
                           <th>Item Name</th>
                           <th>Date</th>
                           <th>Driver ID</th>
                       </tr>
                   </thead>
                   <tbody>
                       <?php while($row = mysqli_fetch_assoc($query)){ ?>
                       <tr>
                           <td><?php echo $row['order_id']; ?></td>
                           <td><?php echo $row['list']; ?></td>
                           <td><?php echo $row['date']; ?></td>
                           <td><?php echo $row['driver_id']; ?></td>
                       </tr>
                       <?php } ?>
                   </tbody>
               </table>
               <form method="post">
                   <button type="submit" name="update" class="btn btn-primary">Update Driver ID</button>
               </form>
               <?php } else { ?>
               <p>No orders found for this user.</p>
               <?php } ?>
               <form method="post">
                   <div class="form-group">
                       <label for="order_id">Enter order ID for completed Orders:</label>
                       <input type="number" name="order_id" id="order_id" class="form-control" required>
                   </div>
                   <button type="submit" name="delete" class="btn btn-danger">Complete</button>
                   <a href="select_order_driver.php" class="btn btn-secondary">Back</a>
               </form>
           </div>
       </div>
   </div>


   <!-- Include Bootstrap JS -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>



