<?php
session_start();
include 'dbconnection.class.php';
$dbconnect = new Dbconnection();
$sql = 'SELECT * FROM products';
$query = $dbconnect->prepare($sql);
$query->execute();
$recset = $query->fetchAll(2);

// Check if user is logged in
if (isset($_SESSION['username'])) {
    $loginLink = '<li style="float:right"><a href="#" id="userMenu">' . $_SESSION['username'] . '</a></li>';
    $logoutLink = ''; // The logout link will be in the popup
} else {
    $loginLink = '<li style="float:right"><a href="login.php">Login</a></li>';
    $logoutLink = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>GraphicsLand - Products</title>
    <style>
        /* Popup container - can be anything you want */
        .popup {
            position: fixed;
            display: none;
            width: 300px;
            height: 200px;
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            z-index: 1000;
            top: 25%;
            left: 90%;
            transform: translate(-50%, -50%);
            padding: 20px;
            text-align: center;
        }
        .popup-header {
            font-weight: bold;
        }
        .popup button {
            margin-top: 10px;
        }
        .popup-close {
            position: absolute;
            top: 5px;
            right: 10px;
            cursor: pointer;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <!--Navbar-->
    <ul id="line">
        <li><a class="active" href="index.php">Home</a></li>
        <li class="logo"><img src="IMG/graphicsland_logo.png" style="width: 170px;" alt="Logo"></li>
        <li style="float:right"><a href="cart.php">Cart</a></li>
        <?php echo $loginLink; ?>
        <?php echo $logoutLink; ?>
        <li style="float:right"><a href="products.php">Products</a></li>
    </ul>
    <ul class="line"></ul>
    <div class="filter">
        <form action="index.php" method="get">
            <label for="category">Category:</label>
            <select name="category" id="category">
                <option value="">All</option>
                <option value="Category 1">Nvidia Geforce</option>
                <option value="Category 2">AMD Radeon</option>
                <option value="Category 3">Intel Arc</option>
            </select>
            <label for="min_price">Min Price:</label>
            <input type="number" name="min_price" id="min_price" step="0.01">
            <label for="max_price">Max Price:</label>
            <input type="number" name="max_price" id="max_price" step="0.01">
            <button type="submit">Filter</button>
        </form>
    </div>
    <div class="products">
        <?php
        foreach($recset as $row) {
            echo "<div class='product'>";
            echo '<center><img style="float:left" src="IMG/placeholder.jpg" alt="Image"></center>';
            echo "<h2>" . $row['productname'] . "</h2>";
            echo "<p>Category: " . $row['manufacturer'] . "</p>";
            echo "<p>Price: $" . $row['price'] . "</p>";
            echo "<p>Stock: " . $row['stock'] . "</p>";
            echo "<p>Description: " . $row['description'] . "</p><hr>";
            echo "<button><b>View product</b></button>"; 
            echo "<button><b>Add to cart</b></button>"; 
            echo "</div>";
        }
        ?>
    </div>
    
    <!-- Popup for logged-in user options -->
    <div id="userPopup" class="popup">
        <span class="popup-close" onclick="closePopup()">&times;</span>
        <div class="popup-header">User Menu</div>
        <button onclick="window.location.href='logout.php'">Logout</button>
        <button onclick="window.location.href='purchase_history.php'">Purchase History</button>
    </div>

    <script>
        document.getElementById('userMenu').addEventListener('click', function() {
            document.getElementById('userPopup').style.display = 'block';
        });

        function closePopup() {
            document.getElementById('userPopup').style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('userPopup')) {
                document.getElementById('userPopup').style.display = 'none';
            }
        }
    </script>
</body>
</html>
