<?php
session_start();

// Include the database connection file
include('connect.php'); // Ensure this path is correct to your connection file

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: adminlogin.php');
    exit();
}

// Fetch total counts dynamically for the dashboard summary
$total_services = mysqli_query($conn, "SELECT COUNT(*) AS total FROM services");
$total_customers = mysqli_query($conn, "SELECT COUNT(*) AS total FROM customers"); // Ensure table name 'customers' is correct
$total_bookings = mysqli_query($conn, "SELECT COUNT(*) AS total FROM bookings");

// Check for query execution errors
if (!$total_services || !$total_customers || !$total_bookings) {
    die("Database query failed: " . mysqli_error($conn));
}

$services_count = mysqli_fetch_assoc($total_services)['total'];
$users_count = mysqli_fetch_assoc($total_customers)['total'];  // You can also use $customers_count if you prefer
$bookings_count = mysqli_fetch_assoc($total_bookings)['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Home Services Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    /* Basic reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body and main font */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    display: flex;
}

/* Sidebar styles */
.sidebar {
    width: 250px;
    background-color:rgba(91, 145, 161, 0.92);
    color: white;
    height: 100vh;
    padding: 20px;
    position: fixed;
}

.sidebar h2 {
    color: white;
    text-align: center;
    margin-bottom: 40px;
}

.sidebar ul {
    list-style-type: none;
}

.sidebar ul li {
    margin-bottom: 20px;
}

.sidebar ul li a {
    color: white;
    text-decoration: none;
    font-size: 16px;
    display: block;
    padding: 10px;
    border-radius: 4px;
}

.sidebar ul li a:hover {
    background-color: #34495e;
}

/* Content area styles */
.content {
    margin-left: 250px;
    padding: 20px;
    width: calc(100% - 250px);
}

/* Header style */
h1 {
    color:rgba(31, 43, 214, 0.78);
    margin-bottom: 20px;
}

/* Dashboard Summary Section */
#dashboard {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

#dashboard h2 {
    margin-bottom: 20px;
    color:rgba(12, 128, 243, 0.93);
}

.dashboard-summary {
    display: flex;
    justify-content: space-around;
    gap: 20px;
}

.summary-box {
    background-color:rgb(93, 204, 231);
    padding: 20px;
    border-radius: 8px;
    width: 30%;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.summary-box h3 {
    font-size: 18px;
    color:rgb(26, 24, 25);
    margin-bottom: 10px;
}

.summary-box p {
    font-size: 24px;
    font-weight: bold;
    color:rgb(231, 76, 60);
}

/* Footer */
footer {
    text-align: center;
    font-size: 14px;
    color: #7f8c8d;
    margin-top: 30px;
}

/* Responsive design */
@media (max-width: 768px) {
    .sidebar {
        width: 200px;
    }
    
    .content {
        margin-left: 200px;
        width: calc(100% - 200px);
    }

    .dashboard-summary {
        flex-direction: column;
        align-items: center;
    }

    .summary-box {
        width: 80%;
        margin-bottom: 20px;
    }
}

@media (max-width: 480px) {
    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
    }

    .content {
        margin-left: 0;
        width: 100%;
    }

    .dashboard-summary {
        flex-direction: column;
        align-items: center;
    }

    .summary-box {
        width: 90%;
    }
}

</style>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="admin_dashboard.php">Dashboard</a></li>
            <li><a href="manage_services.php">Manage Services</a></li>
            <li><a href="manage_providers.php">Manage Providers</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="view_bookings.php">View Bookings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>Welcome spandana</h1>

        <!-- Dashboard Summary -->
        <section id="dashboard" class="section">
            <h2>Dashboard Summary</h2>
            <div class="dashboard-summary">
                <div class="summary-box">
                    <h3>Total Services</h3>
                    <p><?php echo $services_count; ?></p>
                </div>
                <div class="summary-box">
                    <h3>Total Customers</h3>
                    <p><?php echo $users_count; ?></p>
                </div>
                <div class="summary-box">
                    <h3>Total Bookings</h3>
                    <p><?php echo $bookings_count; ?></p>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
