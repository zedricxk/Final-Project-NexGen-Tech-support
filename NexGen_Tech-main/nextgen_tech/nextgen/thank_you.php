<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        
        body {
            font-family: 'Roboto', sans-serif;
            text-align: center;
            padding: 50px;
        }
        .thank-you-message {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .thank-you-message h1 {
            color: #4caf50;
        }
    </style>
</head>
<body>

<div class="thank-you-message">
    <h1>Thank You for Your Order!</h1>
    <p>Your order has been successfully placed.</p>
    <p>We will notify you once your order is processed.</p>
    <p><a href="shop.php">Go back to the shop</a></p>
</div>

</body>
</html>
