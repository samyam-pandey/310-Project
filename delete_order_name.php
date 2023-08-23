<!-- Samyam Pandey worked on this -->
<!-- This is the page that comes up after clicking submit in the order.php file. 
In this page it just asks the user if they want to delete an order that was made and if they do. 
It asks them to type in  their username. In this file it uses select to select the user id corresponding to the username the user typed. -->

<!-- this runs after the user clicks on submit and gets the username, user_id -->
<?php
include('include/config.php');
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $query = mysqli_query($sql, "SELECT user_id FROM users WHERE username='$username'");
    $row = mysqli_fetch_assoc($query);
    $user_id = $row['user_id'];
    header('Location: customer_delete.php?user_id='.$user_id);
    exit();
}

function renderBackBtn() {
    "<div class='container mt-5'>
        <div class='row'>
            <div class='col-md-6 offset-md-3'>
                <a href='order.php?user_id={$user_id}' class='btn btn-secondary'>Back</a>
            </div>
        </div>
    </div>";

    return $str;

}
?>
<!-- Html code to create a box asking to enter a username -->
<!DOCTYPE html>
<html>
<head>
    <title>Delete Items </title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 mt-5">
                <h3 class="text-center mb-4">If you want to delete an order </h3>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <a href="order.php?user_id=<?php echo $user_id; ?>" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
