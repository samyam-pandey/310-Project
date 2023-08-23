<!-- 


    This file displays the orders with their associated driver, store, and reviews. (SELECT)

    Allows customer to leave reviews for their driver (INSERT)

    Allows customer to edit their reviews (UPDATE)

    Allows customer to delete their reviews (DELETE)

    @author Soohwan Kim -> All sections
-->

<?php include('include/config.php'); ?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>

    <body>
        
        <!-- header -->
        <?php include('customer_header.php'); ?>

        <?php
            // Getting user information from session
            $user_id = $_GET["user_id"];
            $query = mysqli_query($sql, "SELECT * FROM users WHERE user_id='{$user_id}'");

            $row = mysqli_fetch_assoc($query);
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $username = $row['username'];
            session_start();

            // $user_id = $_SESSION['user_id'];
            // $first_name = $_SESSION['first_name'];
            // $last_name = $_SESSION['last_name'];
        ?>


        <?php
            // Getting all orders from user
            $query = mysqli_query($sql, "SELECT * FROM orders WHERE cus_id='{$user_id}'");
            $orders = array();
            while ($row = mysqli_fetch_assoc($query)) {
                $order = array();
                $driver_id = $row['driver_id'];
                $store_id = $row['store_id'];
                $date = $row['date'];

                // Getting drivers for each order
                $subQuery = mysqli_query($sql, "SELECT * FROM users WHERE user_id='{$driver_id}'");
                $subRow = mysqli_fetch_assoc($subQuery);
                $driver_first_name = $subRow['first_name'];
                $driver_last_name = $subRow['last_name'];

                // Getting store information for each order
                $subQuery = mysqli_query($sql, "SELECT * FROM stores WHERE store_id='{$store_id}'");
                $store_address_id = mysqli_fetch_assoc($subQuery)['address_id'];

                $subQuery = mysqli_query($sql, "SELECT * FROM address WHERE address_id='{$store_address_id}'");
                $subRow = mysqli_fetch_assoc($subQuery);
                $store_st_name = $subRow['st_name'];
                $store_city = $subRow['city'];
                $store_state = $subRow['state'];
                $store_zipcode = $subRow['zipcode'];

                // Getting reviews for the driver
                $reviews = array();
                $subQuery = mysqli_query($sql, "SELECT * FROM reviews WHERE driver_id='{$driver_id}'");
                while($subRow = mysqli_fetch_assoc($subQuery)) {
                    $review = array();
                    $review_text = $subRow['review'];
                    $cus_id = $subRow['cus_id'];
                    $subSubQuery = mysqli_query($sql, "SELECT username FROM users WHERE user_id = '{$cus_id}'");
                    $subSubRow = mysqli_fetch_assoc($subSubQuery);
                    $cus_username = $subSubRow['username'];
                    $review_id = $subRow['review_id'];
                    array_push($review, $review_text, $cus_username, $review_id, $cus_id);
                    array_push($reviews, $review);
                }

                array_push($order, $driver_id, $store_id, $date, $driver_first_name, $driver_last_name, $store_st_name, $store_city, $store_state, $store_zipcode, $reviews);
                array_push($orders, $order);
            };

        ?>


        <?php 
        /*
            Index
            0: driver id
            1: store id
            2: date
            3: driver first name
            4: driver last name
            5: store street name
            6: store city
            7: store state
            8: store zipcode
            9: review : [review text, cus username, review_id, cus_id]
        */
            // Renders list of orders of the customer.
            function renderOrders($orders, $review_id) {
                $str = '';
                foreach ($orders as $order) {
                    $str = $str.
                    "<div class='row' style='padding-top: 30px;'>
                        <div class='col-md-8'>
                            <div>
                                <h3>Order from: {$order[5]} {$order[6]}, {$order[7]} {$order[8]} on {$order[2]}</h3>
                            </div>

                            <div>

                                <div class='col-md-4'>
                                    <h4>Driver</h4>
                                </div>

                                <div class='col-md-6'>
                                    <h5>{$order[3]} {$order[4]}</h5>
                                </div>

                            </div>

                            <div class='col'>

                                <div class=''>
                                    <h5>Reviews</h5>
                                </div>

                                ".renderReviews($order[9], $review_id)."
                                <form action='' method='post'>
                                    <input type='hidden' name='action' value='submit'/>
                                    <input type='hidden' value={$order[0]} name='driver_id'/>
                                    <input type='text' placeholder='Leave a review' name='review' />
                                    <button type='submit'>Submit</button>
                                </form>
                            </div>

                        </div>
                    </div>";
                };
                return $str;
            };

            // Renders list of reviews for the driver
            function renderReviews($reviews, $review_id) {
                $user_id = $_GET['user_id'];
                $str = '';
                foreach ($reviews as $review) {
                    if ($review[3] != $user_id) {
                        $str = $str."
                            <div>
                                From user #{$review[1]}
                            </div>
                            <div class='d-flex align-items-start'>
                                &nbsp;&nbsp;&nbsp;'{$review[0]}' 
                            </div>";
                    } else if ($review[2] == $review_id) {
                        $str = $str."
                        <div>
                            From user #{$review[1]}
                        </div>
                        <div class='d-flex align-items-start'>
                            <form action='' method='post'>
                                <input type='hidden' name='editSubmit' value='submit'/>
                                <input type='hidden' name='review_id' value={$review[2]}/>
                                <input type='text' placeholder='Leave a review' name='review' value={$review[0]}/>
                                <button type='submit'>Done</button>
                            </form>
                            <form action='' method='post'>
                                <input type='hidden' name='cancel' value='submit'/>
                                <button type='submit'>Cancel</button>
                            </form>
                        </div>";
                    } else {
                        $str = $str."
                            <div>
                                From user #{$review[1]}
                            </div>
                            <div class='d-flex align-items-start'>
                                &nbsp;&nbsp;&nbsp;'{$review[0]}' 
                                <form action='' method='post'>
                                    <input type='hidden' name='delete' value='submit'/>
                                    <input type='hidden' name='review_id' value={$review[2]}/>
                                    <button type='submit' class='btn btn-danger'>x</button> 
                                </form>
                                <form action='' method='post'>
                                    <input type='hidden' name='edit' value='submit'/>
                                    <input type='hidden' name='review_id' value={$review[2]}/>
                                    <button type='submit' class='btn btn-danger'>Edit</button> 
                                </form>
                            </div>";
                    }
                };
                return $str;
            };

            ?>

        


        <?php     
            // When a review is submitted.
            // Inserts customer review.
            if (isset($_POST['action'])) {
                $reviewSubmitted = $_POST['review'];
                $driver_id = $_POST['driver_id'];

                // Get the last review_id and set next review_id
                $query = mysqli_query($sql, "SELECT MAX(review_id) FROM reviews");
                $row = mysqli_fetch_assoc($query);
                $review_id = $row['MAX(review_id)'] + 1;

                $query = mysqli_query($sql, "INSERT INTO reviews (review_id, driver_id, cus_id, review) VALUES ('{$review_id}', '{$driver_id}', '{$user_id}', '{$reviewSubmitted}')");

                header("Location: review.php?user_id=$user_id");
            };
        
        ?>

        <?php 
            // When a review is deleted.
            // Deletes customer review
            if (isset($_POST['delete'])) {
                $review_id = $_POST['review_id'];

                $query = mysqli_query($sql, "DELETE FROM reviews WHERE review_id = '{$review_id}'");

                header("Location: review.php?user_id=$user_id");
            }
        ?>

        <?php
            // When edit button is clicked.
            // Switches the reivew text into input field.
            if (isset($_POST['edit'])) {
                $_SESSION['editting_review'] = intval($_POST['review_id']);
                header("Location: review.php?user_id=$user_id");
             }
        ?>

        <?php
            // When edited review is submitted.
            // Updates customer review
            if (isset($_POST['editSubmit'])) {
                $review_id = intval($_POST['review_id']);
                $review = $_POST['review'];

                $query = mysqli_query($sql, "UPDATE reviews SET review='{$review}' WHERE review_id = '{$review_id}'");
                $_SESSION['editting_review'] = -1;
                header("Location: review.php?user_id=$user_id");
            }
        ?>

        <?php
            // When cancel button is clicked
            // Switches all edit input field back to review text.
            if (isset($_POST['cancel'])) {
                $_SESSION['editting_review'] = -1;
                header("Location: review.php?user_id=$user_id");
            }
        ?>

        <div class="container emp-profile" style= "padding-top: 100px;">
                <div class="row">

                    <div class="col-md-6">

                        <div class="profile-head">
                            <h3> <?php echo $first_name ?> <?php echo $last_name ?> </h3>
                        </div>

                    </div>

                </div>
                <?php echo renderOrders($orders, $_SESSION['editting_review']);?>
        </div>

        
    </body>
</html>