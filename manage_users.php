<?php
session_start();

// Include the database connection
include('connect.php');

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch customers from the database (no role restrictions)
$sql = "SELECT * FROM customers WHERE role IN ('admin', 'service_provider', 'customer')";

$result = $conn->query($sql);

// Handle delete action
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); // Sanitize input to ensure it's an integer
    $delete_sql = "DELETE FROM customers WHERE id = ?"; 
    
    // Prepare the statement
    if ($stmt = $conn->prepare($delete_sql)) {
        $stmt->bind_param("i", $delete_id); // 'i' stands for integer
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Customer deleted successfully</div>";
        } else {
            echo "<div class='alert alert-danger'>Error deleting customer: " . $stmt->error . "</div>";
        }
        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>Error preparing statement: " . $conn->error . "</div>";
    }
}

// Handle Add Customer action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_customer'])) {
    $username = $_POST['username'] ?? ''; 
    $email = $_POST['email'] ?? '';
    $role = $_POST['role'] ?? ''; 
    $status = $_POST['status'] ?? '';

    // Basic validation
    if (empty($username) || empty($email) || empty($role) || empty($status)) {  
        echo "<div class='alert alert-danger'>Please fill in all fields.</div>";
        exit; // Stop execution if any field is empty
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='alert alert-danger'>Invalid email format.</div>";
        exit;
    }

    // Proceed with SQL query to add customer
    $add_sql = "INSERT INTO customers (username, email, role, status) VALUES (?, ?, ?, ?)";
    if ($stmt = $conn->prepare($add_sql)) {
        $stmt->bind_param("ssss", $username, $email, $role, $status);  
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>New customer added successfully</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }
        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>Error preparing statement: " . $conn->error . "</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Customers</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    /* General page layout */
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f8f8;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 80%;
        margin: 0 auto;
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1, h2 {
        color: #333;
    }

    /* Form styles */
    .form-container {
        margin-bottom: 30px;
    }

    form input, form select, form button {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    form button {
        background-color: #f5405b;
        color: white;
        cursor: pointer;
    }

    form button:hover {
        background-color: #e24e4e;
    }

    /* Alert styles */
    .alert {
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        font-size: 16px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }

    /* Customer List Styles */
    .customer-list {
        margin-top: 30px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th, table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    table th {
        background-color: #f2f2f2;
    }

    table tr:hover {
        background-color: #f9f9f9;
    }

    table td a {
        text-decoration: none;
        color: #007BFF;
    }

    table td a:hover {
        text-decoration: underline;
    }
 /* Back to Dashboard button styles */
 .back-button {
        background-color: #007BFF;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
        margin-top: 20px;
    }

    .back-button:hover {
        background-color: #0056b3;
    }
    @media (max-width: 768px) {
        .container {
            width: 95%;
        }

        table th, table td {
            padding: 8px;
        }
    }

</style>   
<body>
    <div class="container">
        <h1>Manage Customers</h1>
        <a href="admin_dashboard.php" class="back-button">Back to Dashboard</a>

        <!-- Add Customer Form -->
        <div class="form-container">
            <h2>Add New Customer</h2>
            <form method="POST">
                <input type="text" name="username" placeholder="User Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <select name="role" required>
                    <option value="admin">Admin</option>
                    <option value="service_provider">Service Provider</option>
                    <option value="customer">Customer</option>
                </select>
                <select name="status" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                <button type="submit" name="add_customer">Add Customer</button>
            </form>
        </div>

        <!-- Customer List -->
        <div class="customer-list">
            <h2>Customer List</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($customer = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $customer['id']; ?></td>
                        <td><?php echo $customer['username']; ?></td>
                        <td><?php echo $customer['email']; ?></td>
                        <td><?php echo $customer['role']; ?></td>
                        <td><?php echo $customer['status']; ?></td>
                        <td>
                            <a href="edit_users.php?id=<?php echo $customer['id']; ?>">Edit</a>
                            <a href="manage_users.php?delete_id=<?php echo $customer['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
