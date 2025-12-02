<?php
$host = 'localhost';
$db = 'cms';
$user = 'root';
$pass = 'Asdf@123';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
