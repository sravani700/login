<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the booking form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $service = $_POST['service'];
    $phone=$_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $address = $_POST['address'];

    // Insert booking into the database
    $sql = "INSERT INTO bookings (name, service , phone , date, time, address) VALUES ('$name', '$service','$phone', '$date', '$time', '$address')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Booking successfully created!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
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
        body {
            font-family: Arial, sans-serif;
            background-color: #eed8f2;
            margin: 0;
            padding: 0;
            text-align: center;
            color: hsla(0, 59.70%, 26.30%, 0.88);
        }

        /* Navigation Bar Styling */
        .navbar {
            background-color: #333;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 30px 40px;
        }

        /* Logo Styling */
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: white;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Menu Styling */
        .navbar a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            text-align: center;
            font-size: 18px;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        #services {
            background-color: #fff;
            padding: 40px 0;
            text-align: center;
        }

        #services h2 {
            color: #333;
            margin-bottom: 30px;
        }

        .services-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 columns */
            gap: 30px;
            flex-wrap: wrap;
            justify-items: center;
        }

        .service-card {
            background-color: rgb(187, 218, 233);
            padding: 40px;
            width: 300px;
            text-align: center;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .service-card:hover {
            transform: scale(1.05);
            background-color: rgb(147, 170, 201);
        }

        .service-card h3 {
            color: #333;
            margin-bottom: 10px;
        }

        .service-card p {
            color: #666;
        }

        .service-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .book-btn {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            margin-top: 15px;
        }

        .book-btn:hover {
            background-color: #555;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            margin-top: 40px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(88, 13, 187, 0.81);
            background-color: rgba(124, 97, 223, 0.9);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 400px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"] {
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1em;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <div class="navbar">
        <!-- Logo Section -->
        <div class="logo">
            Home Services
        </div>

        <!-- Menu Links -->
        <div class="menu">
            <a href="homepage.php">Home</a>
            <a href="about.php">About</a>
            <a href="service.php">Services</a>
            <a href="index.php">Login</a>
            <a href="contact.php">Contact</a>
        </div>
    </div>

    <section id="services">
        <div class="container">
            <h2>Our Services</h2>
            <div class="services-list">
                <!-- Service 1: Plumbing -->
                <div class="service-card">
                    <img src="plumbering.jpg" alt="Plumbing" class="service-image">
                    <h3>Plumbing</h3>
                    <p>Get your plumbing issues resolved quickly and efficiently.</p>
                    <button class="book-btn" onclick="bookService('Plumbing')">Book Service</button>
                </div>

                <!-- Service 2: Electrical -->
                <div class="service-card">
                    <img src="electrical sev.jpeg" alt="Electrical" class="service-image">
                    <h3>Electrical</h3>
                    <p>Professional electrical services for all your home needs.</p>
                    <button class="book-btn" onclick="bookService('Electrical')">Book Service</button>
                </div>

                <!-- Service 3: Cleaning -->
                <div class="service-card">
                    <img src="homecleaning.jpeg" alt="Cleaning" class="service-image">
                    <h3>Cleaning</h3>
                    <p>Reliable cleaning services to keep your home spotless.</p>
                    <button class="book-btn" onclick="bookService('Cleaning')">Book Service</button>
                </div>

                <!-- Service 4: Gardening -->
                <div class="service-card">
                    <img src="about1.jpeg" alt="Gardening" class="service-image">
                    <h3>washing</h3>
                    <p>Fast and efficient gardening services.</p>
                    <button class="book-btn" onclick="bookService('washing')">Book Service</button>
                </div>

                <!-- Service 5: Beauty -->
                <div class="service-card">
                    <img src="beauttypic.jpg" alt="Beauty" class="service-image">
                    <h3>Beauty</h3>
                    <p>Professional beauty services for relaxation and care.</p>
                    <button class="book-btn" onclick="bookService('Beauty')">Book Service</button>
                </div>

                <!-- Service 6: Painting -->
                <div class="service-card">
                    <img src="gardening.jpeg" alt="Painting" class="service-image">
                    <h3>Gardening</h3>
                    <p>Professional painting services for your home or office.</p>
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
        <label for="phone">contact number:</label>
        <input type="text" id="phone" name="phone" required><br><br>

        <label for="date">Preferred Date:</label>
        <input type="date" id="date" name="date" required><br><br>

        <label for="time">Preferred Time:</label>
        <input type="time" id="time" name="time" required><br><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br><br>

        <input type="submit" value="Book Now">
    </form>
</body>
</html>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Home Services Management | All Rights Reserved</p>
    </footer>

    <script>
        // Function to open the booking modal
        function bookService(serviceName) {
            // Set the service name in the modal input
            document.getElementById('service').value = serviceName;
            
            // Display the modal
            document.getElementById('booking-modal').style.display = 'block';
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById('booking-modal').style.display = 'none';
        }

        // Handling form submission
        document.getElementById('booking-form').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent form from refreshing the page

            // Get the form data
            const name = document.getElementById('name').value;
            const service = document.getElementById('service').value;
            const phone = document.getElementById('phone').value;
            const date = document.getElementById('date').value;
            const time = document.getElementById('time').value;

            // Display a confirmation message
            alert(`Thank you, ${name}! Your ${service} service is booked for ${date} at ${time}.`);

            // Close the modal
            closeModal();
        });
    </script>
</body>

</html>
