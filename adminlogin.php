<!-- login.php -->
<?php
session_start();

// Dummy admin credentials (You can replace this with database credentials in real-world applications)
$admin_username = 'admin';
$admin_password = 'password123';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the provided username and password match the dummy credentials
    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['loggedin'] = true;
        header('Location: admin_dashboard.php');  // Redirect to dashboard
        exit();
    } else {
        echo '<p style="color: red;">Invalid username or password!</p>';
    }
}
?>



