<?php
// Start a session to track the cart
session_start();

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// List of products
$products = [
    ["name" => "Acer Predator Helios 300", "description" => "Powerful gaming laptop with Intel i7, 16GB RAM, and RTX 3060.", "price" => "₱89,999", "img" => "https://laptopmedia.com/wp-content/uploads/2021/06/1-6-e1622627961554.jpg"],
    ["name" => "Lenovo Legion 5 Pro", "description" => "Gaming powerhouse with AMD Ryzen 7, 16GB RAM, and RTX 3070.", "price" => "₱95,599", "img" => "https://p3-ofp.static.pub//fes/cms/2024/09/12/elsxf6rwrtxudesy107rsj88cg0qhx499173.png"],
    ["name" => "Asus ROG Strix G15", "description" => "Gaming laptop with AMD Ryzen 9, 32GB RAM, and RTX 3080.", "price" => "₱129,999", "img" => "https://dlcdnwebimgs.asus.com/files/media/925D68DF-0BF2-43E8-8268-3BB7C1430A9D/images/product-01.png"],
    ["name" => "HP Omen 15", "description" => "High-performance gaming laptop with Intel i9, 16GB RAM, and RTX 3070.", "price" => "₱109,499", "img" => "https://benson.ph/cdn/shop/products/c05508446_1024x.png?v=1542260219"],
    ["name" => "MSI GE76 Raider", "description" => "Top-tier gaming laptop with Intel i9, 32GB RAM, and RTX 3080.", "price" => "₱149,999", "img" => "https://m.media-amazon.com/images/I/617fteEclkL._AC_SL1200_.jpg"],
    ["name" => "Alienware X17", "description" => "Ultra-slim 17-inch laptop with Intel i7, 16GB RAM, and RTX 3070.", "price" => "₱139,999", "img" => "https://i.ytimg.com/vi/x-Fs-wAmbRY/maxresdefault.jpg"],
    ["name" => "Razer Blade 15", "description" => "Lightweight yet powerful laptop with Intel i7, 16GB RAM, and RTX 3070.", "price" => "₱115,000", "img" => "https://images-na.ssl-images-amazon.com/images/I/71kBeFDgCkL.jpg"],
    ["name" => "Gigabyte AORUS 15G", "description" => "Gaming laptop with Intel i7, 16GB RAM, and RTX 3080.", "price" => "₱129,500", "img" => "https://static.gigabyte.com/StaticFile/Image/Global/eeb4d8cda795161e2f1d2660a3790b9e/Product/26635"],
    ["name" => "Corsair Vengeance LPX 16GB RAM", "description" => "High-performance 16GB DDR4 RAM for gaming and multitasking.", "price" => "₱5,000", "img" => "https://m.media-amazon.com/images/I/51Vu2rp5hSL._AC_SL1024_.jpg"],
    ["name" => "NVIDIA GeForce RTX 3080", "description" => "Top-end GPU for gaming and rendering.", "price" => "₱49,000", "img" => "https://i.ebayimg.com/images/g/-BoAAOSwp45jy0S4/s-l1200.jpg"],
    ["name" => "Samsung 970 EVO Plus 1TB SSD", "description" => "Ultra-fast storage with 1TB capacity for quick load times.", "price" => "₱7,000", "img" => "https://easypc.com.ph/cdn/shop/products/Samsung_970_EVO_Plus_1TB_NVME_M.2_Solid_State_Drive-e_2048x.jpg?v=1701413200"],
    ["name" => "ASUS ROG Strix X570-E Motherboard", "description" => "Premium motherboard for AMD Ryzen processors.", "price" => "₱16,000", "img" => "https://dlcdnwebimgs.asus.com/gain/249D2FDB-BD4E-4DB4-A000-15237DAC1406"],
    ["name" => "Cooler Master Hyper 212 CPU Cooler", "description" => "Reliable air cooling solution for Intel and AMD CPUs.", "price" => "₱3,000", "img" => "https://ecommerce.datablitz.com.ph/cdn/shop/files/hyper-212-halo-white-gallery-04-image.jpg?v=1684144077"],
    ["name" => "Logitech G Pro Wireless Mouse", "description" => "Wireless gaming mouse with high precision.", "price" => "₱3,500", "img" => "https://gameone.ph/media/catalog/product/cache/d378a0f20f83637cdb1392af8dc032a2/4/_/4_3_2.jpg"],
    
    // Added products (new 20 laptops)
    ["name" => "Dell G5 15", "description" => "Affordable gaming laptop with Intel i7, 16GB RAM, and GTX 1660 Ti.", "price" => "₱75,000", "img" => "https://i.dell.com/is/image/DellContent//content/dam/images/products/laptops-and-2-in-1s/g-series/g5-15-5500-non-touch/dg5500nt-cnb-05000ff090-bk-upsell.psd?fmt=pjpg&pscan=auto&scl=1&wid=4000&hei=4000&qlt=100,1&resMode=sharp2&size=4000,4000&chrss=full&imwidth=5000"],
    ["name" => "HP Pavilion Gaming 15", "description" => "Gaming laptop with AMD Ryzen 5, 8GB RAM, and GTX 1650.", "price" => "₱55,000", "img" => "https://m.media-amazon.com/images/I/810gynDZHzL._AC_SL1500_.jpg"],
    ["name" => "Acer Nitro 5", "description" => "Budget-friendly gaming laptop with Intel i5, 8GB RAM, and GTX 1650.", "price" => "₱40,000", "img" => "https://m.media-amazon.com/images/I/81PUD0rM2NL._AC_SL1500_.jpg"],
    ["name" => "MSI GF63 Thin", "description" => "Lightweight gaming laptop with Intel i7, 16GB RAM, and GTX 1650.", "price" => "₱50,000", "img" => "https://asset.msi.com/resize/image/global/product/product_3_20180523133256_5b04fd08de29b.png62405b38c58fe0f07fcef2367d8a9ba1/1024.png"],
    ["name" => "Razer Blade Stealth 13", "description" => "Ultraportable laptop with Intel i7, 16GB RAM, and GTX 1650 Ti.", "price" => "₱65,000", "img" => "https://m.media-amazon.com/images/I/71MGjLfKikL._AC_SL1500_.jpg"],
    ["name" => "Gigabyte Aero 15", "description" => "Powerful laptop with Intel i9, 16GB RAM, and RTX 3080.", "price" => "₱155,000", "img" => "https://m.media-amazon.com/images/I/71MyE5R5joL._AC_UF894,1000_QL80_.jpg"],
    ["name" => "Lenovo ThinkPad X1 Carbon", "description" => "Premium business laptop with Intel i7, 16GB RAM, and integrated graphics.", "price" => "₱85,000", "img" => "https://p3-ofp.static.pub//fes/cms/2024/07/05/05dhzg0lrtq4i0d3wxqyjjakwmbmzr331426.png"],
    ["name" => "Acer Swift 3", "description" => "Ultra-lightweight laptop with Intel i5, 8GB RAM, and integrated graphics.", "price" => "₱45,000", "img" => "https://images.acer.com/is/image/acer/acer-laptop-swift-3-as-bright-as-it-is-brilliant-l-1?$"],
    ["name" => "Dell Inspiron 15", "description" => "Everyday laptop with Intel i3, 4GB RAM, and integrated graphics.", "price" => "₱35,000", "img" => "https://images-cdn.ubuy.co.in/633aae8db52ac20d0b37956e-dell-inspiron-15-3000-laptop-2021.jpg"],
    ["name" => "HP Envy 13", "description" => "Compact ultrabook with Intel i5, 8GB RAM, and Intel UHD graphics.", "price" => "₱60,000", "img" => "https://ssl-product-images.www8-hp.com/digmedialib/prodimg/lowres/c06582345.png"],
    ["name" => "Asus ZenBook Flip 14", "description" => "Convertible laptop with Intel i7, 16GB RAM, and integrated graphics.", "price" => "₱75,000", "img" => "https://dlcdnwebimgs.asus.com/gain/d714fd86-71fc-4447-94d5-e5df7fea4ba7/"],
    ["name" => "Apple MacBook Air M2", "description" => "Apple's ultralight laptop with M2 chip, 8GB RAM, and Retina display.", "price" => "₱75,000", "img" => "https://electroworld.abenson.com/media/catalog/product/1/8/183885_2022.jpg"],
    ["name" => "Microsoft Surface Laptop 4", "description" => "Stylish laptop with Intel i5, 8GB RAM, and Intel Iris Xe.", "price" => "₱70,000", "img" => "https://i5.walmartimages.com/seo/Microsoft-Surface-Laptop-4-13-inch-i7-16GB-512GB-Windows-10-Ice-Blue-Alcantara-Free-Upgrade-to-Windows-11_573cbd44-575b-4376-815e-fee70034cd5c.5832d2e2b2a86842be6259552981c378.jpeg"],
    ["name" => "Asus TUF Gaming A15", "description" => "Budget gaming laptop with AMD Ryzen 5, 8GB RAM, and GTX 1650.", "price" => "₱55,000", "img" => "https://dlcdnwebimgs.asus.com/gain/5cd95cf4-afde-4319-9d83-d95a6fbaec3f/w800"],
    ["name" => "Lenovo IdeaPad Gaming 3", "description" => "Entry-level gaming laptop with Intel i5, 8GB RAM, and GTX 1650.", "price" => "₱48,000", "img" => "https://d1rlzxa98cyc61.cloudfront.net/catalog/product/cache/1801c418208f9607a371e61f8d9184d9/1/8/185194_2022.jpg"],
    ["name" => "Acer Aspire 5", "description" => "Affordable laptop with Intel i5, 8GB RAM, and integrated graphics.", "price" => "₱42,000", "img" => "https://d1rlzxa98cyc61.cloudfront.net/catalog/product/cache/1801c418208f9607a371e61f8d9184d9/1/8/188909_2023.jpg"],
    ["name" => "HP Spectre x360", "description" => "Premium 2-in-1 laptop with Intel i7, 16GB RAM, and Intel Iris Xe.", "price" => "₱90,000", "img" => "https://img-cdn.tnwcdn.com/image?fit=1200%2C675&height=675&url=https%3A%2F%2Fcdn0.tnwcdn.com%2Fwp-content%2Fblogs.dir%2F1%2Ffiles%2F2021%2F08%2FHP-Spectre-x360-14-1-of-7.jpg&signature=be2373b43e1088c3457ffd4f53fd987a"],
    ["name" => "MSI Prestige 14", "description" => "Slim and stylish laptop with Intel i7, 16GB RAM, and GTX 1650.", "price" => "₱78,000", "img" => "https://m.media-amazon.com/images/I/51PKodbunEL._AC_SL1024_.jpg"],
    ["name" => "Huawei MateBook D 14", "description" => "Slim laptop with AMD Ryzen 5, 8GB RAM, and integrated graphics.", "price" => "₱45,000", "img" => "https://www.gilb.com.ph/wp-content/uploads/2022/07/MateBook-D14-i3-10th-gen.jpg"]
];

// Check if the user is logged in
$logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;

// Handle Add to Cart
if (isset($_GET['add_to_cart'])) {
    if (!$logged_in) {
        // Redirect to login page if not logged in
        header('Location: login.php?redirect=shop.php');
        exit;
    }

    $product_name = $_GET['add_to_cart'];
    foreach ($products as $product) {
        if ($product['name'] == $product_name) {
            // Add product to cart
            $_SESSION['cart'][] = $product;
            // Redirect to shop page after adding to cart
            header("Location: shop.php");
            exit;
        }
    }
}

// Handle Buy Now
if (isset($_GET['buy_now'])) {
    if (!$logged_in) {
        // Redirect to login page if not logged in
        header('Location: login.php?redirect=shop.php');
        exit;
    }

    $product_name = $_GET['buy_now'];
    foreach ($products as $product) {
        if ($product['name'] == $product_name) {
            // Proceed to checkout or display a message
            echo "<script>alert('Proceeding to buy: {$product['name']} for {$product['price']}');</script>";
            // In a real application, you would redirect to the checkout page or process the order here
            break;
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laptop Shop</title>
    <style>
        /* Basic Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body Styling */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f8f8f8;
    color: #333;
    height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    padding-top: 60px; /* Adds padding for fixed navbar */
}

/* Navigation Styling */
nav {
    background-color: #38c8a8; /* Updated to #38c8a8 */
    padding: 15px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 10;
}

.logo {
    font-size: 32px;
    font-weight: 700;
    color: white;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.nav-links {
    list-style: none;
    display: flex;
    margin-left: auto;
}

.nav-links li {
    margin-left: 30px;
}

.nav-links a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    font-weight: 500;
    transition: color 0.3s ease, transform 0.3s ease;
}

.nav-links a:hover {
    color: #fff;
    transform: translateY(-5px);
}

.cart {
    font-size: 22px;
    position: relative;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.cart:hover {
    transform: scale(1.2);
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

/* Product List Styling */
#product-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); /* Allows items to adjust for various screen sizes */
    gap: 20px;
    padding: 20px;
    width: 90%;
    max-width: 1200px; /* Keeps the grid centered and ensures it doesn't stretch too much on large screens */
}

/* Product Card Styling */
.product-card {
    background-color: white;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    animation: fadeIn 1s ease-out;
}

.product-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
}

.product-card img {
    width: 100%;
    height: 180px;
    border-radius: 12px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover img {
    transform: scale(1.05);
}

.product-card h3 {
    font-size: 20px;
    margin: 15px 0;
    font-weight: 700;
    color: #333;
}

.price {
    font-size: 22px;
    font-weight: 600;
    color: #38c8a8; /* Updated to #38c8a8 */
    margin: 10px 0;
}

.button-container {
    display: flex;
    justify-content: center;
    gap: 15px;
}

.button-container button {
    background-color: #38c8a8; /* Updated to #38c8a8 */
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
    font-size: 16px;
    font-weight: bold;
}

.button-container button:hover {
    background-color: #2bb9a1; /* Slightly darker teal */
    transform: scale(1.05);
}

/* Footer Styling */
.footer {
    background-color: rgba(255, 255, 255, 0.9);
    color: #333;
    text-align: center;
    padding: 30px 0;
    width: 100%;
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
    margin-top: auto;
}

.footer a {
    color: #38c8a8; /* Updated to #38c8a8 */
    text-decoration: none;
    margin: 0 10px;
    font-size: 16px;
}

.footer a:hover {
    text-decoration: underline;
}

/* Keyframe Animations */
@keyframes fadeIn {
    0% { opacity: 0; }
    100% { opacity: 1; }
}

@keyframes slideIn {
    0% { transform: translateX(100%); }
    100% { transform: translateX(0); }
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
        <li><a href="cart.php" id="cart-icon" class="cart">🛒 <span id="cart-count"><?= count($_SESSION['cart']) ?></span></a></li>
    </ul>
</nav>

<!-- Product Cards -->
<div id="product-list">
    <?php foreach ($products as $product): ?>
        <div class="product-card">
            <img src="<?= $product['img'] ?>" alt="<?= $product['name'] ?>">
            <h3><?= $product['name'] ?></h3>
            <p><?= $product['description'] ?></p>
            <div class="price"><?= $product['price'] ?></div>
            <div class="button-container">
                <a href="?add_to_cart=<?= urlencode($product['name']) ?>">
                    <button>Add to Cart</button>
                </a>
                <a href="checkout.php?buy_now=<?= urlencode($product['name']) ?>&redirect=shop.php">
                    <button>Buy Now</button>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Footer -->
<div class="footer">
    <p>&copy; 2024 Laptop Shop. All Rights Reserved.</p>
    <p><a href="privacy-terms.php">Privacy Policy</a> | <a href="privacy-terms.php">Terms & Conditions</a></p>
</div>

</body>
</html>
