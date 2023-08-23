<?php include('include/config.php'); ?>
<html>

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">    
    </head>

    <body>
        

        <!-- menu -->
        <?php include('templates/menu.php'); ?>

        <!-- content -->
        <?php
    
            if($_SERVER["REQUEST_METHOD"] == "POST"){

                //retrieve form data
                $username = $_POST["username"];
                $password = $_POST["password"];
                
                $query = mysqli_query($sql, "SELECT * FROM users WHERE username='{$username}' AND password='{$password}' ");
    
                $row = mysqli_fetch_assoc($query);
    
                $user_id = $row['user_id'];
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];

                session_start();
                $_SESSION['user_id'] = $user_id;
                header("Location: driver_profile.php?user_id=$user_id");
                exit;
            }

        ?>


        <div class="container">
            <div class="align-items-center" style="padding-top: 200px">

                <div class="d-flex justify-content-center">
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">

                        <h3>Driver Login</h3>

                        <div class="form-group">
                            <label for="exampleInputUsername1">Username</label>
                            <input type="username" name="username" class="form-control" id="exampleInputUsername1" aria-describedby="usernameHelp" placeholder="Enter Username">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>

                        <div class="d-flex justify-content-center" style="padding-top: 30px; padding-bottom: 30px" >
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>


                    </form>
                </div>

            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>