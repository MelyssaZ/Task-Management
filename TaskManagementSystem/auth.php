<?php
session_start();
require 'database.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username = ? AND password = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('ss', $username, $password);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0) {
    $_SESSION['username'] = $username;
    header('Location: welcome.php');
} else {
    echo "Invalid username or password.";
}
?>