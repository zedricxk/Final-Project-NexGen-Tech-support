<?php
session_start();


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php?redirect=checkout.php');
    exit;
}


if (isset($_POST['payment_method'])) {
    
    echo "<script>alert('Order placed successfully! Payment Method: " . $_POST['payment_method'] . "');</script>";
    
    $_SESSION['cart'] = []; 
    header('Location: thank_you.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }
        .checkout-container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .product-summary {
            margin-bottom: 20px;
        }
        .product-summary h3 {
            margin-bottom: 10px;
        }
        .payment-methods {
            margin-top: 20px;
        }
        .payment-methods input {
            margin-right: 10px;
        }
        .payment-methods label {
            font-size: 18px;
        }
        .checkout-btn {
            background-color: #ff5722;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        .checkout-btn:hover {
            background-color: #e64a19;
        }
    </style>
</head>
<body>


<div class="checkout-container">
    <h2>Checkout</h2>
    <p><strong>Review your order:</strong></p>

    
    <div class="product-summary">
        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
            <ul>
                <?php foreach ($_SESSION['cart'] as $product): ?>
                    <li><?= $product['name'] ?> - <?= $product['price'] ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Your cart is empty!</p>
        <?php endif; ?>
    </div>

    
    <div class="payment-methods">
        <p><strong>Select Payment Method:</strong></p>
        <form action="checkout.php" method="POST">
            <input type="radio" name="payment_method" value="Credit Card" required> <label>Credit Card</label><br>
            <input type="radio" name="payment_method" value="PayPal" required> <label>PayPal</label><br>
            <input type="radio" name="payment_method" value="Bank Transfer" required> <label>Bank Transfer</label><br><br>

            <button type="submit" class="checkout-btn">Proceed with Payment</button>
        </form>
    </div>
</div>

</body>
</html>
