<!-- add_service.php -->
<?php
include('connection   .php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $query = "INSERT INTO services (name, category, description, price) VALUES ('$name', '$category', '$description', '$price')";
    if (mysqli_query($conn, $query)) {
        echo "Service added successfully.";
        header("Location: admin_dashboard.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Service</title>
</head>
<body>
    <h2>Add New Service</h2>
    <form method="POST" action="">
        <label for="name">Service Name:</label><br>
        <input type="text" id="name" name="name" required><br>
        <label for="category">Service Category:</label><br>
        <input type="text" id="category" name="category"><br>
        <label for="description">Service Description:</label><br>
        <textarea id="description" name="description"></textarea><br>
        <label for="price">Service Price:</label><br>
        <input type="number" id="price" name="price" required><br>
        <button type="submit">Add Service</button>
    </form>
</body>
</html>
