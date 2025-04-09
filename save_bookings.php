<?php
// Start the session to manage authentication (if applicable)
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = $_POST['name'];
    $service = $_POST['service'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $address = $_POST['address'];
    
    // Assuming the user is already logged in and you have customer_id in session
    $customer_id = $_SESSION['customer_id']; // This should be set when the user logs in
    
    // Insert the booking into the database
    $sql = "INSERT INTO bookings (customer_id, service_type, booking_date, booking_time, address, status) 
            VALUES ('$customer_id', '$service', '$date', '$time', '$address', 'Pending')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['message' => 'Your booking has been successfully submitted!']);
    } else {
        echo json_encode(['message' => 'Error: ' . $conn->error]);
    }
    
    // Close the connection
    $conn->close();
}
?>
