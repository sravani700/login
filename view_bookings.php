<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the bookings from the database
$sql = "SELECT * FROM bookings ORDER BY id DESC"; // Fetch bookings
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings - Home Services</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Body and General Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

       

        

        /* Main Content Styling */
        .container {
            margin: 20px auto;
            max-width: 1200px;
            padding: 20px;
        }

        h2 {
            color: #333;
            font-size: 28px;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Table Styling */
        .table-container {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th,
        .table-container td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .table-container th {
            background-color: #333;
            color: #fff;
        }

        .table-container tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table-container tr:hover {
            background-color: #f1f1f1;
        }

        .table-container td a {
            color: #007bff;
            text-decoration: none;
        }

        .table-container td a:hover {
            text-decoration: underline;
        }

        /* Button Styling */
        button {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #555;
        }

        /* Footer Styling */
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }
    </style>
</head>

<body>
   

    <!-- Main Content -->
    <div class="container">
        <h2>Your Bookings</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Name</th>
                        <th>Service</th>
                        <th>phone</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if we have any bookings
                    if ($result->num_rows > 0) {
                        // Loop through the bookings and display them
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['service'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "<td>" . $row['time'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            echo "<td><a href='edit_booking.php?id=" . $row['id'] . "'>Edit</a> | <a href='delete_booking.php?id=" . $row['id'] . "'>Delete</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No bookings found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <?php
    // Close database connection
    $conn->close();
    ?>
</body>

</html>
