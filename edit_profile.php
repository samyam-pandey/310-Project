<?php include('include/config.php'); ?>
<html>
   <head>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   </head>


   <body>
      
       <!-- header -->
       <?php include('customer_header.php'); ?>


       <!-- content -->
       <?php
           session_start();
           $user_id = $_SESSION["user_id"];


           if($_SERVER["REQUEST_METHOD"] == "POST"){
               // Retrieve form data
               $username = $_POST["username"];
               $password = $_POST["password"];
               $first_name = $_POST["first_name"];
               $last_name = $_POST["last_name"];
               $street_name = $_POST["street_name"];
               $apt_num = $_POST["apt_num"];
               $zipcode = $_POST["zipcode"];
               $city = $_POST["city"];
               $state = $_POST["state"];

               //get user's original address to update it
               $query = mysqli_query($sql, "SELECT * from customers WHERE cus_id='{$user_id}'");
               $row = mysqli_fetch_assoc($query);
               
               
               $address_id = $row["address_id"];
               
               
               
               //update user's original address
               $query = mysqli_query($sql, "UPDATE address SET st_name='{$street_name}', zipcode='{$zipcode}', city='{$city}', state_name='{$state}', apt_num='{$apt_num}' WHERE address_id='{$address_id}'");
               
               // update user's names
               $query2 = mysqli_query($sql, "UPDATE users SET first_name='{$first_name}', last_name='{$last_name}', username='{$username}', password='{$password}' WHERE user_id='{$user_id}'");
               
               header("Location: customer_profile.php?user_id=$user_id");
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


                       <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">


                           <div class="row mt-3">
                               <div class="col-md-6"><label class="labels">Username</label><input type="text" class="form-control" placeholder="username" value="" name="username"></div>
                               <div class="col-md-6"><label class="labels">Password</label><input type="password" class="form-control" value="" placeholder="password"  name="password"></div>
                           </div>


                           <div class="row mt-3">
                               <div class="col-md-6"><label class="labels">Name</label><input type="text" class="form-control" placeholder="first name" value="" name="first_name"></div>
                               <div class="col-md-6"><label class="labels">Surname</label><input type="text" class="form-control" value="" placeholder="surname" name="last_name"></div>
                           </div>


                           <div class="row mt-3">
                               <div class="col-md-12"><label class="labels">Address Line 1</label><input type="text" class="form-control" placeholder="enter address line 1" value="" name="street_name"></div>
                               <div class="col-md-12"><label class="labels">Address Line 2</label><input type="text" class="form-control" placeholder="enter address line 2" value="" name="apt_num"></div>
                               <div class="col-md-12"><label class="labels">Zipcode</label><input type="text" class="form-control" placeholder="enter address line 2" value="" name="zipcode"></div>
                           </div>


                           <div class="row mt-3">
                               <div class="col-md-6"><label class="labels">City</label><input type="text" class="form-control" placeholder="city" value="" name="city"></div>
                               <div class="col-md-6"><label class="labels">State</label><input type="text" class="form-control" value="" placeholder="state" name="state"></div>
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



