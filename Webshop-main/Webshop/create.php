<?php
require 'dbconnection.class.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo 'Passwords do not match.';
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $pdo = new dbconnection();
        $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
        $stmt->execute([$username, $email, $hashed_password]);
        //echo 'Registration successful!';
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            // Duplicate entry error code
            echo 'Username or email already exists.';
        } else {
            echo 'An error occurred.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>GraphicsLand - Create account</title>
</head>
<body>
    <!--Navbar-->
    <ul id="line">
        <li><a class="active" href="index.php">Home</a></li>
        <li style="float:right"><a href="cart.php">Cart</a></li>
        <li style="float:right"><a href="login.php">Login</a></li>
        <li style="float:right"><a href="products.php">Products</a></li>
    </ul>
    <ul class="line"></ul>
    <center>
    <div class="main">
        <h3 id="white">Create an account</h3>
        <form action="create.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter your Username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your Email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your Password" required>

            <label for="confirm_password">Repeat password:</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Repeat your Password" required>

            <div class="wrap">
                <button style="background-color: darkgreen;" type="submit" id="submit">
                    <b>Submit</b>
                </button>
            </div>
        </form>
        <p id="white">Have an account? 
            <a class="createaccount" href="login.php">Login</a>
        </p>
    </div>
    <br>
    </center>
</body>
</html>
