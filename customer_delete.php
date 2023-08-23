<!-- Samyam Pandey worked on this page -->
<!-- This page is the page that comes up after the user types in their username and clicks submit in the delete_order_name.php. 
In this page it shows the orders the user had made and it ask if the user wants to delete an order and if they do it asks them to type in the order id. 
This file uses DELETE to delete an order the user doesn't want any more. -->


<?php
include('include/config.php');

if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    $query = mysqli_query($sql, "SELECT * FROM orders WHERE cus_id='$user_id'");
}
// after submiting it dletes the order.
if(isset($_POST['delete'])){
    $order_id = $_POST['order_id'];
    $query = mysqli_query($sql, "DELETE FROM list WHERE order_id='$order_id'");
    $query = mysqli_query($sql, "DELETE FROM  items WHERE item_id='$order_id'");
    $query = mysqli_query($sql, "DELETE FROM orders WHERE order_id='$order_id'");
    header('Location: customer_delete.php?user_id='.$user_id);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Items </title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 mt-5">
                <h3 class="text-center mb-4">Delete Items</h3>
                <?php if(mysqli_num_rows($query) > 0){ ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Item Name</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($query)){ ?>
                        <tr>
                            <td><?php echo $row['order_id']; ?></td>
                            <td><?php echo $row['list']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php } else { ?>
                <p>No orders found for this user.</p>
                <?php } ?>
                <form method="post">
                    <div class="form-group">
                        <label for="order_id">Enter order ID to delete:</label>
                        <input type="number" name="order_id" id="order_id" class="form-control" required>
                    </div>
                    <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                    <a href="delete_order_name.php" class="btn btn-secondary">Back</a>
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
