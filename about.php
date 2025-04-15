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
            background-color:#eed8f2;
            margin: 0;
            padding: 0;
            text-align:center;
            color:hsla(0, 59.70%, 26.30%, 0.88);;
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
       /* .container {
            text-align: center;
            padding: 15%;
            font-size: 30px;
            font-weight: bold;*/
        
        .container {
            
            background-image:#blue;
        }
        .heading {
  text-align: center;
  padding: 80px 20px; /* Adjust padding as needed */
  
}

.heading h1 {
  font-size: 2.5em; /* Adjust font size for headline */
  font-weight: 600;
  margin-top: 10px;
  color: #333; /* Darker text color for headline */
}

.heading p {
  font-size: 1.1em; /* Adjust font size for paragraph */
  color:rgb(5, 5, 5); /* Slightly lighter text color for paragraph */
  line-height: 1.6;
  max-width: 800px; /* Limit paragraph width for readability */
  margin: 0 auto 30px; /* Center paragraph and add bottom margin */
}


.team {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-top: 30px;
}

.team-member {
    text-align: center;
    width: 200px;
}

.team-member img {
    border-radius: 50%;
    width: 150px;
    height: 150px;
    margin-bottom: 10px;
}

.team-member p {
    color: #333;
    font-size: 1.1em;
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
          <h1>ABOUT US</h1>
          <p>Welcome to our about us page! We are a trusted platform that connects you with skilled
                professionals to handle all your home service needs. Whether it's plumbing, electrical work, cleaning,
                or repairs, we ensure that you get the best service with ease.</p>
       </div>
    </div>
    
    <h1>Our Team</h1>
            <div class="team">
                <!-- Team Member 1 -->
                <div class="team-member">
                    <img src="teampic.png" alt="Team Member">
                    <p><strong>1</strong></p>
                    <p>person1</p>
                </div>

                <!-- Team Member 2 -->
                <div class="team-member">
                    <img src="teampic.png" alt="Team Member">
                    <p><strong>2</strong></p>
                    <p>person2</p>
                </div>

                <!-- Team Member 3 -->
                <div class="team-member">
                    <img src="teampic.png" alt="Team Member">
                    <p><strong>3</strong></p>
                    <p>person3</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

