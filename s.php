<?php
session_start();

// Include the database connection
include('connection.php');  // Ensure this is the correct path to connection.php

// Check if user is logged in, if not redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: homepage.php');
    exit();
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    // Insert new service into the database
    $query = "INSERT INTO services (name, category, price) VALUES ('$name', '$category', '$price')";
    
    if (mysqli_query($conn, $query)) {
        // Redirect back to the services management page after successful insertion
        header('Location: index.php#services');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Service</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Add New Service</h1>

    <!-- Service Form -->
    <form action="add_service.php" method="POST">
        <div>
            <label for="name">Service Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" required>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required>
        </div>
        <button type="submit">Add Service</button>
    </form>

    <br>
    <a href="index.php#services">Back to Services</a>
</body>
</html>
