<?php
session_start();
include('connect.php'); // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if all necessary POST fields are set
    if (isset($_POST['provider_name'], $_POST['provider_email'], $_POST['provider_phone'], $_POST['provider_address'], $_POST['provider_password'])) {
        
        // Get form data
        $provider_name = $_POST['provider_name'];
        $provider_email = $_POST['provider_email'];
        $provider_phone = $_POST['provider_phone'];
        $provider_address = $_POST['provider_address'];
        $password = $_POST['provider_password'];  // This is the password field
        
        // Hash the password using bcrypt
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Prepare SQL query to insert into the database
        $query = "INSERT INTO service_providers (provider_name, provider_email, provider_phone, provider_address, password) 
                  VALUES (?, ?, ?, ?, ?)";
        
        // Prepare and bind the SQL statement
        $stmt = $conn->prepare($query);
        
        // Bind the parameters: 'sssss' for 5 strings (provider_name, provider_email, provider_phone, provider_address, password)
        $stmt->bind_param("sssss", $provider_name, $provider_email, $provider_phone, $provider_address, $hashed_password);

        // Execute the query
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Registration successful']);
        } else {
            // In case of failure, output the error message
            echo json_encode(['success' => false, 'message' => 'Registration failed: ' . $stmt->error]);
        }
    } else {
        // If any required field is missing
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
    }
}
?>
