<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include 'dbconnection.class.php';
$dbconnect = new Dbconnection();
$username = $_SESSION['username'];

$sql = 'SELECT * FROM purchases WHERE username = ?';
$query = $dbconnect->prepare($sql);
$query->execute([$username]);
$purchases = $query->fetchAll(2);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>GraphicsLand - Purchase History</title>
</head>
<body>
    <!--Navbar-->
    <ul id="line">
        <li><a class="active" href="index.php">Home</a></li>
        <li class="logo"><img src="IMG/graphicsland_logo.png" style="width: 170px;" alt="Logo"></li>
        <li style="float:right"><a href="cart.php">Cart</a></li>
        <li style="float:right"><a href="products.php">Products</a></li>
        <li style="float:right"><a href="logout.php">Logout</a></li>
        <li style="float:right"><a href="#" id="userMenu"><?php echo $_SESSION['username']; ?></a></li>
    </ul>
    <ul class="line"></ul>
    <div class="container">
        <h1>Purchase History</h1>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Date</th>
            </tr>
            <?php
            foreach ($purchases as $purchase) {
                echo "<tr>";
                echo "<td>" . $purchase['productname'] . "</td>";
                echo "<td>" . $purchase['quantity'] . "</td>";
                echo "<td>$" . $purchase['price'] . "</td>";
                echo "<td>" . $purchase['date'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
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
