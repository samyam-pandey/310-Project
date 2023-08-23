<?php include('include/config.php'); ?>

<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>

    <body>

        <!-- content -->
        <?php 
        
        $username = $_POST["username"];
        $cus_id = $_POST["cus_id"];
        $query = "SELECT * FROM orders WHERE cus_id = '{$cus_id}';";

        // Construct the SQL query to retrieve all the attributes of the entity
        $result = mysqli_query($sql, $query);

        // Check if there were any errors executing the query
        if (!$result) {
            echo "error description: " . $sql -> error;
        }


        if (isset($_POST['submit_delete_order'])) {
            // Retrieve the 'id' value from the hidden input field
            // Construct the SQL query to delete the corresponding entry from the database
            $delete_query = "DELETE FROM orders WHERE cus_id = '$cus_id';";
            // Execute the query
            $result = mysqli_query($sql, $delete_query);
        }

        // Loop through the results and print out the attribute names
        if ($result = $sql->query($query)) {
        while ($result && $row = $result->fetch_assoc()) {
            $order_id = $row['order_id'];
            // Create a form that deletes the entry from the database when submitted
            echo "<form action='' method='post'>";
            // Use a hidden input field to send the 'id' value to the target PHP page
            echo "<input type='hidden' name='order_id' value='$order_id'>";
            echo "<input type='hidden' name='username' value='$username'>";
            echo "<input type='hidden' name='cus_id' value='$cus_id'>";
            // Wrap the attribute value in a delete button
            echo "<button type='submit' name='submit_delete_order' onclick='return confirm(\"Are you sure you want to delete this entry?\")'>Delete Order: " . $row['list'] . ", Time: " . $row['time'] . ", Date: " . $row['date'] . "</button>";
            echo "</form>";
        }
        }

        
        ?>
        

        
    </body>
</html>