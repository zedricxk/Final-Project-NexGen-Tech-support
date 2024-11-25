<?php

$conn = new mysqli('localhost', 'root', '', 'nextgen_tech');  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);  
    $email = $_POST['email'];

  
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
       
        $error_message = "Account with this email or username already exists.";
    } else {
        
        $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $email);

        if ($stmt->execute()) {
            $success_message = "Registration successful! Redirecting...";
            echo "<script>
                    setTimeout(function() {
                        window.location.href = 'index.php';
                    }, 3000); // 3 seconds delay
                  </script>";
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }

   
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            color: #fff;
        }

        /* Form Container */
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
        .form-container input[type="text"],
        .form-container input[type="password"],
        .form-container input[type="email"] {
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

        /* Success and Error Messages */
        .success-msg {
            color: #4CAF50;
            margin-top: 15px;
            font-size: 14px;
        }

        .error-msg {
            color: #e74c3c;
            margin-top: 15px;
            font-size: 14px;
        }

        /* Footer Styling */
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

<div class="form-container">
    <h2>Create an Account</h2>
    <form method="POST" action="register.php">
        <input type="text" name="username" placeholder="Enter your username" required>
        <input type="password" name="password" placeholder="Enter your password" required>
        <input type="email" name="email" placeholder="Enter your email address" required>
        <button type="submit">Register</button>
    </form>

    <!-- PHP Success/Error Message Integration -->
    <?php if (isset($success_message)) { ?>
        <p class="success-msg"><?php echo $success_message; ?></p>
    <?php } elseif (isset($error_message)) { ?>
        <p class="error-msg"><?php echo $error_message; ?></p>
    <?php } ?>

    <div class="form-footer">
        Already have an account? <a href="login.php">Log in here</a>.
    </div>
</div>

</body>
</html>
