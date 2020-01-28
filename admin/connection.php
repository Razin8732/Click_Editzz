<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "click_edit";
// $_SESSION['uname'];
$loginsucess = '0';
$login_message = '0';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // echo "Connected successfully";
    // echo "<script>alert('connected suceesfully:');</script>";

}
?>