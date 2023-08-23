<!-- Samyam Pandey wokred on this page -->
<!--  in this file when the driver logins and clicks on the order tabs it redirects to an orders page. 
In this page it shows all the orders a that have not been selected by a driver. 
It asks the driver to enter the order id for the order he wants and the driver username. This file uses SELECT. -->


<?php


include('include/config.php');
$query = mysqli_query($sql, "SELECT * FROM orders ");

if(isset($_POST['submit'])){
    $order_id = $_POST['order_id'];
    $query = mysqli_query($sql, "SELECT order_id FROM orders WHERE order_id='$order_id'");
    $row = mysqli_fetch_assoc($query);
    $order_id = $row['order_id'];
    $username = $_POST['username'];
    $query = mysqli_query($sql, "SELECT user_id FROM users WHERE username='$username'");
    $row = mysqli_fetch_assoc($query);
    $user_id = $row['user_id'];
    
    
    header('Location: driver_order.php?order_id='.$order_id.'&user_id='.$user_id);
    
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Choose an order you want to take </title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <?php include('driver_header.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 mt-5">
                <h3 class="text-center mb-4">Choose Order</h3>
                <?php if(mysqli_num_rows($query) > 0){ ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Item Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Store ID</th>
                            <th>Customer ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($query)){ ?>
                        <tr>
                            <td><?php echo $row['order_id']; ?></td>
                            <td><?php echo $row['list']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['time']; ?></td>
                            <td><?php echo $row['store_id']; ?></td>
                            <td><?php echo $row['cus_id']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php } else { ?>
                <p>No orders have been placed.</p>
                <?php } ?>
                <form method="post" >
                    <div class="form-group">
                        <label for="order_id">Enter order id:</label>
                        <input type="number" class="form-control" id="order_id" name="order_id">
                    </div>
                    <div class="form-group">
                        <label for="driver_username">Enter driver username:</label>
                        <input type="text" class="form-control" id="driver_username" name="driver_username">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
               
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
