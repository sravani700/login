<?php
require_once __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $service = htmlspecialchars(trim($_POST['service']));
    $phone = trim($_POST['phone']);
    $date = $_POST['date'];
    $time = $_POST['time'];
    $address = htmlspecialchars(trim($_POST['address']));

    // Validate phone number format
    if (!preg_match('/^\+91\d{10}$/', $phone)) {
        echo "<script>alert('Invalid phone number format. Use +91XXXXXXXXXX');</script>";
        exit();
    }

    // Insert booking into the database
    $stmt = $conn->prepare("INSERT INTO bookings (name, service, phone, date, time, address) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $service, $phone, $date, $time, $address);

    if ($stmt->execute()) {
        // Twilio credentials
        $account_sid = "---------------------------";
        $auth_token = "------------------------------------";
        $twilio_number = "---------------------------";

        // Initialize Twilio client
        $client = new Client($account_sid, $auth_token);

        // Compose the message
        $sms_body = "Hi $name, your '$service' service is booked on $date at $time. Address: $address. Thank you for choosing us!";

        // Send SMS
        $message = $client->messages->create(
            $phone, // Send to the number input from the form (must be verified if using trial)
            [
                'from' => $twilio_number,
                'body' => $sms_body
            ]
        );

        // Confirm SMS sent
        if ($message->sid) {
            echo "<script>alert('Booking successful and SMS sent successfully!');</script>";
        } else {
            echo "<script>alert('Booking saved, but SMS failed.');</script>";
        }
    } else {
        echo "<script>alert('Booking failed. Please try again.');</script>";
    }

    $stmt->close();
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - Home Services Management</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background-color: #f3f4f6;
            color: #333;
        }

        .navbar {
            background-color: #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
        }

        .logo {
            font-size: 26px;
            font-weight: bold;
            color: #fff;
            letter-spacing: 2px;
            animation: textColorChange 4s infinite linear;
        }

        @keyframes textColorChange {
            0% {
                color: #ff6f61;
            }

            25% {
                color: #fbc531;
            }

            50% {
                color: #4cd137;
            }

            75% {
                color: #00a8ff;
            }

            100% {
                color: #ff6f61;
            }
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-size: 18px;
            transition: color 0.3s;
        }

        .navbar a:hover {
            color: #fbc531;
        }

        h2 {
            text-align: center;
            font-size: 2em;
            margin-top: 40px;
        }

        .services-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            padding: 40px;
            max-width: 1200px;
            margin: auto;
        }

        .service-card {
            background-color: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            text-align: center;
        }

        .service-card:hover {
            transform: translateY(-5px);
        }

        .service-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .service-card h3 {
            margin-bottom: 10px;
            color: #4b0082;
        }

        .service-card p {
            color: #555;
            font-size: 14px;
        }

        .book-btn {
            background-color: #4b0082;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 5px;
            margin-top: 15px;
            cursor: pointer;
            transition: 0.3s;
        }

        .book-btn:hover {
            background-color: #5e2eaa;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 5;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            overflow: auto;
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 90%;
            max-width: 600px;
            position: relative;
            overflow: auto;
            max-height: 80vh;
            box-sizing: border-box;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        input[type="submit"] {
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4b0082;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #5e2eaa;
        }

        footer {
            background-color: #4b0082;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <div class="navbar">
        <div class="logo">Home Services</div>
        <div class="menu">
            <a href="homepage.php">Home</a>
            <a href="about.php">About</a>
            <a href="service.php">Services</a>
            <a href="index.php">Login</a>
            <a href="contact.php">Contact</a>
        </div>
    </div>

    <!-- Services Section -->
    <section id="services">
        <div class="container">
            <h2>Our Services</h2>
            <div class="services-list">
                <!-- Service 1 -->
                <div class="service-card">
                    <img src="plumbering.jpg" alt="Plumbing" class="service-image">
                    <h3>Plumbing</h3>
                    <p>Get your plumbing issues resolved quickly and efficiently.</p>
                    <button class="book-btn" onclick="bookService('Plumbing')">Book Service</button>
                </div>
                <!-- Service 2 -->
                <div class="service-card">
                    <img src="electrical sev.jpeg" alt="Electrical" class="service-image">
                    <h3>Electrical</h3>
                    <p>Professional electrical services for all your home needs.</p>
                    <button class="book-btn" onclick="bookService('Electrical')">Book Service</button>
                </div>
                <!-- Service 3 -->
                <div class="service-card">
                    <img src="homecleaning.jpeg" alt="Cleaning" class="service-image">
                    <h3>Cleaning</h3>
                    <p>Reliable cleaning services to keep your home spotless.</p>
                    <button class="book-btn" onclick="bookService('Cleaning')">Book Service</button>
                </div>
                <!-- Service 4 -->
                <div class="service-card">
                    <img src="about1.jpeg" alt="Gardening" class="service-image">
                    <h3>Washing</h3>
                    <p>Fast and efficient washing services.</p>
                    <button class="book-btn" onclick="bookService('Washing')">Book Service</button>
                </div>
                <!-- Service 5 -->
                <div class="service-card">
                    <img src="beauttypic.jpg" alt="Beauty" class="service-image">
                    <h3>Beauty</h3>
                    <p>Professional beauty services for relaxation and care.</p>
                    <button class="book-btn" onclick="bookService('Beauty')">Book Service</button>
                </div>
                <!-- Service 6 -->
                <div class="service-card">
                    <img src="gardening.jpeg" alt="Gardening" class="service-image">
                    <h3>Gardening</h3>
                    <p>Professional gardening services for your home or office.</p>
                    <button class="book-btn" onclick="bookService('Gardening')">Book Service</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Modal -->
    <div id="booking-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Book a Service</h2>
            <form method="POST" action="service.php">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required><br><br>

                <label for="service">Service:</label>
                <input type="text" id="service" name="service" required><br><br>

                <label for="phone">Contact Number:</label>
<input type="text" id="phone" name="phone" pattern="^\+91\d{10}$" title="Phone number must be in +91XXXXXXXXXX format" required><br><br>


                <label for="date">Preferred Date:</label>
                <input type="date" id="date" name="date" required><br><br>

                <label for="time">Preferred Time:</label>
                <input type="time" id="time" name="time" required><br><br>

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required><br><br>

                <input type="submit" value="Book Now">
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Home Services Management | All Rights Reserved</p>
    </footer>

    <script>
        function bookService(serviceName) {
            document.getElementById('service').value = serviceName;
            document.getElementById('booking-modal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('booking-modal').style.display = 'none';
        }
    </script>
</body>

</html>
