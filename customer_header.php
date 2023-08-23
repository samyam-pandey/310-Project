<?php include('include/config.php'); ?>

<header>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>

    <?php $user_id = $_GET["user_id"]; ?>

    <body>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

        <ul class="nav nav-pills nav-justified">
        <li class="nav-item">
            <a class="nav-link" href="customer_profile.php?user_id=<?php echo $user_id; ?>">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="order.php?user_id=<?php echo $user_id; ?>">Order</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="review.php?user_id=<?php echo $user_id; ?>">Reviews</a>
        </li>
        </ul>

    </body>

</header>