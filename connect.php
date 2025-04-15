<?php
// Correct connection setup with the right parameters
$host = "localhost";
$user = "root";        // MySQL username (XAMPP default is 'root')
$password = "";        // MySQL password (XAMPP default is empty string)
$database = "login";   // Your database name

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
