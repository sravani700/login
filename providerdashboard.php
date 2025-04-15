<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_name']) || !isset($_SESSION['user_id'])) {
    header('Location: providerlogin.php');
    exit; // Stop further execution
}

$name = $_SESSION['user_name'];
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Provider Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Reset and base styles */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    min-height: 100vh;
    background: linear-gradient(120deg, #d4fc79, #96e6a1);
    animation: fadeInBody 1s ease-in-out;
    overflow-x: hidden;
}

@keyframes fadeInBody {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Sidebar styles */
.sidebar {
    background-color: #2c3e50;
    color: white;
    width: 220px;
    padding: 20px;
    position: fixed;
    height: 100%;
    box-shadow: 4px 0px 10px rgba(0, 0, 0, 0.2);
    animation: slideInLeft 0.6s ease-out;
}

@keyframes slideInLeft {
    from { transform: translateX(-100%); }
    to { transform: translateX(0); }
}

.sidebar h3 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 24px;
    animation: fadeIn 1s ease-out;
}

.sidebar ul {
    list-style: none;
}

.sidebar ul li {
    margin: 20px 0;
}

.sidebar ul li a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    padding: 12px;
    display: block;
    border-radius: 6px;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.sidebar ul li a:hover {
    background-color: #3498db;
    transform: scale(1.05);
}

/* Main content styles */
.main-content {
    margin-left: 240px;
    padding: 40px;
    flex-grow: 1;
    animation: fadeInMain 1.2s ease-in-out;
}

@keyframes fadeInMain {
    from { opacity: 0; transform: scale(0.98); }
    to { opacity: 1; transform: scale(1); }
}

.main-content h1 {
    font-size: 32px;
    color: #2c3e50;
    margin-bottom: 20px;
    animation: fadeIn 1.5s ease-out;
}

/* Dashboard summary */
.dashboard-summary {
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    margin-bottom: 30px;
    animation: fadeIn 1s ease-in-out;
}

.dashboard-summary h2 {
    font-size: 26px;
    color: #34495e;
    margin-bottom: 10px;
}

/* Table styles */
table {
    width: 100%;
    border-collapse: collapse;
    background-color: white;
    border-radius: 10px;
    overflow: hidden;
    animation: fadeInTable 1s ease-in-out;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

@keyframes fadeInTable {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

th, td {
    padding: 14px;
    text-align: left;
    border-bottom: 1px solid #ddd;
    transition: background-color 0.2s ease-in, transform 0.2s ease;
}

th {
    background-color: #2c3e50;
    color: white;
    font-weight: 600;
}

tr:hover td {
    background-color: #f9f9f9;
    transform: translateX(5px);
}

tr:nth-child(even) {
    background-color: #f5f5f5;
}

/* Form elements */
form select {
    padding: 8px;
    margin-top: 5px;
    border-radius: 4px;
    border: 1px solid #ddd;
    transition: border-color 0.3s ease;
}

form select:focus {
    border-color: #3498db;
    box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
}

form button {
    background-color: #2c3e50;
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 10px;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

form button:hover {
    background-color: #34495e;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

/* FadeIn reusable animation */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Responsive adjustments */
@media screen and (max-width: 768px) {
    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
    }

    .main-content {
        margin-left: 0;
        padding: 20px;
    }

    table, th, td {
        font-size: 14px;
    }

    .main-content h1 {
        font-size: 24px;
    }

    .dashboard-summary h2 {
        font-size: 20px;
    }
}

        /* Your full CSS remains unchanged here */
        /* For brevity, I’ll skip re-pasting the entire CSS you already wrote — it's excellent */
    </style>
</head>
<body>

<div class="sidebar">
    <h3>Provider Panel</h3>
    <ul>
        <li><a href="providerdashboard.php">Dashboard</a></li>
        <li><a href="feedback.php">Customer Feedback</a></li>
        <li><a href="ratings.php">Ratings</a></li>
        <li><a href="reviews.php">Reviews</a></li>
        <li><a href="manage_services.php">Manage Services</a></li>
        <li><a href="manage_payments.php">Manage Payments</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

<div class="main-content">
    <!-- Welcome message -->
    <h1>Welcome, <?php echo htmlspecialchars($name); ?> <i class="fas fa-user-circle"></i></h1>

    <div class="dashboard-summary">
        <h2>Dashboard Overview</h2>
    </div>

    <?php
    // Database connection
    $conn = new mysqli("localhost", "root", "", "login");

    if ($conn->connect_error) {
        echo "<p style='color: red;'>Connection failed: " . htmlspecialchars($conn->connect_error) . "</p>";
    } else {
        $stmt = $conn->prepare("
        SELECT u.username, b.id AS booking_id, b.service, b.created_at, b.status 
        FROM bookings b
        JOIN users u ON b.customer_id = u.id 
        WHERE b.provider_id = ?
    ");
    

        if ($stmt) {
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>Customer Name</th>
                            <th>Service Booked</th>
                            <th>Booking Date</th>
                            <th>Status</th>
                            <th>Update Status</th>
                        </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['username']) . "</td>
                            <td>" . htmlspecialchars($row['service']) . "</td>
                            <td>" . htmlspecialchars($row['created_at']) . "</td>
                            <td>" . htmlspecialchars($row['status']) . "</td>
                            <td>
                                <form action='update_status.php' method='POST'>
                                    <input type='hidden' name='booking_id' value='" . (int)$row['booking_id'] . "'>
                                    <select name='status'>
                                        <option value='pending'" . ($row['status'] == 'pending' ? ' selected' : '') . ">Pending</option>
                                        <option value='confirmed'" . ($row['status'] == 'confirmed' ? ' selected' : '') . ">Confirmed</option>
                                        <option value='completed'" . ($row['status'] == 'completed' ? ' selected' : '') . ">Completed</option>
                                        <option value='cancelled'" . ($row['status'] == 'cancelled' ? ' selected' : '') . ">Cancelled</option>
                                    </select>
                                    <button type='submit'>Update</button>
                                </form>
                            </td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No bookings found.</p>";
            }

            $stmt->close();
        } else {
            echo "<p style='color: red;'>Failed to prepare statement: " . htmlspecialchars($conn->error) . "</p>";
        }

        $conn->close();
    }
    ?>
</div>

</body>
</html>
