<?php
session_start(); // Start session to check if the user is logged in
include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Services</title>
    <style>
        /* Basic CSS for navbar, logo, and styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            text-align: center;
            color: hsla(0, 59.70%, 26.30%, 0.88);
        }

        .card-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 50px;
            gap: 20px;
        }

        .card {
            width: 300px;
            background-color: rgba(192, 209, 192, 0.9);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 2px 4px hsla(0, 59.70%, 26.30%, 0.88);
            margin: 10px;
            text-align: center;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid #ddd;
        }

        .card-content {
            padding: 0px;
            font-size: 24px;
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

        /* Main Content Styling */
        .container {
            width: 100%;
            height: 100vh;
            background-position: center;
            background-size: cover;
            position: relative;
            background-image: linear-gradient(rgba(181, 155, 212, 0.68), rgba(233, 187, 233, 0.84)), url(bg.jpg);
        }

        .heading {
            text-align: center;
            padding: 80px 20px;
        }

        .heading h1 {
            font-size: 2.5em;
            font-weight: 600;
            margin-top: 10px;
            color: #333;
        }

        .heading p {
            font-size: 1.1em;
            color: #9e0916;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto 30px;
        }

        .cta-button {
            background-color: rgba(108, 9, 201, 0.88);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: rgba(133, 17, 228, 0.89);
        }

        /* Styling the moving text */
        .moving-text {
            font-size: 2.5em;
            font-weight: bold;
            color: #333;
            display: inline-block;
            white-space: nowrap; /* Ensure the text doesn't wrap */
            animation: moveText 4s infinite alternate;
        }

        /* Define the animation */
        @keyframes moveText {
            0% {
                transform: translateX(0);
            }
            50% {
                transform: translateX(200px);
            }
            100% {
                transform: translateX(0);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .heading {
                padding: 60px 15px;
            }

            .heading h1 {
                font-size: 2em;
            }

            .heading p {
                font-size: 1em;
            }

            .cta-button {
                padding: 12px 25px;
                font-size: 1em;
            }
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

    <div class="container">
        <div class="heading">
            <h1 class="moving-text">Welcome to our home services</h1>
            <p>Our platform empowers you to manage bookings, dispatch technicians, and delight customers, all in one place.</p>
            <a href="service.php">
                <button class="cta-button">Book Service</button>
            </a>
        </div>
    </div>

    <h1>Our Services</h1>
    <div class="card-container">
        <div class="card"> 
            <img src="plumbering.jpg" alt="Plumbing Service">
            <div class="card-content">
                <h3>Plumbing</h3>
            </div>  
        </div>      
        <div class="card"> 
            <img src="house cleaning.jpeg" alt="Cleaning Service">
            <div class="card-content">
                <h3>Cleaning</h3> 
            </div>   
        </div>
        <div class="card"> 
            <img src="electrical sev.jpeg" alt="Electric Work">
            <div class="card-content">
                <h3>Electric Work</h3> 
            </div>   
        </div> 
        <div class="card"> 
            <img src="beauttypic.jpg" alt="Beauty Service">
            <div class="card-content">
                <h3>Beauty Parlor</h3> 
            </div>   
        </div>  
        <div class="card"> 
            <img src="homecleaning.jpeg" alt="Washing Service">
            <div class="card-content">
                <h3>Washing</h3> 
            </div>   
        </div>  
        <div class="card"> 
            <img src="plumbering.jpg" alt="Gardening Service">
            <div class="card-content">
                <h3>Gardening</h3> 
            </div> 
      
        </div>                                      
    </div>
</body>
</html>
