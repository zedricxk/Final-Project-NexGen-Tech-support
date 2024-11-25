<?php
if (isset($_POST['submit'])) {
    $servername = "localhost";
    $username = "root"; // Your database username
    $password = ""; // Your database password
    $dbname = "gadget_repair"; // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve data from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $service_type = $_POST['service_type'];

    // Prepare SQL query
    $stmt = $conn->prepare("INSERT INTO service_requests (name, email, service_type) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $service_type); // 'sss' means all parameters are strings

    // Execute the query
    if ($stmt->execute()) {
        echo "<script>alert('You have successfully contacted us for the service. We will get back to you shortly!');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement and connection
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Service - Gadget & Phone Repair</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Body and General Styling */
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #38c8a8; /* New background color */
      color: #333333;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      font-size: 16px;
      line-height: 1.6;
    }

    /* Navigation Styling */
    nav {
      background-color: rgba(0, 0, 0, 0.7);
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: fixed;
      width: 100%;
      z-index: 10;
    }

    nav .logo {
      color: white;
      font-size: 1.8rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    nav .nav-links {
      list-style: none;
      display: flex;
      gap: 20px;
    }

    nav .nav-links li {
      font-size: 1rem;
      font-weight: 600;
    }

    nav .nav-links li a {
      color: white;
      text-decoration: none;
      transition: color 0.3s;
    }

    nav .nav-links li a:hover {
      color: #fff;
    }

    /* Main Content Styling */
    .main-content {
      padding: 120px 20px 40px;
      max-width: 1200px;
      margin: 0 auto;
      width: 100%;
      background-color: white;
      border-radius: 8px;
      box-shadow: none;
    }

    h1 {
      text-align: center;
      font-size: 2rem;
      margin-bottom: 20px;
      color: #111;
      font-weight: bold;
    }

    p {
      text-align: center;
      margin-bottom: 40px;
      color: #555;
      font-size: 1rem;
      max-width: 800px;
      margin: 0 auto;
    }

    .service-list {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); 
      gap: 20px;
      margin-top: 40px;
    }

    /* Service Card Styling */
    .service-card {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: none;
      overflow: hidden;
      text-align: center;
      padding: 20px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .service-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 15px;
    }

    .service-card h3 {
      font-size: 1.3rem;
      color: #333;
      margin-bottom: 10px;
      font-weight: 600;
    }

    .service-card p {
      font-size: 1rem;
      color: #666;
      margin-bottom: 20px;
    }

    .service-card button {
      background-color: #00b09b;
      color: white;
      padding: 12px;
      width: 100%;
      font-size: 1rem;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .service-card button:hover {
      background-color: #007d6c;
      transform: translateY(-5px);
    }

    /* Footer Styling */
    .footer {
      background-color: #23262d;
      color: white;
      text-align: center;
      padding: 15px;
      font-size: 1rem;
      box-shadow: none;
    }

    .footer a {
      color: #fff;
      text-decoration: none;
    }

    .footer a:hover {
      color: #00b09b;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .main-content {
        padding: 60px 20px 40px;
      }

      nav .logo {
        font-size: 1.5rem;
      }

      nav .nav-links {
        flex-direction: column;
        gap: 15px;
      }

      .service-list {
        grid-template-columns: 1fr;
      }
    }

    button[type="submit"] {
      background-color: #00b09b;
      color: white;
      padding: 12px;
      width: 100%;
      font-size: 1.1rem;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
      background-color: #2bcc91;
    }

  </style>

  <script>
    function showMessage() {
      alert("You have successfully contacted us for the service. We will get back to you shortly!");
    }
  </script>
</head>
<body>

  <nav>
    <div class="logo">Gadget Repair</div>
    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="service.php">Services</a></li>
      <li><a href="about.php">About</a></li>
    </ul>
  </nav>

  <div class="main-content">
    <h1>Our Gadget & Phone Repair Services</h1>
    <p>We provide high-quality repair services for your gadgets, phones, and laptops. Our technicians are skilled and experienced in handling all types of repairs. Whether it's a screen replacement, battery issue, or software glitch, we’ve got you covered!</p>

    <div class="service-list">
      <div class="service-card">
        <img src="https://repairadvise.com.ph/wp-content/uploads/2017/09/iPhone-repair-Philippines.jpeg" alt="Phone Repair">
        <h3>Phone Repair</h3>
        <p>From cracked screens to battery replacements, we repair all major phone brands.</p>
        <button onclick="showMessage()">Get Service</button>
      </div>
      <div class="service-card">
        <img src="https://images.ctfassets.net/16nm6vz43ids/7g9t8d7WaVz7BM1L9RmrCl/9f42265945660d42d58111bf3e169aab/Repair_or_replace_laptop.png?fm=webp&q=65" alt="Laptop Repair">
        <h3>Laptop Repair</h3>
        <p>Our expert technicians can fix issues like slow performance, overheating, and more.</p>
        <button onclick="showMessage()">Get Service</button>
      </div>
      <div class="service-card">
        <img src="https://www.completecomputingsw.co.uk/wp-content/uploads/2023/08/Tablet-Repair.jpg" alt="Tablet Repair">
        <h3>Tablet Repair</h3>
        <p>We fix screen cracks, software glitches, and any other tablet-related problems.</p>
        <button onclick="showMessage()">Get Service</button>
      </div>
      <div class="service-card">
        <img src="https://thumbs.dreamstime.com/b/technician-repairs-smartwatch-tweezers-electronic-smartphone-service-centar-cellphone-smart-watch-technology-device-136373956.jpg" alt="Smartwatch Repair">
        <h3>Smartwatch Repair</h3>
        <p>We repair smartwatch screens, batteries, and other issues to keep you connected.</p>
        <button onclick="showMessage()">Get Service</button>
      </div>
    </div>
  </div>

  <div class="footer">
    <p>&copy; 2024 Gadget Repair. All Rights Reserved.</p>
    <p><a href="privacy-terms.php">Privacy Policy</a> | <a href="privacy-terms.php">Terms & Conditions</a></p>
  </div>

</body>
</html>
