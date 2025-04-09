<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: adminlogin.php');
    exit();
}

include('config.php');

$id = $_GET['id'];
$query = "SELECT * FROM services WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$service = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $query = "UPDATE services SET name = '$name', description = '$description', price = '$price' WHERE id = '$id'";
    mysqli_query($conn, $query);

    header('Location: admin_dashboard.php');
    exit();
}
?>

<form method="POST" action="edit_service.php?id=<?php echo $id; ?>">
    <input type="text" name="name" value="<?php echo $service['name']; ?>" required>
    <textarea name="description" required><?php echo $service['description']; ?></textarea>
    <input type="number" step="0.01" name="price" value="<?php echo $service['price']; ?>" required>
    <button type="submit">Update Service</button>
</form>
