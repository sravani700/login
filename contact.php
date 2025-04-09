<!-- contact.php -->
<?php
// Initialize the status message
$statusMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form is submitted and all fields are filled
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if (!empty($name) && !empty($email) && !empty($message)) {
        // Here you can either send an email or save the message to the database
        // For simplicity, we'll send an email to the admin

        $to = 'dyavathispandana008@gmail.com';  // Change this to your email address
        $subject = "Contact Form Message from $name";
        $body = "Name: $name\nEmail: $email\nMessage: $message";
        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            $statusMessage = "Your message has been sent successfully!";
        } else {
            $statusMessage = "There was an error sending your message. Please try again.";
        }
    } else {
        $statusMessage = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Home Services</title>
    <link rel="stylesheet" href="style.css">  <!-- Link to your CSS file -->
</head>
<style>
    /* style.css */
body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
}

.contact-container {
    width: 50%;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

h1 {
    text-align: center;
    color: #333;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

input, textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
    box-sizing: border-box;
}

textarea {
    resize: vertical;
    height: 150px;
}

.submit-btn {
    background-color: #0dd4b3;  /* Green color for the button */
    color: white;
    border: none;
    padding: 12px 20px;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
}

.submit-btn:hover {
    background-color: #62a09f;  /* A darker shade when hovering */
}

.status-message {
    color:rgb(51, 221, 57);
    text-align: center;
    margin-bottom: 20px;
}

.status-message.error {
    color: #f44336;
}

</style>
<body>
    <div class="contact-container">
        <h1>Contact Us</h1>
        
        <?php if ($statusMessage != ''): ?>
            <div class="status-message"><?php echo $statusMessage; ?></div>
        <?php endif; ?>

        <form action="contact.php" method="POST">
            <div class="form-group">
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="message">Your Message:</label>
                <textarea id="message" name="message" required></textarea>
            </div>

            <button type="submit" class="submit-btn">Send Message</button>
        </form>
    </div>
</body>
</html>
