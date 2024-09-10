<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "users";

try {
    $conn = mysqli_connect($host, $username, $password, $dbname);
    if (!$conn) {
        throw new Exception(mysqli_connect_error());
    } else {
        //echo "Success";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
