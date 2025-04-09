<?php
session_start();
include('connect.php'); // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if 'provider_email' and 'password' are set in the POST data
    if (isset($_POST['provider_email']) && isset($_POST['password'])) {
        $provider_email = $_POST['provider_email']; // The email field from the form
        $password = $_POST['password']; // The password field from the form (name="password")

        // Check if the email exists in the database
        $query = "SELECT * FROM service_providers WHERE provider_email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $provider_email);  // 's' for string (email)
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User exists, fetch user data
            $user = $result->fetch_assoc();

            // Verify the password using password_verify()
            if (password_verify($password, $user['password'])) {
                // Set session variables on successful login
                $_SESSION['user_id'] = $user['id']; // Store user ID in session
                $_SESSION['user_name'] = $user['provider_name']; // Store provider name in session
                
                // Redirect to the service provider dashboard
                header('Location: providerdashboard.php'); // Replace with your actual dashboard page
                exit; // Make sure no other code runs after the redirect
            } else {
                // Invalid password
                echo json_encode(['success' => false, 'message' => 'Invalid password']);
            }
        } else {
            // Account not found
            echo json_encode(['success' => false, 'message' => 'Account not found']);
        }
    } else {
        // One or both fields are missing
        echo json_encode(['success' => false, 'message' => 'Email or Password not provided']);
    }
}
?>
