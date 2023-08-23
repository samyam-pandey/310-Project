<?php include('include/config.php'); ?>
<html>

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">    
    </head>

    <body>
        

        <!-- menu -->
        <!-- <?php include('templates/menu.php'); ?> -->

        <!-- content -->


        <div class="container">
            <div class="align-items-center" style="padding-top: 200px">

                <div class="d-flex justify-content-center">
                    <form action="" method="POST">

                        <h3>Admin Login</h3>

                        <div class="form-group">
                            <label for="exampleInputUsername1">Username</label>
                            <input type="username" name="username" class="form-control" id="exampleInputUsername1" aria-describedby="usernameHelp" placeholder="Enter Username" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                        </div>

                        <div class="d-flex justify-content-center" style="padding-top: 30px; padding-bottom: 30px" >
                            <button type="submit_admin_login" class="btn btn-primary" name="submit_admin_login">Submit</button>
                        </div>


                    </form>
                </div>

                
            </div>
        </div>
        
        <?php
            //Checking username and password
            if(isset($_POST['submit_admin_login'])) {
                $admin_route = "./admin_profile.php";
                $username = $_POST["username"];
                $password = $_POST["password"];
                $showAlert = false;
                
                $query = mysqli_query($sql, "SELECT * FROM admins WHERE username='{$username}' AND password='{$password}' ");
                $result = mysqli_fetch_assoc($query);
                if ($result==0) {
                    // username, password incorrect
                    echo " <div> <p> invalid credentials</p> </div> ";
                    $admin_route = "./admin_login.php";
                    header('Location: '.$admin_route);
                    die();
                }
                else {
                    // reroute to admin landing page
                    header('Location: '.$admin_route);
                    die(); // stop any other code from executing
                }
            }
            ?>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>