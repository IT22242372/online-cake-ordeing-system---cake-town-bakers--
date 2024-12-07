<?php
include '../config.php';
include 'includes/auth.php';

// Fetch all cakes from the database
$cakesQuery = $conn->query("SELECT id, name, image, price FROM cakes");
$cakes = [];
while ($row = $cakesQuery->fetch_assoc()) {
    $cake_id = $row['id'];
    
    // Fetch the average rating for each cake
    $ratingQuery = $conn->query("SELECT AVG(rating) AS average_rating FROM comments WHERE cake_id = $cake_id");
    $averageRating = $ratingQuery->fetch_assoc()['average_rating'];
    $averageRating = round($averageRating, 1); // Round to 1 decimal place

    $cakes[] = [
        'id' => $cake_id,
        'name' => $row['name'],
        'image' => $row['image'],
        'price' => $row['price'],
        'link' => "review.php?cake_id={$cake_id}",
        'rating' => $averageRating
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif; 
            background: #fef9e5;
            color: #333; 
            margin: 0; 
            padding: 0; 
            display: flex; 
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }
        .header {
            width: 100%;
            background: #d5bdbd;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header .left {
            display: flex;
            align-items: center;
            margin-left: 50px;
        }
        .header .left img {
            height: 40px;
            margin-right: 180px;
        }
        .header .middle {
            display: flex;
            align-items: center;
        }
        .header .middle a {
            margin: 0 15px;
            text-decoration: none;
            color: #333;
            font-size: 18px;
            padding: 10px 20px;
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
        .header .right .cart img {
            height: 40px;
        }
        .cakes {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .cake-card {
            width: 200px;
            height: 300px;
            text-align: center;
            margin: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #fef9e5;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .cake-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }
        .cake_name {
            background-color: #d9d8d9;
            border-style: solid;
            border-color: #d9d8d9;
            border-radius: 20px;
            padding: 5px;
            margin-top: 5px;
            color: #333;
            font-size: 16px;
            text-decoration: none;
        }
        .rate_button {
            background-color: black;
            border-style: solid;
            border-radius: 20px;
            color: #d9d8d9;
            padding: 10px;
            margin-top: 10px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .rate_button:hover {
            background-color: #e83636;
        }
        .rating {
            margin-top: 10px;
            font-size: 16px;
            color: #000;
            font-weight: bold;
        }
        .star-rating {
            display: inline-block;
            font-size: 16px;
            color: gold;
            margin-right: 5px;
        }
        .price {
            font-size: 18px;
            color: #e83636;
            font-weight: bold;
            margin-top: 5px;
        }

        /* Footer styles */
        .footer {
            width: 100%;
            background-color: #fff;
            padding: 20px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #333;
            font-size: 14px;
        }
        .footer .left, .footer .right {
            padding: 0 30px;
        }
        .footer .left {
            width: 60%;
        }
        .footer .right {
            width: 40%;
            text-align: right;
        }
        .footer h3 {
            margin-bottom: 5px;
            color: #333;
        }
        .footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
<div class="header">
        <div class="left">
            <img src="images/logo1.png" alt="Cake Logo">
        </div>
        <div class="middle">
            <a href="dashboard.php">Home</a>
            <a href="#">Review</a>
            <a href="#">Inventory Management</a>
        </div>
        
        <div class="right">
            <label class='user_name'><?= $_SESSION['fname'] ?></label>
            <img src="images/user.png" alt="User Profile">
            <div class="cart">
                <img src="images/cart.png" alt="Cart" style="padding-right: 20px;">
            </div>


            <form method="POST" action="../logout.php" style="margin: 0;">
                <button type="submit" style="background: none; border: none; cursor: pointer;">
                    <img src="images/exit.png" alt="Logout" title="Logout">
                </button>
            </form>


        </div>
    </div>

<div class="cakes">
    <?php foreach ($cakes as $cake): ?>
        <div class="cake-card">
            <a style="text-decoration: none;" href="<?= $cake['link'] ?>">
                <img src="<?= $cake['image'] ?>" alt="<?= $cake['name'] ?>">
                <h2 class="cake_name"><?= $cake['name'] ?></h2>
                <div class="price">$<?= number_format($cake['price'], 2) ?></div>
                <button class="rate_button">Add Rating</button>
                <div class="rating">
                    <span class="star-rating">&#9733;</span> <?= number_format($cake['rating'], 1) ?> / 5
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>

<div class="footer" style="margin-top :40px;">
    <div class="left">
        <h3>About us</h3>
        <p>All of our products are made from scratch using </p>
        <p>family recipes with only the highest quality</p>
        <p>ingredients. We bake and sell fresh daily to ensure</p> 
        <p>only the best products are sold to our customers.</p>
    </div>
    <div class="right">
        <h3>Contact information</h3>
        <p>Contact Number: 0714772023</p>
        <p>Email: caketownbakers@gmail.com</p>
    </div>
</div>

</body>
</html>


























































<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    
    <!-- Link to external CSS stylesheets -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="home.css">

</head>
<body>
    
    <!-- Navigation Bar -->
    <div class="header">

    <img src="images/logo.jpeg" alt="Left Logo" class="logo-left">
		
        <!-- Horizontal Menu -->
        <ul class="nav">
            <li class="list"><a href="./customer.php">Home</a></li>
            <li class="list"><a href="#">Products</a></li>
            <li class="list"><a href="">Reviews</a></li>

        </ul>

        <!-- Shopping Cart Icon and Quantity -->
        <header class="logo-right">
            <div class="iconCart">
                <img src="icon.png">
                <div class="totalQuantity">0</div>
            </div>
        </header>
   </div>
<br><br>

        <!-- Product List Section -->
        <div class="container">
        <div class="listProduct">
            <div class="item">
                <img src="images/chocolate cake.jpeg" alt="">
                <h2>CoPilot / Black / Automatic</h2>
                <div class="price">Rs.550</div>
                <button>Add To Cart</button>
            </div>
        </div>
    </div>

    <!-- Cart Section -->
    <div class="cart">
        <h2>CART</h2>
        <div class="listCart">
            <div class="item">
                <img src="images/vanila cake.jpeg">
                <div class="content">
                    <div class="name">CoPilot / Black / Automatic</div>
                    <div class="price">Rs.550 / 1 product</div>
                </div>
                <div class="quantity">
                    <button>-</button>
                    <span class="value">3</span>
                    <button>+</button>
                </div>
            </div>
        </div>
        <div class="buttons">
            <div class="close">CLOSE</div>
            <div class="checkout">
                <a href="checkout.php">CHECKOUT</a>
            </div>
        </div>
    </div>
    <br><br><br>
    <p class="copyright"> &copy; All Rights Reserved by CakeTownBakers (Pvt) Ltd.</p>
    
    <!-- Link to external JavaScript file -->
    <script src="app.js"></script>

</body>
</html>
