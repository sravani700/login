<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header('Location: providerlogin.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Provider Dashboard</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS for styling -->
</head>

<style>
/* Global Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    display: flex;
    height: 100vh;
    background-color:rgba(240, 228, 239, 0.9);
}

/* Sidebar Styles */
.sidebar {
    background-color: #2c3e50;
    color: white;
    width: 200px;
    padding: 20px;
    position: fixed;
    height: 100%;
    box-shadow: 4px 0px 10px rgba(0, 0, 0, 0.1);
}

.sidebar h2 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 24px;
}

.sidebar ul {
    list-style-type: none;
    padding: 0;
}

.sidebar ul li {
    margin: 10px 0;
}

.sidebar ul li a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    display: block;
    padding: 10px;
    border-radius: 4px;
}

.sidebar ul li a:hover {
    background-color:rgb(5, 128, 250);
}

/* Main Content Styles */
.main-content {
    margin-left: 250px;
    padding: 20px;
    flex-grow: 1;
    background-color:rgba(30, 168, 202, 0.62);
}

/* Dashboard Summary Section */
.dashboard-summary {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.dashboard-summary h2 {
    font-size: 24px;
    margin-bottom: 15px;
}

.dashboard-summary p {
    font-size: 16px;
}

/* Links and Buttons */
button {
    background-color: #2c3e50;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #34495e;
}
</style>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <h3>Provider Dashboard</h3>
    <ul>
        <li><a href="provider_dashboard.php">Dashboard</a></li>
        <li><a href="feedback.php">Customer Feedback</a></li>
        <li><a href="ratings.php">Ratings</a></li>
        <li><a href="reviews.php">Reviews</a></li>
        <li><a href="manage_services.php">Manage Services</a></li>
        <li><a href="manage_payments.php">Manage Payments</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

<!-- Main Content Area -->
<div class="main-content">
    <h1>Welcome, <?php echo htmlspecialchars($user_name); ?>!</h1>
    <p>You are logged in as a service provider.</p>

    <div class="dashboard-summary">
        <h2>Dashboard Overview</h2>
        <p>Here you can manage your feedback, ratings, reviews, services, and payments.</p>
        <button onclick="window.location.href='manage_services.php'">Manage Services</button>
        <button onclick="window.location.href='manage_payments.php'">Manage Payments</button>
    </div>
</div>

</body>
</html>
