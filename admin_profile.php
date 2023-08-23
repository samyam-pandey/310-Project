<?php include('include/config.php'); ?>

<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>

    <body>

        <!-- content -->
        <?php 

        if(isset($_POST['submit_add_user_db'])) {
            // adding user to database
            $username = $_POST['username'];
            $password = $_POST['password'];
            $first_name = $_POST['firstname'];
            $last_name = $_POST['lname'];
            
            $query = mysqli_query($sql, "SELECT MAX(user_id) FROM users");
            $row = mysqli_fetch_assoc($query);
            $user_id = $row['MAX(user_id)'] + 1;

            $query = "insert into users (user_id, username, password, first_name, last_name) values ({$user_id}, '{$username}', '{$password}', '{$first_name}', '{$last_name}');";
            mysqli_query($sql,$query);
        }

        // Construct the SQL query to retrieve all the attributes of the entity
        $result = mysqli_query($sql, "SELECT * FROM users");


        
        echo "<p> Users <p>";
        // Loop through the results and print out the attribute names
        if ($result = $sql->query("SELECT * FROM users")) {
        while ($row = $result->fetch_assoc()) {
            $username = $row['username'];
            $cus_id = $row['user_id'];

            // Create a form that submits to another PHP page using POST method
            echo "<form action='admin_user_orders.php' method='POST'>";
            // Use a hidden input field to send the 'id' value to the target PHP page
            echo "<input type='hidden' name='username' value='$username'>";
            echo "<input type='hidden' name='cus_id' value='$cus_id'>";
            // Wrap the attribute value in a submit button
            echo "<button type='submit' name='submit'>" . $row['username'] . "</button>";
            
            echo "</form>";
            
            // delete user
            echo "<form action='' method='POST'>";
            
            echo "<input type='hidden' name='cus_id' value='$cus_id'>";
            
            echo "<button type='submit_delete_user' name='submit_delete_user'> Delete user </button>";
            
            echo "</form>";

            // alter user name
            echo "<form action='admin_user.php' method='POST'>";
            
            echo "<input type='hidden' name='cus_id' value='$cus_id'>";
            
            echo "<button type='submit_alter_user' name='submit_alter_user'> Alter user </button>";
            
            echo "</form><br>";

        }

            // button for adding a user
            echo "<br><br><form action='' method='POST'>";

            echo "<button type='submit' name='submit_add_user'> Add a user </button>";
            
            echo "</form>";

        if (isset($_POST['submit_delete_user'])) {
            // deleting user from database and every bit of information 
            $id = $_POST['cus_id'];
            
            $get_query = "SELECT * FROM customers WHERE cus_id='$id';";
            $result = mysqli_query($sql,$get_query);
            $row = mysqli_fetch_assoc($result);
            $address_id = $row['address_id'];

            $delete_query = "DELETE FROM orders WHERE cus_id = '$id';";
            $result = mysqli_query($sql, $delete_query);
            
            $delete_query = "DELETE FROM customers WHERE cus_id = '$id';";
            $result = mysqli_query($sql, $delete_query);
            
            
            $delete_query = "DELETE FROM address WHERE address_id =$address_id;";
            $result = mysqli_query($sql, $delete_query);
            
            

            $delete_query = "DELETE FROM drivers WHERE driver_id = '$id';";
            $result = mysqli_query($sql, $delete_query);
    
            $delete_query = "DELETE FROM users WHERE user_id = '$id';";
            $result = mysqli_query($sql, $delete_query);
            // Execute the query
        }

        if (isset($_POST['submit_add_user'])) {
            // button after typing up new user information
            echo '<form action="" method="post">';
            echo '<label for="username">username: </label>';
            echo '<input type="text" id="username" name="username"><br><br> ';
            echo '<label for="password">password: </label>';
            echo '<input type="text" id="password" name="password"><br><br> ';
            echo '<label for="firstname">first name: </label>';
            echo '<input type="text" id="firstname" name="firstname"><br><br> ';
            echo '<label for="lname">lastname: </label>';
            echo '<input type="text" id="lname" name="lname"><br><br> <input type="submit" name="submit_add_user_db" value="submit">';
            echo '</form>';
        }
    }
        ?>


        

        
    </body>
</html>
