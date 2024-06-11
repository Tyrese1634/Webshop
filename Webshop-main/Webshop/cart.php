<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleshoppingcart.css">
    <title>GraphicsLand - Shopping cart</title>
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

    <!-- Page Content -->
    <div class="container">
        <center><h1 style="color: darkgreen;">Shopping cart</h1></center>
        <main>
            <div class="cart-item">
                <div class="item-info">
                    <img src="https://via.placeholder.com/150" alt="Product Image">
                    <div>
                        <h2>Product Name</h2>
                        <p>Price: $10.00</p>
                    </div>
                </div>
                <div class="item-actions">
                    <input type="number" value="1" min="1">
                    <button class="remove-btn">Remove</button>
                </div>
            </div>
            
            <div class="cart-item">
                <div class="item-info">
                    <img src="https://via.placeholder.com/150" alt="Product Image">
                    <div>
                        <h2>Product Name</h2>
                        <p>Price: $20.00</p>
                    </div>
                </div>
                <div class="item-actions">
                    <input type="number" value="1" min="1">
                    <button class="remove-btn">Remove</button>
                </div>
            </div>
        </main>
        
        <footer>
            <div class="total">
                <h2>Total: $30.00</h2>
            </div>
            <a class="checkout-btn" href="check.php">Checkout</a>
        </footer>
    </div>
</body>
<script src="script.js"></script>
</html>
