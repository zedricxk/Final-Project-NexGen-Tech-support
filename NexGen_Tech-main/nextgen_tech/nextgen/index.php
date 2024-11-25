<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
    
    $profile_picture = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : 'default-avatar.jpg';
}


if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_picture'])) {
    $target_dir = "uploads/"; 
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

   
    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check !== false) {
      
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
        } else {
            
            if ($_FILES["profile_picture"]["size"] > 2000000) {
                echo "Sorry, your file is too large.";
            } else {
               
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                } else {
                   
                    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                       
                        $_SESSION['profile_picture'] = $target_file;
                        echo "The file " . basename($_FILES["profile_picture"]["name"]) . " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }
    } else {
        echo "File is not an image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NextGen Tech</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body>
   
    <header>
        <div class="head_top">
            <div class="header">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                            <div class="full">
                                <div class="center-desk">
                                <div class="logo">
                                    <a href="index.php">
                                    <img src="https://scontent.xx.fbcdn.net/v/t1.15752-9/465806167_1147571686972169_9047226793384827276_n.png?stp=dst-png_s480x480&_nc_cat=107&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeFVnOWUYQY98MpnWv3zOt6v3AXSS7IY9W7cBdJLshj1bm8B17WeE05z2AaTdeEt1jPIelPNDbzYZCK880CpaTDi&_nc_ohc=7H0OstCWaf0Q7kNvgGE27Vs&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.xx&oh=03_Q7cD1QFEIXwOLfuzoJSzaUA6y8wbIASnHCyaTzbejZfIknXTMQ&oe=676BB013" alt="NextGen Tech Logo" class="logo-img">
                                    </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                            <nav class="navigation navbar navbar-expand-md navbar-dark">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04">
                                    <span class="navbar-toggler-icon"></span>
                                    <button id="theme-button" class="btn btn-light">🌞 Light Mode</button>
                                </button>                               
                                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                                        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                                        <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
                                        <li class="nav-item"><a class="nav-link" href="service.php">Service</a></li>

                                        <?php if (!isset($_SESSION['user_id'])) { ?>
                                            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                                            <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                                        <?php } else { ?>
                                            
                                            <li class="nav-item">
                                                <a class="nav-link" href="account.php">
                                                    <img src="<?php echo $profile_picture; ?>" alt="Profile" class="profile-icon" style="width: 30px; height: 30px; border-radius: 50%;">
                                                    <?php echo $username; ?>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="index.php?logout=true">Logout</a>
                                            </li>                                         
                                           </div>
                                        <?php } ?>
                                    </ul>
                                </div>                               
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="banner_main">
        <div class="container-fluid">
            <div class="row d_flex">
                <div class="col-md-6">
                    <div class="text-bg">
                        <h1>Computer and <br> Laptop Shop</h1>
                        
                        <a href="shop.php" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-img">
                        <figure><img src="https://www.gamespace.com/wp-content/uploads/2019/04/Gaming-PC-vs-Laptop-Which-is-Worth-It.png" alt="Shop Banner" class="img-fluid"/></figure>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>About NexGen Tech</h2>
                        <span>Whether you’re looking to purchase the latest tech or need reliable repair services, we’ve got you covered. Our team of experts is dedicated to providing high-quality products and top-notch repair solutions to keep your devices running like new. From quick turnarounds to affordable prices, we make it easy to get the services and products you need all in one place. Shop with confidence and let us take care of all your tech needs!</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="about_box">
                        <figure><img src="https://media.istockphoto.com/id/928791064/photo/technician-repairing-laptop-computer-closeup.jpg?s=612x612&w=0&k=20&c=QF43BNi5BL9wXRYBbUiRrp-oqnQgM1hsN7XhlHsvTSc=" alt="Repair Service" class="img-fluid"/></figure>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="video-trailer" class="video-trailer bg-dark text-white py-5">
    <div class="container text-center">
        <h2>Watch Our Video Trailer</h2>
        <p>Discover how NextGen Tech is revolutionizing the tech world with top-tier products and services. Watch the trailer now!</p>
        <div class="embed-responsive embed-responsive-16by9">
           
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/c4_dYrxe1JA" allowfullscreen></iframe>
        </div>
    </div>
</section>


    <div id="best" class="best">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Built With The Best</h2>
                        <span>We bring expertise, quality, and innovation to every project. Our commitment is to exceed your expectations with reliable, sustainable, and expertly crafted solutions. Let’s build your dreams with the best – because you deserve nothing less.</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="best_box">
                        <h4>500GB Micro SD Card</h4>
                        <p>[Speed] Read/Write up to 100/60 MB/s, V30 speed grade, Ultra HD (UHD) 4K video recording, UHD 4K gaming.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="best_box">
                        <h4>100GB Internal RAM</h4>
                        <p>Enhance your PC performance with more RAM. Significantly improves speed and responsiveness.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="best_box">
                        <h4>100% High Quality</h4>
                        <p>Top-notch products that guarantee durability and high performance for your tech needs.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="two_box">
        <div class="container-fluid">
            <div class="row d_flex">
                <div class="col-md-6">
                    <div class="two_box_img">
                        <figure><img src="https://www.pcspecialist.co.uk/images/misc/right-laptop.png" alt="Laptop" class="img-fluid"/></figure>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="two_box_img">
                        <h2><span class="offer">15% </span>Off Every Day</h2>
                        <p>🎉 Enjoy 15% Off Every Day! 🎉 Use code <strong>EVERYDAY15</strong> at checkout and save on your entire order.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container text-center">
            <p>&copy; 2024 NextGen Tech | All Rights Reserved.</p>
        </div>
    </footer>

    <script src="js/jquery.min.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const themeButton = document.getElementById("theme-button");
        const body = document.body;

        // Load the saved theme from localStorage
        const savedTheme = localStorage.getItem("theme");
        if (savedTheme) {
            body.classList.add(savedTheme);
            updateButtonText(savedTheme);
        } else {
            body.classList.add("light-theme"); // Default theme
        }

        // Update button text based on the theme
        function updateButtonText(theme) {
            if (theme === "dark-theme") {
                themeButton.textContent = "🌙 Dark Mode";
                themeButton.classList.remove("btn-light");
                themeButton.classList.add("btn-dark");
            } else {
                themeButton.textContent = "🌞 Light Mode";
                themeButton.classList.remove("btn-dark");
                themeButton.classList.add("btn-light");
            }
        }

        // Toggle theme on button click
        themeButton.addEventListener("click", () => {
            if (body.classList.contains("light-theme")) {
                body.classList.replace("light-theme", "dark-theme");
                localStorage.setItem("theme", "dark-theme");
                updateButtonText("dark-theme");
            } else {
                body.classList.replace("dark-theme", "light-theme");
                localStorage.setItem("theme", "light-theme");
                updateButtonText("light-theme");
            }
        });
    });
</script>





    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
