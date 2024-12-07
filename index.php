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
            font-family: 'Roboto', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        .header {
            width: 100%;
            background: #e7e7e7;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 0;
            margin-top: 10px;
        }

        .header .left {
            display: flex;
            align-items: center;
        }

        .header .left img {
            height: 90px;
            margin-right: 180px;
            width: 120px;
        }

        .header .middle {
            display: flex;
            align-items: center;
            margin-right: 100px;
        }

        .header .middle a {
            margin: 0 15px;
            text-decoration: none;
            color: #333;
            font-size: 20px;
            padding: 5px 10px;
            border-radius: 30px;
            transition: background 0.3s;
        }

        .header .middle a:hover {
            background: #af4740;
            color: #fff;
        }

        .header .right {
            display: flex;
            align-items: center;
        }

        .header .right img {
            height: 40px;
            margin-right: 20px;
            border-radius: 50%;
        }

        
        header .iconCart {
            position: relative;
            z-index: 1;
            
            margin-left: 190px;
        }

        header .totalQuantity {
            position: absolute;
            top: 0;
            right: 0;
            padding: 15px;

            font-size: large;
            background-color: #b31010;
            width: 0.1px;
            height: 0.1px;
            color: #fff;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 100%;
            transform: translateX(20px);
        }

        .cart .buttons {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            text-align: center;
        }

        .cart .buttons div {
            background-color: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            cursor: pointer;
        
        }

        .cart .buttons a {
            color: #fff;
            text-decoration: none;
            margin-left: 100px;
        }

        .checkoutLayout {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 50px;
            padding: 20px;
        }

        .checkoutLayout .right {
            background-color: #5358B3;
            border-radius: 20px;
            padding: 40px;
            color: #fff;
        }

        .checkoutLayout .right .form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            border-bottom: 1px solid #7a7fe2;
            padding-bottom: 20px;
        }

        .checkoutLayout .form h1,
        .checkoutLayout .form .group:nth-child(-n+3) {
            grid-column-start: 1;
            grid-column-end: 3;
        }

        .checkoutLayout .form input,
        .checkoutLayout .form select {
            width: 100%;
            padding: 10px 20px;
            box-sizing: border-box;
            border-radius: 20px;
            margin-top: 10px;
            border: none;
            background-color: #6a6fc9;
            color: #fff;
        }

        .checkoutLayout .right .return .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .checkoutLayout .right .return .row div:nth-child(2) {
            font-weight: bold;
            font-size: x-large;
        }

        .buttonCheckout {
            width: 100%;
            height: 40px;
            border: none;
            border-radius: 20px;
            background-color: #49D8B9;
            margin-top: 20px;
            font-weight: bold;
            color: #fff;
        }


        .returnCart h1 {
            border-top: 1px solid #eee;
            padding: 20px 0;
        }

        .returnCart .list .item img {
            height: 80px;
        }

        .returnCart .list .item {
            display: grid;
            grid-template-columns: 80px 1fr 50px 80px;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
            padding: 0 10px;
            box-shadow: 0 10px 20px #5555;
            border-radius: 20px;
        }

        .returnCart .list .item .name,
        .returnCart .list .item .returnPrice {
            font-size: large;
            font-weight: bold;
        }


        .returnCart .list .item .info {
            width: 150spx;
        }

        .main-content {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 50px;
        }

        .main-content .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border-radius: 20px;
            max-width: 1200px;
            width: 90%;
        }

        .main-content .container .text-content {
            padding: 20px;
        }

        .main-content .container h1 {
            font-size: 48px;
            font-weight: bold;
            color: #af4740;
        }

        .main-content .container p {
            font-size: 18px;
            color: #555;
            margin-top: 20px;
            line-height: 1.6;
        }

        .main-content .container .btn {
            display: inline-block;
            background-color: #af4740;
            color: #fff;
            padding: 15px 30px;
            text-align: center;
            border-radius: 30px;
            font-size: 18px;
            text-decoration: none;
            margin-top: 30px;
            transition: background 0.3s;
        }

        .main-content .container .btn:hover {
            background-color: #d8604d;
        }

        .main-content .container img {
            width: 100%;
            height: auto;
            border-radius: 20px;
        }

        .featured-cakes {
            margin-top: 50px;
            text-align: center;
        }

        .featured-cakes h2 {
            font-size: 36px;
            font-weight: bold;
            color: #333;
            margin-bottom: 30px;
        }

        .featured-cakes .cakes-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .cake-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s;
        }

        .cake-card img {
            width: 100%;
            height: auto;
            border-radius: 15px;
        }

        .cake-card h3 {
            font-size: 24px;
            color: #af4740;
            margin-top: 15px;
        }

        .cake-card p {
            color: #555;
            margin-top: 10px;
            font-size: 16px;
        }

        .cake-card:hover {
            transform: translateY(-10px);
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="left">
            <img src="images/logo.jpeg" alt="Left Logo" class="logo-left">
        </div>
        <div class="middle" style="font-weight: bolder;">
            <a href="index.php">Home</a>
            <a href="inventory/products.php">Products</a>
        </div>

    
        <div class="right">
            <label class='user_name'><?= $_SESSION['fname'] ?></label>


          
            <a href="profile.php"><img src="images/user.png" alt="User Profile"></a>

         
            <form method="POST" action="logout.php" style="margin: 0;">
                <button type="submit" style="background: none; border: none; cursor: pointer;">
                    <img src="images/exit.png" alt="Logout" title="Logout">
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="container">
            <div class="text-content">
                <h1>Welcome to CakeTown Bakers!</h1>
                <p>Delicious cakes baked with love and the finest ingredients. Explore our wide variety of cakes for every occasion. Whether it's a birthday, wedding, or just a treat for yourself, we have something special for you!</p>
                <a href="inventory/products.php" class="btn">Shop Now</a>
            </div>
            <div class="image-content">
                <img src="images/cake22.jpg" alt="Customer Image">
            </div>
        </div>
    </div>

    <div class="featured-cakes">
        <h2>Our Best-Selling Cakes</h2>
        <div class="cakes-grid">
            <div class="cake-card">
                <img src="images/cake1.jpg" alt="Cake 1">
                <h3>Chocolate Delight</h3>
                <p>Rich and moist chocolate cake topped with velvety chocolate ganache.</p>
            </div>
            <div class="cake-card">
                <img src="images/cake2.jpg" alt="Cake 2">
                <h3>Vanilla Dream</h3>
                <p>Light and fluffy vanilla cake with a hint of fresh cream.</p>
            </div>
            <div class="cake-card">
                <img src="images/cake3.jpg" alt="Cake 3">
                <h3>Strawberry Bliss</h3>
                <p>Sweet and tangy strawberry cake with fresh strawberry toppings.</p>
            </div>
        </div>
    </div>

    <div style="background-color: #000; width: 100%; height: 40px; display: flex; justify-content: center; align-items: center; text-align: center; color: #fff; font-size: large; margin-top: 20px;">
        <p class="copyright" style="margin: 0;">&copy; All Rights Reserved by CakeTownBakers (Pvt) Ltd.</p>
    </div>

    <script src="app.js"></script>
</body>

</html>
