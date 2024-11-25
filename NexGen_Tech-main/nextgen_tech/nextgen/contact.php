<?php
// Database connection
$servername = "localhost";
$username = "root";  // Change if necessary
$password = "";      // Change if necessary
$dbname = "nextgen_tech";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve and sanitize form data
    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $phone = mysqli_real_escape_string($conn, $_POST['PhoneNumber']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $message = mysqli_real_escape_string($conn, $_POST['Message']);

    // Validate fields
    if (empty($name) || empty($phone) || empty($email) || empty($message)) {
        echo "<script>alert('Please fill in all the fields!');</script>";
    } else {
        // Insert data into the database using prepared statement
        $sql = "INSERT INTO users (name, phone, email, message) VALUES (?, ?, ?, ?)";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssss", $name, $phone, $email, $message);
            if ($stmt->execute()) {
                echo "<script>
                        alert('Your message has been sent successfully!');
                        window.location.href = 'index.php'; // Redirect to homepage
                    </script>";
            } else {
                echo "<script>
                        alert('Error submitting your message. Please try again later.');
                    </script>";
            }
            $stmt->close();
        }
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | NextGen Tech</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        header {
            background-color: #333;
            padding: 20px 0;
        }

        header .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        header .navbar .logo {
            color: white;
            text-decoration: none;
            font-size: 30px;
            font-weight: 600;
        }

        header nav ul {
            list-style-type: none;
            display: flex;
            gap: 20px;
        }

        header nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
        }

        header nav ul li a:hover {
            color: #ff4a57;
        }

        /* Contact Section */
        .contact-section {
            padding: 60px 0;
        }

        .contact-section .container {
            display: flex;
            flex-wrap: wrap;
            gap: 50px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .contact-section h2 {
            font-size: 36px;
            color: #333;
            margin-bottom: 15px;
        }

        .contact-section p {
            color: #777;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group input,
        .input-group textarea {
            width: 100%;
            padding: 15px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f4f4f4;
            color: #333;
            transition: 0.3s;
        }

        .input-group input:focus,
        .input-group textarea:focus {
            border-color: #ff4a57;
            outline: none;
            background-color: white;
        }

        textarea {
            resize: vertical;
            min-height: 150px;
        }

        .submit-btn {
            background-color: #ff4a57;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
        }

        .submit-btn:hover {
            background-color: #e93f4d;
        }

        /* Contact Info */
        .contact-info {
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .contact-info h3 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .contact-info p {
            color: #555;
            font-size: 16px;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .contact-section .container {
                flex-direction: column;
            }

            .navbar ul {
                display: block;
                text-align: center;
                margin-top: 20px;
            }

            .navbar ul li {
                margin: 5px 0;
            }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <div class="navbar">
            <a href="index.php" class="logo">NextGen Tech</a>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="service.php">Service</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Contact Form Section -->
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="col-md-6">
                <h2>Get In Touch</h2>
                <p>Have a question or need assistance? We're here to help! Fill out the form below, and we'll get back to you as soon as possible.</p>
                <form action="contact.php" method="POST">
                    <div class="input-group">
                        <input type="text" name="Name" placeholder="Your Name" required>
                    </div>
                    <div class="input-group">
                        <input type="tel" name="PhoneNumber" placeholder="Your Phone Number" required>
                    </div>
                    <div class="input-group">
                        <input type="email" name="Email" placeholder="Your Email" required>
                    </div>
                    <div class="input-group">
                        <textarea name="Message" placeholder="Your Message" required></textarea>
                    </div>
                    <button type="submit" class="submit-btn">Submit</button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="contact-info">
                    <h3>Our Location</h3>
                    <p><strong>Address:</strong> Phase 2 blk 14 lot 40 Sv3 Poblaction Muntinlupa City</p>
                    <p><strong>Email:</strong> josephhansol2@gmail.com</p>
                    <p><strong>Phone:</strong> 9519002480</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 NextGen Tech. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
