<?php include('include/config.php'); ?>

<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>

    <body>

        <!-- content -->
        <?php 
        $cus_id = $_POST["cus_id"];
        
        if (isset($_POST['submit_first_name'])) {
            $fname =$_POST['fname'];
            $query = "UPDATE users SET first_name = '{$fname}' WHERE user_id ={$cus_id};";
            mysqli_query($sql, $query);
        }

        if (isset($_POST['submit_last_name'])) {
            $lname =$_POST['lname'];
            $query = "UPDATE users SET last_name = '{$lname}' WHERE user_id ={$cus_id};";
            mysqli_query($sql, $query);
        }



        $query = "SELECT * FROM users WHERE user_id = '{$cus_id}';";

        // Construct the SQL query to retrieve all the attributes of the entity
        $result = mysqli_query($sql, $query);

        // Check if there were any errors executing the query
        if (!$result) {
            echo "error description: " . $sql -> error;
        }


        
        // Loop through the results and print out the attribute names
        if ($result = $sql->query($query)) {
        while ($result && $row = $result->fetch_assoc()) {
            $username = $row['username'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            // Create a form that deletes the entry from the database when submitted
            echo "<p>Username: " . $username . "</p>";
            echo "<p>First Name: " . $first_name . "</p>";
            echo "<p>Second Name: " . $last_name . "</p>";

            
            echo "<form action='' method='post'>";
            // Use a hidden input field to send the 'id' value to the target PHP page
            echo "<input type='hidden' name='cus_id' value='$cus_id'>";
            // Wrap the attribute value in a delete button
            echo "<button type='submit' name='submit_change_firstname' > Change first name  </button>";
            echo "</form>";

            echo "<form action='' method='post'>";
            // Use a hidden input field to send the 'id' value to the target PHP page
            echo "<input type='hidden' name='cus_id' value='$cus_id'>";
            // Wrap the attribute value in a delete button
            echo "<button type='submit' name='submit_change_lastname' > Change last name  </button>";
            echo "</form>";
        }
        }
    
        if (isset($_POST['submit_change_firstname'])) {
            echo '<form action="" method="post">';
            echo "<input type='hidden' name='cus_id' value='$cus_id'>";
            echo '<label for="fname">First name:</label>';
            echo '<input type="text" id="fname" name="fname"><br><br> <input type="submit" name="submit_first_name" value="submit">';
            echo '</form>';
        }
        

        if (isset($_POST['submit_change_lastname'])) {
            echo '<form action="" method="post">';
            echo "<input type='hidden' name='cus_id' value='$cus_id'>";
            echo '<label for="lname">Last name:</label>';
            echo '<input type="text" id="lname" name="lname"><br><br> <input type="submit" name="submit_last_name" value="submit">';
            echo '</form>';
        }

        
        ?>
    </body>
</html>