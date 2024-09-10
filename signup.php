<?php
$showAlert = false;
$showError = "";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "partials/_db_connect.php";
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];

    $exists = false;
    if($pass == $confirm_pass && $exists == false) {
        $check = "SELECT * FROM `users` WHERE username = '$username'";
        $checkResult = mysqli_query($conn, $check); 
        $num = mysqli_num_rows($checkResult);
        if($num > 0) {
            $showError .= "User $username already exists!";
        } else {
            $sql = "INSERT INTO `users` (`username`, `password`) VALUES ('$username', '$pass')";
            $result = mysqli_query($conn, $sql);
            if($result) {
                $showAlert = true;
            }
        }
    } else {
       $showError .= "Password is not matched!";
    }
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SignUp | Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php require "partials/_nav.php"; ?>

    <?php
        if($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success</strong> Your account has been created you can login now!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    ?>

    <?php
        if($showError) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error</strong> '. $showError .'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    ?>

    <div class="container col-md-6 my-4">
        <h3 class="text-center">Please Sign-Up in my website</h3>
        <form action="/login_system/signup.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Usernames</label>
                <input type="email" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="mb-3">
                <label for="confirm_password"  class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                <div id="emailHelp" class="form-text">Make sure to type the same password.</div>
            </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>