<?php
$login = false;
$showError = "";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "partials/_db_connect.php";
    $username = $_POST['username'];
    $pass = $_POST['password'];

    $exists = false;
    if(!empty($username) && !empty($pass)) {
        $sql = "SELECT * FROM `users` WHERE username = '$username' and password = '$pass'";
        $result = mysqli_query($conn, $sql);
        //var_dump($result); exit;
        $num = mysqli_num_rows($result);
        if($num == 1) {
            $login = true;
            session_start();
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['username'] = $username;

            header("location: welcome.php");
        } else {
            $showError .= "Invalid Credentials!";
        }
    } else {
       $showError .= "Username or password is missing!";
    }
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php require "partials/_nav.php"; ?>

    <?php
        if($login) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success</strong> Logged in successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    ?>

    <?php
        if($showError !== "") {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error</strong> '. $showError .'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    ?>

    <div class="container col-md-6 my-4">
        <h3 class="text-center">Login Form</h3>
        <form action="/login_system/login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Usernames</label>
                <input type="email" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
              <button type="submit" class="btn btn-primary">Login</button>
            </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>