<?php
session_start();

// Initialize the cart if it doesn’t exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle removing items from the cart
if (isset($_GET['remove_from_cart'])) {
    $product_name = $_GET['remove_from_cart'];
    foreach ($_SESSION['cart'] as $key => $product) {
        if ($product['name'] == $product_name) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
    // Reindex the array to maintain order after removing an item
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

// Handle the checkout process
$thank_you_message = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkout'])) {
    $name = htmlspecialchars($_POST['name']);
    $payment_method = htmlspecialchars($_POST['payment_method']);

    // Handle payment method
    if ($payment_method == 'paypal') {
        $payment_message = "You selected PayPal as your payment method.";
    } elseif ($payment_method == 'gcash') {
        $payment_message = "You selected GCash as your payment method.";
    } elseif ($payment_method == 'cash_on_delivery') {
        $payment_message = "You selected Cash on Delivery as your payment method.";
    }

    // Clear the cart
    $_SESSION['cart'] = [];
    $thank_you_message = "Thank you, $name! Your order has been successfully placed. $payment_message";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        nav {
            background-color: #ff5c5c; /* Shopee Red */
            color: white;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            color: white;
            text-transform: uppercase;
        }

        .nav-links {
            list-style: none;
            display: flex;
        }

        .nav-links li {
            margin-left: 25px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
        }

        .cart {
            font-size: 22px;
            position: relative;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .cart:hover {
            transform: scale(1.1);
        }

        .cart span {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #007BFF;
            color: white;
            border-radius: 50%;
            padding: 5px 10px;
            font-size: 14px;
        }

        /* Shopping Cart Styles */
        .cart-items-container {
            margin-top: 90px;
            padding: 20px;
        }

        .cart-item {
            background-color: white;
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-item img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
        }

        .cart-item h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .cart-item p {
            font-size: 14px;
            color: #888;
        }

        .cart-item button {
            background-color: #ff5c5c; /* Shopee Red */
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .cart-item button:hover {
            background-color: #ff1c1c;
        }

        .checkout-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 15px;
            width: 200px;
            margin: 20px auto;
            border-radius: 5px;
            text-align: center;
            font-size: 18px;
            cursor: pointer;
        }

        .checkout-btn:hover {
            background-color: #45a049;
        }

        .empty-cart {
            text-align: center;
            margin: 50px 0;
        }

        .payment-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            width: 320px;
        }

        .payment-form input,
        .payment-form div {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .payment-form button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 15px;
            width: 100%;
            margin-top: 10px;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        .payment-form button:hover {
            background-color: #45a049;
        }
        .payment-form img {
        width: 40px; /* Set the width of the images */
        height: auto; /* Maintain aspect ratio */
        margin-right: 10px; /* Add spacing between the image and text */
        vertical-align: middle; /* Align the image with text */
        border-radius: 5px; /* Optional: Add rounded corners */
    }

    .payment-form label {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .payment-form input[type="radio"] {
        margin-right: 10px;
    }

        .thank-you {
            text-align: center;
            margin: 50px;
        }
    </style>
</head>
<body>

<!-- Navigation Bar -->
<nav>
    <div class="logo">NEXTGEN TECH</div>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="shop.php">Shop</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="cart.php" class="cart">🛒 <span id="cart-count"><?= count($_SESSION['cart']) ?></span></a></li>
    </ul>
</nav>

<!-- Thank You Message -->
<?php if ($thank_you_message): ?>
    <div class="thank-you">
        <h1>Thank You!</h1>
        <p><?= $thank_you_message ?></p>
        <a href="shop.php"><button class="checkout-btn">Back to Shop</button></a>
    </div>
<?php else: ?>

<!-- Cart Items -->
<div class="cart-items-container">
    <?php if (count($_SESSION['cart']) > 0): ?>
        <?php foreach ($_SESSION['cart'] as $product): ?>
            <div class="cart-item">
                <img src="<?= $product['img'] ?>" alt="<?= $product['name'] ?>">
                <div>
                    <h3><?= $product['name'] ?></h3>
                    <p><?= $product['price'] ?></p>
                </div>
                <a href="?remove_from_cart=<?= urlencode($product['name']) ?>">
                    <button>Remove</button>
                </a>
            </div>
        <?php endforeach; ?>

        <div class="payment-form">
    <h2>Enter Payment Details</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <label for="paypal">
            <input type="radio" id="paypal" name="payment_method" value="paypal" required>
            <img src="https://play-lh.googleusercontent.com/xOKbvDt362x1uzW-nnggP-PgO9HM4L1vwBl5HgHFHy_n1X3mqeBtOSoIyNJzTS3rrj70" alt="PayPal">
            PayPal
        </label>
        <label for="gcash">
            <input type="radio" id="gcash" name="payment_method" value="gcash" required>
            <img src="https://gadgetsmagazine.com.ph/wp-content/uploads/2020/05/GCASH-logo.jpg" alt="GCash">
            GCash
        </label>
        <label for="cod">
            <input type="radio" id="cod" name="payment_method" value="cash_on_delivery" required>
            <img src="https://cdn-icons-png.flaticon.com/512/5278/5278592.png" alt="Cash on Delivery">
            Cash on Delivery
        </label>
        <button type="submit" name="checkout">Proceed to Checkout</button>
    </form>
</div>
    <?php else: ?>
        <div class="empty-cart">
            <h2>Your cart is empty!</h2>
            <a href="shop.php"><button class="checkout-btn">Go to Shop</button></a>
        </div>
    <?php endif; ?>
</div>

<?php endif; ?>

</body>
</html>
