<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>GraphicsLand - Home</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<title>Responsive Card Slider</title>-->

    <!-- Swiper CSS -->

</head>
<body>
    <!-- Navbar -->
    <ul id="line">
        <li><a class="active" href="index.php">Home</a></li>
        <li style="float:right"><a href="cart.php">Cart</a></li>
        <?php if (isset($_SESSION['user_id'])): ?>
            <li style="float:right"><a href="logout.php">Logout</a></li>
            <li style="float:right"><a href="#"><?php echo htmlspecialchars($_SESSION['username']); ?></a></li>
        <?php else: ?>
            <li style="float:right"><a href="login.php">Login</a></li>
        <?php endif; ?>
        <li style="float:right"><a href="products.php">Products</a></li>
    </ul>
    <ul class="line"></ul>

    <!-- Slideshow -->
    <center>
        <br>
        <div class="slideshow-container">
            <div class="mySlides fade">
                <img src="img/pexels-ann-h-14936128.jpg" style="width:80%">
            </div>
            <div class="mySlides fade">
                <img src="img/pexels-ann-h-14936128.jpg" style="width:80%">
            </div>
            <div class="mySlides fade">
                <img src="img/pexels-ann-h-14936128.jpg" style="width:80%">
            </div>
            <div class="dot-container">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>
        </div>
        <br>
    </center>
</body>
<script src="script.js"></script>
</html>
