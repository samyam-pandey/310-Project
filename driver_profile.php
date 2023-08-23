<?php include('include/config.php'); ?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>

    <body>
        
        <!-- header -->
        <?php include('driver_header.php'); ?>

        <!-- content -->
        <?php
            $user_id = $_GET["user_id"];
            $query = mysqli_query($sql, "SELECT * FROM users WHERE user_id='{$user_id}'");

            $row = mysqli_fetch_assoc($query);
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
        ?>

        <?php
            $query = mysqli_query($sql, " SELECT COUNT(order_id) FROM orders WHERE driver_id='{$user_id}'");
            $row = mysqli_fetch_array($query);
            $count = $row[0];
        ?>
        <?php
            //if delete button
            if(isset($_POST["delete"])){               
                //delete all associated order entries
                $query = mysqli_query($sql, "DELETE FROM orders WHERE driver_id='{$user_id}'");  
                
                //delete from drivers
                $query = mysqli_query($sql, "DELETE FROM drivers WHERE driver_id='{$user_id}'");

                //delete from users
                $query = mysqli_query($sql, "DELETE FROM users WHERE user_id='{$user_id}'");

                header("Location: index.php");
                exit;
            }
        ?>

        <div class="container emp-profile" style= "padding-top: 100px;">
            <form method="post">

                <div class="row">

                    <div class="col-md-6">

                        <div class="profile-head">
                            <h5> <?php echo $first_name ?> <?php echo $last_name ?> </h5>
                        </div>

                    </div>

                </div>
                
                <div class="row" style="padding-top: 30px;">

                    <div class="col-md-8">

                        <div class="row">

                            <div class="col-md-4">
                                <label>Name</label>
                            </div>

                            <div class="col-md-6">
                                <p> <?php echo $first_name ?> <?php echo $last_name ?>  </p>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <label># of Orders</label>
                            </div>

                            <div class="col-md-6">
                                <p> <?php echo $count ?> </p>
                            </div>

                        </div>

                    </div>
                    
                </div>

                <div class="row" style= "padding-top: 20px;">
                    <div class="col-md-2">
                        <a class="btn btn-sm" href="edit_driver.php?user_id=<?php echo $user_id; ?>">Edit Profile</a>

                        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
		                    <input type="submit" name="delete" value="Delete Account">
	                    </form>
                    </div>
                </div>

            </form>           
        </div>

        
    </body>
</html>