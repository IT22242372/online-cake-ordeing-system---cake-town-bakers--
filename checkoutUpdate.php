<?php
session_start();
include 'config.php';

$user_id = $_SESSION['loggedin_id'];

$stmt = $conn->prepare("SELECT email, fname, lname, contact FROM user WHERE user_id = ?");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$stmt->store_result(); 

if ($stmt->num_rows > 0) { 
    $stmt->bind_result($email, $fname, $lname, $contact); 
    $stmt->fetch(); 
} 
$stmt->close();

if (isset($_GET['updateid'])) {
    $id = $_GET['updateid'];
    $sql = "SELECT * FROM `orders` WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $name = $row['name'];
        $email = $row['email'];
        $address = $row['address'];
        $mobile = $row['mobile'];
        $postal_code = $row['postalCode'];
        $card_number = $row['cardNumber'];
        $card_type = $row['cardType'];
        $exp_date = $row['expDate'];
        $cvv = $row['cvv'];
    }
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $postal_code = $_POST['postalcode'];
    $card_number = $_POST['cardnumber'];
    $card_type = $_POST['cardtype'];
    $exp_date = $_POST['expdate'];
    $cvv = $_POST['cvv'];

    $sql = "UPDATE `orders` SET `name`='$name',`email`='$email',`address`='$address',`mobile`='$mobile',`postalCode`='$postal_code',`cardNumber`='$card_number',`cardType`='$card_type',`expDate`='$exp_date',`cvv`='$cvv' WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('location:checkoutRecord.php');
    } else {
        die("Error: " . mysqli_error($conn));
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./payment.css">
    <link rel="stylesheet" href="./home.css">
    <link rel="stylesheet" href="./p.css">

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
            margin-right: 380px;
            width: 120px;
        }

        .header .middle {
            display: flex;
            align-items: center;
        }

        .header .middle a {
            margin: 0 15px;
            text-decoration: none;
            color: #333;
            margin-left: 80px;
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
    </style>
</head>
<body>
<div class="header">
        <div class="left">
            <img src="./images/logo.jpeg" alt="Left Logo" class="logo-left">
        </div>
        <div class="middle" style="font-weight: bolder;">
            <a href="./index.php">Home</a>
            <a href="#">Products</a>
        </div>
        <header class="logo-right">
        <div class="iconCart">
</div>
        </header>
        <div class="right">
            <label class='user_name'><?= $_SESSION['fname'] ?></label>
            <a href="./profile.php"><img src="./images/user.png" alt="User Profile"></a>
            <form method="POST" action="./logout.php" style="margin: 0;">
                <button type="submit" style="background: none; border: none; cursor: pointer;">
                    <img src="./images/exit.png" alt="Logout" title="Logout">
                </button>
            </form>
        </div>
    </div>

        <div class="payment">
            <div class="card">
                <div class="leftside">
                    <img src="./images/payment.jpg" class="payimage"/>
                </div>
                <div class="rightside">
                <form id="paymentForm" method="POST" action="">
                        <h1><center>CheckOut</center></h1>
                        <h2>Payment Information</h2>
                        <p>Full Name</p>
                        <input type="text" class="inputbox" name="name" id="fullName" value="<?php echo isset($name) ? $name : ''; ?>">

                        <p>E-mail</p>
                        <input type="email" class="inputbox" placeholder="example@example.com" name="email" id="email" value="<?php echo isset($email) ? $email : ''; ?>">

                        <p>Address</p>
                        <input type="text" class="inputbox" name="address" id="address" value="<?php echo isset($address) ? $address : ''; ?>">

                        <div class="exp">
                            <p class="exptext">Phone Number</p>
                            <input type="text" class="inputbox" name="mobile" id="mobileNumber" value="<?php echo isset($mobile) ? $mobile : ''; ?>" />
                            <p class="exptext2">Postal Code</p>
                            <input type="text" class="inputbox" name="postalcode" id="postalCode" value="<?php echo isset($postal_code) ? $postal_code : ''; ?>" />
                        </div>

                        <p>Card Number</p>
                        <input type="text" class="inputbox" name="cardnumber" id="cardNumber" placeholder="1111-2222-3333-4444" value="<?php echo isset($card_number) ? $card_number : ''; ?>">

                        <p>Card Type</p>
                        <select class="inputbox" name="cardtype" id="cardType">
                            <option value="">--Select a Card Type--</option>
                            <option value="Visa" <?php echo (isset($card_type) && $card_type == 'Visa') ? 'selected' : ''; ?>>Visa</option>
                            <option value="Paypal" <?php echo (isset($card_type) && $card_type == 'Paypal') ? 'selected' : ''; ?>>Paypal</option>
                            <option value="MasterCard" <?php echo (isset($card_type) && $card_type == 'MasterCard') ? 'selected' : ''; ?>>MasterCard</option>
                            <option value="AmericanExpress" <?php echo (isset($card_type) && $card_type == 'AmericanExpress') ? 'selected' : ''; ?>>American Express</option>
                        </select>

                        <div class="exp">
                            <p class="exptext">Expiry</p>
                            <input type="text" class="inputbox" name="expdate" id="expiryDate" placeholder="MM/YY" value="<?php echo isset($exp_date) ? $exp_date : ''; ?>"/>
                            <p class="exptext2">CVV</p>
                            <input type="password" class="inputbox" name="cvv" id="cvv" value="<?php echo isset($cvv) ? $cvv : ''; ?>"/>
                        </div>
                        <button name="submit" type="submit" class="button">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="checkout.js"></script>

</body>
</html>