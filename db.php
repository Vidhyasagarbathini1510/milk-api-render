<?php
$host = "localhost";
$user = "root";       // change if hosting
$pass = "Chintu@123";           // change if hosting
$db   = "milk_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    echo json_encode([
        "status" => false,
        "message" => "Database connection failed"
    ]);
    exit;
}
?>
