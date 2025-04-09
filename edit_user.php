<?php
include('connect.php');

// Check if 'id' is provided in the URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Fetch user details from the database
    $sql = "SELECT * FROM user WHERE id = $user_id";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    // Handle form submission for editing user
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $status = $_POST['status'];

        $update_sql = "UPDATE user SET name = '$name', email = '$email', role = '$role', status = '$status' WHERE id = $user_id";
        if ($conn->query($update_sql) === TRUE) {
            echo "User updated successfully";
        } else {
            echo "Error updating user: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    
    <?php if ($user) : ?>
    <form method="POST">
        <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
        <select name="role" required>
            <option value="admin" <?php if ($user['role'] === 'admin') echo 'selected'; ?>>Admin</option>
            <option value="service_provider" <?php if ($user['role'] === 'service_provider') echo 'selected'; ?>>Service Provider</option>
            <option value="customer" <?php if ($user['role'] === 'customer') echo 'selected'; ?>>Customer</option>
        </select>
        <select name="status" required>
            <option value="active" <?php if ($user['status'] === 'active') echo 'selected'; ?>>Active</option>
            <option value="inactive" <?php if ($user['status'] === 'inactive') echo 'selected'; ?>>Inactive</option>
        </select>
        <button type="submit">Update User</button>
    </form>
    <?php else: ?>
        <p>User not found.</p>
    <?php endif; ?>
</body>
</html>
