<?php
include 'connect.php';

if (isset($_POST['signUp'])) {
    // Retrieve form data
    $username = $_POST['username'];
    $contact_number = $_POST['contact_number']; // Corrected variable name
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password using password_hash()
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email already exists
    $checkEmail = $conn->prepare("SELECT * FROM users WHERE email=?");
    $checkEmail->bind_param("s", $email); // "s" is for string
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    if ($result->num_rows > 0) {
        echo "Email address already exists!";
    } else {
        // Use a prepared statement for inserting the data
        $insertQuery = $conn->prepare("INSERT INTO users (username, contact_number, email, password) 
                                       VALUES (?, ?, ?, ?)");
        $insertQuery->bind_param("ssss", $username, $contact_number, $email, $hashed_password); // "ssss" for four strings

        if ($insertQuery->execute()) {
            header("Location: index.php"); // Redirect to index.php
            exit();
        } else {
            echo "Error: " . $insertQuery->error;
        }
    }

    // Close the prepared statements
    $checkEmail->close();
    $insertQuery->close();
}

if (isset($_POST['signIn'])) {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to find user by email
    $sql = $conn->prepare("SELECT * FROM users WHERE email=?");
    $sql->bind_param("s", $email); // "s" is for string
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        // User found
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['email'] = $row['email'];
            header("Location: homepage.php");
            exit();
        } else {
            echo "Incorrect email or password";
        }
    } else {
        echo "Incorrect email or password";
    }

    // Close the prepared statement
    $sql->close();
}
?>
