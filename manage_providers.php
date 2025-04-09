<?php
// Include the database connection file
include('connect.php');

// Handle Add Provider
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_provider'])) {
    // Retrieve and sanitize input data
    $provider_name = mysqli_real_escape_string($conn, $_POST['provider_name']);
    $provider_email = mysqli_real_escape_string($conn, $_POST['provider_email']);
    $provider_contact = mysqli_real_escape_string($conn, $_POST['provider_contact']);
    $provider_address = mysqli_real_escape_string($conn, $_POST['provider_address']);
    $provider_service_name = mysqli_real_escape_string($conn, $_POST['provider_service_name']);
    $provider_service_description = mysqli_real_escape_string($conn, $_POST['provider_service_description']);

    // Validate email: Check if it's empty
    if (empty($provider_email)) {
        echo "<script>alert('Error: Email cannot be empty!');</script>";
        exit();
    }

    // Validate email format
    if (!filter_var($provider_email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Error: Invalid email format!');</script>";
        exit();
    }

    // Check if email already exists
    $email_check_query = "SELECT * FROM service_providers WHERE provider_email = '$provider_email'";
    $result = mysqli_query($conn, $email_check_query);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Error: This email is already in use!');</script>";
    } else {
        // Insert provider into the database using a prepared statement
        $query = "INSERT INTO service_providers (provider_name, provider_email, provider_phone, provider_address, provider_service_name, provider_service_description) 
                  VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $query)) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $provider_name, $provider_email, $provider_phone, $provider_address, $provider_service_name, $provider_service_description);

            // Execute the query and check success
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Provider added successfully!');</script>";
            } else {
                echo "<script>alert('Error: " . mysqli_stmt_error($stmt) . "');</script>";
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
}

// Fetch all providers from the database
$query = "SELECT * FROM service_providers";
$providers_result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Providers - Home Services Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
  /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f7fc;
    color: #333;
    margin: 0;
}

/* Content wrapper */
.content {
    max-width: 1000px;
    margin: 0 auto;
    padding: 20px;
}

/* Header */
h1 {
    text-align: center;
    color: #4CAF50;
    margin-bottom: 20px;
}

/* Go Back Button */
.go-back-btn {
    display: block;
    margin: 20px 0;
    text-align: center;
}

.go-back-btn button {
    background-color: #4CAF50;
    color: white;
    font-size: 16px;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
}

.go-back-btn button:hover {
    background-color: #45a049;
}

/* Form Section */
.section {
    margin-bottom: 40px;
}

h2 {
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

form input[type="text"], form input[type="email"], form button, form textarea {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

form textarea {
    height: 150px;
    resize: vertical;
}

form input[type="text"], form input[type="email"], form textarea {
    background-color: #fff;
}

form button {
    background-color: #4CAF50;
    color: white;
    border: none;
    font-size: 16px;
    cursor: pointer;
}

form button:hover {
    background-color: #45a049;
}

/* Table Section */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 30px;
}

table th, table td {
    padding: 20px;
    text-align: left;
    border: 1px solid #ddd;
}

table th {
    background-color: #4CAF50;
    color: white;
}

table td {
    background-color: #fff;
}

table td a {
    color: #4CAF50;
    text-decoration: none;
    padding: 5px 10px;
    margin-right: 10px;
    border: 1px solid #4CAF50;
    border-radius: 4px;
}

table td a:hover {
    background-color: #4CAF50;
    color: white;
}

table td a:active {
    background-color: #45a049;
}

/* Responsive Design */
@media (max-width: 768px) {
    .content {
        padding: 10px;
    }

    form input[type="text"], form input[type="email"], form button {
        font-size: 14px;
    }

    table th, table td {
        font-size: 14px;
    }
}
  
</style>    
<body>
    <div class="content">
        <h1>Manage Providers</h1>

        <!-- Go Back Button -->
        <a href="admin_dashboard.php" class="go-back-btn">
            <button type="button">Go Back to Dashboard</button>
        </a>

        <!-- Add Provider Form -->
        <section id="add-provider" class="section">
            <h2>Add New Provider</h2>
            <form action="manage_providers.php" method="POST">
                <input type="text" name="provider_name" id="provider_name" required placeholder="Enter provider name">
                <input type="email" name="provider_email" id="provider_email" required placeholder="Enter provider email">
                <input type="text" name="provider_phone" id="provider_contact" required placeholder="Enter provider phone">
                <input type="text" name="provider_address" id="provider_address" required placeholder="Enter provider address">
                <input type="text" name="provider_service_name" id="provider_service_name" required placeholder="Enter service name">
                <textarea name="provider_service_description" id="provider_service_description" required placeholder="Enter service description"></textarea>
                <button type="submit" name="add_provider">Add Provider</button>
            </form>
        </section>

        <!-- List of Providers -->
        <section id="providers-list" class="section">
            <h2>All Providers</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Provider Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Service Name</th>
                        <th>Service Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($provider = mysqli_fetch_assoc($providers_result)) { ?>
                        <tr>
                            <td><?php echo $provider['id']; ?></td>
                            <td><?php echo $provider['provider_name']; ?></td>
                            <td><?php echo $provider['provider_email']; ?></td>
                            <td><?php echo $provider['provider_phone']; ?></td>
                            <td><?php echo $provider['provider_address']; ?></td>
                            <td><?php echo $provider['provider_service_name']; ?></td>
                            <td><?php echo $provider['provider_service_description']; ?></td>
                            <td>
                                <a href="edit_provider.php?id=<?php echo $provider['id']; ?>">Edit</a>
                                <a href="manage_providers.php?delete=<?php echo $provider['id']; ?>" onclick="return confirm('Are you sure you want to delete this provider?')">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>
