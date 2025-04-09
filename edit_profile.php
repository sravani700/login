<?php
// Start session to track the logged-in user
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: providerlogin.php"); // Redirect to login page if not logged in
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the service provider's details
$provider_id = $_SESSION['user_id'];
$sql = "SELECT * FROM service_providers WHERE id = '$provider_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $provider = $result->fetch_assoc();
} else {
    echo "Error fetching provider details.";
    exit();
}

// Handle the file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_picture'])) {
    $target_dir = "uploads/profile_pics/"; // Ensure this path is correct
    $target_file = $target_dir . time() . "_" . basename($_FILES['profile_picture']['name']);
    $upload_ok = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a valid image
    if (getimagesize($_FILES['profile_picture']['tmp_name']) !== false) {
        echo "File is an image - " . $_FILES['profile_picture']['name'];
        $upload_ok = 1;
    } else {
        echo "File is not an image.";
        $upload_ok = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $upload_ok = 0;
    }

    // Check file size (example: max 2MB)
    if ($_FILES['profile_picture']['size'] > 2000000) {
        echo "Sorry, your file is too large.";
        $upload_ok = 0;
    }

    // Allow certain file formats (e.g., jpg, jpeg, png)
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
        $upload_ok = 0;
    }

    // Ensure the directory exists and is writable
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Create the directory if it doesn't exist
    }

    // If everything is OK, move the file to the target directory
    if ($upload_ok == 1) {
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
            // Update the provider's profile with the new image path
            $profile_picture = $target_file;
            $sql_update = "UPDATE service_providers SET profile_picture = '$profile_picture' WHERE id = '$provider_id'";
            if ($conn->query($sql_update) === TRUE) {
                echo "Profile picture updated successfully.";
            } else {
                echo "Error updating profile picture: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

?>

<!-- Your HTML form goes here -->
<form action="edit_profile.php" method="post" enctype="multipart/form-data">
    <label for="profile_picture">Upload Profile Picture:</label>
    <input type="file" name="profile_picture" id="profile_picture" required>
    <input type="submit" value="Upload Image" name="submit">
</form>
