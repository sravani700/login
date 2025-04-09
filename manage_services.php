<?php
session_start();

// Include the database connection file
include('connect.php'); // Make sure this path is correct

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: adminlogin.php');
    exit();
}

// Handle Add Service
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_service'])) {
    $service_name = mysqli_real_escape_string($conn, $_POST['service_name']);
    $service_description = mysqli_real_escape_string($conn, $_POST['service_description']);
    $service_price = mysqli_real_escape_string($conn, $_POST['service_price']);

    // Insert service into the database
    $query = "INSERT INTO services (service_name, service_description, service_price) 
              VALUES ('$service_name', '$service_description', '$service_price')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Service added successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

// Handle Delete Service
if (isset($_GET['delete'])) {
    $service_id = $_GET['delete'];

    // Delete service from the database
    $query = "DELETE FROM services WHERE id = $service_id";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Service deleted successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

// Fetch all services from the database
$query = "SELECT * FROM services";
$services_result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services - Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    /* Additional styling for Manage Services page */
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


/* Content area styles */
.content {
    margin-left: 250px;
    padding: 20px;
    width: calc(100% - 250px);
}

/* Header style */
h1 {
    color: #2c3e50;
    margin-bottom: 20px;
}

/* Section Styling */
section {
    margin-bottom: 30px;
}

/* Add Service Form */
form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    width: 400px;
    margin-top: 20px;
}

form input, form textarea {
    padding: 12px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 16px;
}

form button {
    padding: 12px;
    background-color: #2c3e50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

form button:hover {
    background-color: #34495e;
}
/* Style for Go Back Button */
.go-back-btn {
    display: inline-block;
    margin-bottom: 20px;
}

.go-back-btn button {
    padding: 12px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.go-back-btn button:hover {
    background-color: #2980b9;
}


/* Table styling for the list of services */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 12px;
    text-align: left;
}

th {
    background-color: #2c3e50;
    color: white;
}

td {
    background-color: white;
}

/* Action Links */
a {
    color: #3498db;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

/* Responsive design for smaller screens */
@media (max-width: 768px) {
    .sidebar {
        width: 200px;
    }

    .content {
        margin-left: 200px;
        width: calc(100% - 200px);
    }

    form {
        width: 90%;
    }

    table {
        font-size: 14px;
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

    form {
        width: 90%;
    }

    table {
        font-size: 12px;
    }
}

</style>
<body>
 

    <div class="content">
        <h1>Manage Services</h1>
        <a href="admin_dashboard.php" class="go-back-btn">
        <button type="button">Go Back to Dashboard</button>
        </a>
        
        <!-- Add Service Form -->
        <section id="add-service" class="section">
        <h2>Add New Service</h2>
         <form action="manage_services.php" method="POST">
           
           <input type="text" name="service_name" id="service_name" required placeholder="Enter service name">
        
           <textarea name="service_description" id="service_description" required placeholder="Enter service description"></textarea>
           
           <input type="number" name="service_price" id="service_price" step="0.01" min="0" required placeholder="Enter price">
           <button type="submit" name="add_service">Add Service</button>
        </form>
        

        </section>

        <!-- List of Services -->
        <section id="services-list" class="section">
            <h2>All Services</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Service Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($service = mysqli_fetch_assoc($services_result)) { ?>
                        <tr>
                            <td><?php echo $service['id']; ?></td>
                            <td><?php echo $service['service_name']; ?></td>
                            <td><?php echo $service['service_description']; ?></td>
                            <td><?php echo "$" . $service['service_price']; ?></td>
                            <td>
                                <a href="edit_service.php?id=<?php echo $service['id']; ?>">Edit</a>
                                <a href="manage_services.php?delete=<?php echo $service['id']; ?>" onclick="return confirm('Are you sure you want to delete this service?')">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>
