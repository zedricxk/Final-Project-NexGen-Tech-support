<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "nextgen_tech"; // replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize error message variable
$error_message = "";
$login_success = false;

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the email exists in the database
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables and indicate login success
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['username'];
            $_SESSION['login_success'] = true; // Set this variable to show success message
            $login_success = true; // For immediate feedback on this page load
        } else {
            $error_message = "Incorrect password. Please try again.";
        }
    } else {
        $error_message = "No account found with that email.";
    }
    // Handle login logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Your login validation here
    // Assume successful login for example
    $_SESSION['logged_in'] = true;

    // Redirect to the original page the user tried to access
    if (isset($_GET['redirect'])) {
        header('Location: ' . $_GET['redirect']);
        exit;
    } else {
        // If no redirect specified, redirect to a default page
        header('Location: shop.php');
        exit;
    }
}

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NexGen Tech</title>
    <style>
        /* Body Styling */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(to bottom right, #a18cd1, #fbc2eb), 
                        url('https://images.unsplash.com/photo-1527261834078-9b37d3e1af97?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwzNjUyOXwwfDF8c2VhcmNofHxjbG91ZHxlbnwwfHx8fDE2ODQwNzg0MzE&ixlib=rb-4.0.3&q=80&w=1080') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Roboto', sans-serif;
            color: #333;
        }

        /* Login Container */
        .form-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
            width: 360px;
            text-align: center;
        }

        /* Header */
        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            font-weight: 600;
        }

        /* Input Fields */
        .form-container input[type="email"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 14px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .form-container input:focus {
            border-color: #007BFF;
            outline: none;
        }

        /* Submit Button */
        .form-container button {
            background-color: #007BFF;
            color: white;
            padding: 14px;
            width: 100%;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }

        /* Alert Box */
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 8px;
            color: white;
            font-size: 14px;
            text-align: left;
        }

        .alert-danger {
            background-color: #e74c3c;
        }

        /* Footer */
        .form-footer {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        .form-footer a {
            color: #007BFF;
            text-decoration: none;
            transition: color 0.3s;
        }

        .form-footer a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <?php if (isset($login_success) && $login_success): ?>
        <script>
            alert("Login successful!");
            window.location.href = "index.php"; // Redirect after alert
        </script>
    <?php endif; ?>

    <div class="form-container">
        <h2>Login to NexGenTech</h2>

        <!-- Display error message -->
        <?php if (isset($error_message) && $error_message): ?>
            <div class="alert alert-danger">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <!-- Login form -->
        <form method="POST" action="">
            <input type="email" name="email" placeholder="Enter your email" required>
            <input type="password" name="password" placeholder="Enter your password" required>
            <button type="submit">Login</button>
        </form>

        <div class="form-footer">
            Don't have an account? <a href="register.php">Register here</a>.
        </div>
    </div>
</body>
</html>
