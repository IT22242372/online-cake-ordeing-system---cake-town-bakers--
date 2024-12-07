<?php
  session_start();
  if ($_SESSION['loggedin']!=true) {
    header("Location: login.php");
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caketown Bakers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #dcdcdc;
            padding: 10px 20px;
        }

        .logo img {
            height: 52px;
        }

        .navbar {
            display: flex;
            align-items: center;
        }

        .navbar a {
            margin: 0 40px; /* Adjust margin as needed */
            text-decoration: none;
            color: black;
            font-weight: bold;
            position: relative;
        }

        .navbar a:not(:last-child)::after {
            content: "|"; /* Vertical line separator */
            position: absolute;
            right: -50px; /* Adjust to position the separator */
            top: 50%; /* Vertically center the separator */
            transform: translateY(-50%); /* Center the separator vertically */
            color: black;
            font-weight: bold;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .icons img {
            height: 24px;
            width: 24px;
            margin-left: 15px;
        }

        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f5f5f5;
        }

        .main-content img {
            width: 100vw;
            height: 582px;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            background-color: #dcdcdc;
            font-size: 0.8rem;
            padding: 0.4rem;
        }

        .footer a {
            font-weight: bold;
            text-decoration: none;
            color: black;
        }

        .footer p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="images/logo.jpeg" alt="Caketown Bakers Logo">
        </div>
        <nav class="navbar">
            <a href="">User account management</a>
            <a href="inventory/productAdmin.php">Inventory management</a>
            <a href="./checkoutRecord.php">Payment management</a>
           
        </nav>
        <div class="icons">
            <?php echo "<label class='user_name'>" . $_SESSION['fname'] ."</label>"; ?>
            
            <a href="profile.php"><img src="images/my-account-login.png" alt="User Profile"></a>
            <img src="images/60992.png" alt="Shopping Cart">
            <a href="logout.php"><img src="images/logout.png" alt="logout"></a>
        </div>
    </div>

    <div class="main-content">
        <img src="images/admincake.webp" alt="Admin Image">
    </div>

    <div class="footer">
        <div class="about-us">
            <a href="#">About us</a>
            <p>All of our products are made from scratch using family recipes with only the highest quality ingredients.</p>
            <p>We bake and sell fresh daily to ensure only the best products are sold to our customers with full of love.</p>
        </div>
        <div class="contact-info">
            <a href="#">Contact information</a>
            <p>Contact Number: 0714772023</p>
            <p>Email: caketownbakers@gmail.com</p>
        </div>
    </div>
</body>

</html>
