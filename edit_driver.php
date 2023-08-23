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


            if($_SERVER["REQUEST_METHOD"] == "POST"){
                //retrieve form data
                $first_name = $_POST["first_name"];
                $last_name = $_POST["last_name"];
                $username = $_POST["username"];
                $password = $_POST["password"];


                // update user's names
                $query2 = mysqli_query($sql, "UPDATE users SET first_name='{$first_name}', last_name='{$last_name}', username='{$username}', password='{$password}' WHERE user_id='{$user_id}'");

                header("Location: driver_profile.php?user_id=$user_id");
                exit;
            }

        ?>



        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Edit</h4>
                    </div>

                        <form method="POST" action="edit_driver.php?user_id=<?php echo $user_id; ?>">

                            <div class="row mt-3">
                                <div class="col-md-6"><label class="labels">Name</label><input type="text" class="form-control" placeholder="first name" value="" name="first_name"></div>
                                <div class="col-md-6"><label class="labels">Surname</label><input type="text" class="form-control" value="" placeholder="surname" name="last_name"></div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6"><label class="labels">Username</label><input type="text" class="form-control" placeholder="first name" value="" name="username"></div>
                                <div class="col-md-6"><label class="labels">Password</label><input type="password" class="form-control" value="" placeholder="surname" name="password"></div>
                            </div>

                            <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>

        
    </body>
</html>