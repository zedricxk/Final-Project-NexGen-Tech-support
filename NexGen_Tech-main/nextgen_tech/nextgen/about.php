<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap">

    <!-- Custom Styles -->
    <style>
        /* Global Styles */
        body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #38c8a8; /* Set the background color to #38c8a8 */
        color: #fff;
        line-height: 1.6;
}


        a {
            text-decoration: none;
            color: #FF6F61;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Header Section */
        .header {
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            text-align: center;
        }

        .header .logo a {
            font-size: 30px;
            font-weight: 700;
            color: #fff;
            text-transform: uppercase;
        }

        /* About Section */
        .about {
            padding: 100px 20px 50px;
            text-align: center;
        }

        .about h2 {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .about span {
            font-size: 18px;
            color: #f0f0f0;
        }

        .about_box {
            margin: 30px auto;
            max-width: 700px;
            text-align: center;
        }

        .about_box img {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .about_box h3 {
            font-size: 28px;
            margin: 20px 0 10px;
        }

        .about_box p {
            font-size: 18px;
            color: #ddd;
        }

        /* Why Choose Us Section */
        .best {
            padding: 50px 20px;
            text-align: center;
            background: rgba(0, 0, 0, 0.7);
            margin-top: 20px;
        }

        .best h2 {
            font-size: 36px;
            margin-bottom: 15px;
        }

        .best span {
            font-size: 16px;
            color: #bbb;
        }

        .best_box {
            margin-top: 20px;
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            max-width: 600px;
            margin: 30px auto;
            color: #f0f0f0;
        }

        /* Team Section */
        .team {
            padding: 50px 20px;
        }

        .team h2 {
            font-size: 36px;
            margin-bottom: 30px;
        }

        .team-members {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .team-member {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 280px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .team-member img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .team-member h4 {
            font-size: 20px;
            margin: 10px 0;
        }

        .team-member a {
            color: #FF6F61;
            font-size: 18px;
        }

        /* Footer Section */
        .footer {
            background: rgba(0, 0, 0, 0.9);
            color: #ccc;
            padding: 30px 20px;
            text-align: center;
        }

        .footer h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .footer p {
            font-size: 16px;
            color: #bbb;
        }

        .footer a {
            color: #FF6F61;
        }

        .footer a:hover {
            color: #fff;
        }

        .footer .social-icons {
            margin-top: 10px;
        }

        .footer .social-icons a {
            font-size: 20px;
            margin: 0 10px;
            color: #FF6F61;
        }
    </style>
</head>
<body>

<!-- Header -->
<div class="header">
    <div class="logo"><a href="index.php">NextGen Tech</a></div>
</div>

<!-- About Section -->
<div class="about">
    <h2>About Us</h2>
    <span>Our Company Description</span>
    <div class="about_box">
    <img src="https://scontent.xx.fbcdn.net/v/t1.15752-9/462545988_550307771087115_4167908256072547788_n.png?stp=dst-png_p526x395&_nc_cat=100&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeFN_3nM1ryK3hKPCQcE9AfC7OZKXFZCtDbs5kpcVkK0NrisVfUw0dnzabI_jMidjrZEo3m0iZbJmQS9eTIt3Ziv&_nc_ohc=aeQs7DtlJXMQ7kNvgHiFYvU&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.xx&oh=03_Q7cD1QHrzpGAtF0jEEVKG7YLaI6qYXVhfTiKn0Egm7xIn29JhA&oe=676B95B5" alt="About Us" style="width: 400px; height: auto;">
        <h3>We Are Dedicated to Excellence!</h3>
        <p>Our mission is to provide top-quality products and services. We innovate, create, and ensure customer satisfaction at every level.</p>
    </div>
</div>

<!-- Why Choose Us Section -->
<div class="best">
    <h2>Why Choose Us?</h2>
    <span>We stand out for our dedication and attention to detail.</span>
    <div class="best_box">
        <h4>Quality</h4>
        <p>We ensure top-quality in every product and service we offer to our valued customers.</p>
    </div>
</div>

<div class="team">
    <h2>Meet Our Team</h2>
    <div class="team-members">
        
        <div class="team-member">
            <img src="https://scontent.fmnl25-4.fna.fbcdn.net/v/t39.30808-6/465744633_1234619977582055_8234112040751556158_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeGobiNDxEUjwww9UQOTGoTcaFXJPK9tuWJoVck8r225YlXECy-093aEudVRVeT05yxDx42izvWz2Ra00gaqIqjI&_nc_ohc=bMAtiK0kUEcQ7kNvgHueTNd&_nc_zt=23&_nc_ht=scontent.fmnl25-4.fna&_nc_gid=ArXHTFgmajfhwYZA1oE-6iH&oh=00_AYBSC2zf6XUQFqRhOV9rwOHg3bNzPgWYxig7FnGrqohvbA&oe=6745D384" alt="Member 1">
            <h4>Hansol Joseph</h4>
            <p></p>
            <div class="social-icons">
                <a href="https://web.facebook.com/hansoljosep" target="_blank" title="Facebook">Facebook</a>
            </div>
        </div>

       
        <div class="team-member">
            <img src="https://scontent.fmnl25-5.fna.fbcdn.net/v/t39.30808-6/460723976_1328841315158709_3616423074062684124_n.jpg?stp=cp6_dst-jpg&_nc_cat=104&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeGq8ufQHgFHRswGEQeDrO_rysgfRoaZlBrKyB9GhpmUGiR_oXInqTrs2wSn-OoW9Zdi88v1P1SWqOrcfJ9TObqw&_nc_ohc=ccLZwHYrE6wQ7kNvgE_gjF4&_nc_zt=23&_nc_ht=scontent.fmnl25-5.fna&_nc_gid=AZkn2Z1H8v1sceFKbixKf_9&oh=00_AYB3nSRhcHzzBvmXouRhX0duI_sPJNn7LgJw3dTLEDtFwQ&oe=6745D558" alt="Member 2">
            <h4>Geryme Elimino</h4>
            <p></p>
            <div class="social-icons">
                <a href="https://web.facebook.com/GrymGdLmn" target="_blank" title="Facebook">Facebook</a>
            </div>
        </div>

        
        <div class="team-member">
            <img src="https://scontent.fmnl25-2.fna.fbcdn.net/v/t39.30808-6/424967683_7794155757279050_6957034429329792453_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=a5f93a&_nc_eui2=AeFft84fssj_SMWTCBZKv0GYwbRnJNuE2XXBtGck24TZddJtnMFogYGmtEp6iAg7KEx9mYGby-qqL-WK63wzjmnK&_nc_ohc=DCZIF5G46ekQ7kNvgFsNqRy&_nc_zt=23&_nc_ht=scontent.fmnl25-2.fna&_nc_gid=AC5N8yylzAGkQNo0IvX221N&oh=00_AYDQ30KIEdfL2IKwt5ilVrXBRod5eLCV98Ki7muUCUGjmw&oe=6745C0AD" alt="Member 3">
            <h4>Jestine Charles </h4>
            <p></p>
            <div class="social-icons">
                <a href="https://web.facebook.com/jestine517" target="_blank" title="Facebook">Facebook</a>
            </div>
        </div>

 
        <div class="team-member">
            <img src="https://scontent.fmnl25-5.fna.fbcdn.net/v/t39.30808-1/414644701_2048220765545263_8545858888399957587_n.jpg?stp=dst-jpg_s200x200&_nc_cat=104&ccb=1-7&_nc_sid=0ecb9b&_nc_eui2=AeE60xhcuQm4HBCZwrbBmQHEEgePfQR4tLQSB499BHi0tDMOjppehrPdP2sQ6d5ZOAX1SgFuGuiWV5lBX6jccUmB&_nc_ohc=jWyW81Cd3RIQ7kNvgF4Qk5O&_nc_zt=24&_nc_ht=scontent.fmnl25-5.fna&_nc_gid=AqblCtCUiKQIubgiq-ZbzkH&oh=00_AYD_YO70e5lzu2CDwe4IE0B8UB6qQHJbSqHf3EK6InoIxA&oe=6745CA5F" alt="Member 4">
            <h4>Chel Sea Ordoña</h4>
            <p></p>
            <div class="social-icons">
                <a href="https://web.facebook.com/profile.php?id=100010720775747" target="_blank" title="Facebook">Facebook</a>
            </div>
        </div>

    
        <div class="team-member">
            <img src="https://scontent.fmnl9-2.fna.fbcdn.net/v/t39.30808-6/412867189_3150539825254975_5518428374225693525_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeEQ_E1V8GXh7_gPbe8588zHiqFhAvgxH4eKoWEC-DEfh36ZDN1COH0EcPQUzKgZqUfIEugtzqLSkY49PCZsHVVx&_nc_ohc=1jaJEMCO40wQ7kNvgEKAcIF&_nc_zt=23&_nc_ht=scontent.fmnl9-2.fna&_nc_gid=A0sByBQ4hy3P8uXSVtn9xTP&oh=00_AYBe_n8PFHJVIh6hV9haCQyup9SPGM0B1vkNJSI7tXCFew&oe=6749D04B" alt="Member 5">
            <h4>Zedrick Prado </h4>
            <p></p>
            <div class="social-icons">
                <a href="https://web.facebook.com/shadow.fiendako" target="_blank" title="Facebook">Facebook</a>
                
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <h3>Contact Us</h3>
    <p>For inquiries or feedback, feel free to reach out.</p>
    <p>Phone: <strong>09519002480</strong></p>
    <div class="social-icons">
        <a href="https://facebook.com">Facebook</a>
        <a href="https://instagram.com">Instagram</a>
    </div>
    <p>&copy; 2024 NextGen Tech. All Rights Reserved.</p>
</div>

</body>
</html>
