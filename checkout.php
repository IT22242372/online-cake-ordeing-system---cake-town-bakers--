<?php
session_start();
include 'config.php';

$user_id = $_SESSION['loggedin_id'];

// Prepare and bind the SQL statement 
$stmt = $conn->prepare("SELECT email, fname, lname, contact, loyalty FROM user WHERE user_id = ?");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$stmt->store_result(); 

if ($stmt->num_rows > 0) { 
    $stmt->bind_result($email, $fname, $lname, $contact, $loyalty); 
    $stmt->fetch(); 
} 
$stmt->close();

// Initialize cart in session if not already done
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Calculate total price
$total_price = 0;
foreach ($_SESSION['cart'] as $cake) {
    $total_price += ($cake['price'] * ($cake['quantity'] ?? 1));
}

// Define delivery charge
$delivery_charge = 350.00;

// Calculate final total including delivery charge
$final_total = $total_price + $delivery_charge;

// Check if the form is submitted
if (isset($_POST['submit'])) {

    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $postal_code = $_POST['postalcode'];
    $card_number = $_POST['cardnumber'];
    $card_type = $_POST['cardtype'];
    $exp_date = $_POST['expdate'];
    $cvv = $_POST['cvv'];
    $item = $_POST['item'];
    $quantity = $_POST['quantity'];
    $totalprice = $_POST['totalprice'];
    $points = round($total_price/100);
    $loyalty = $loyalty + $points;

    $hashed_cvv = password_hash($cvv, PASSWORD_DEFAULT);

    $key = 'encryption_key';
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted_card_number = openssl_encrypt($card_number, 'aes-256-cbc', $key, 0, $iv);


// SQL query to insert data into the orders table with placeholders
$stmt = $conn->prepare("INSERT INTO `orders` (`name`, `email`, `address`, `mobile`, `postalCode`, `cardNumber`, `cardType`, `expDate`, `cvv`, `item`, `quantity`, `totalprice`, `loyalty`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Bind parameters to the placeholders
$stmt->bind_param("ssssssssssisi", $name, $email, $address, $mobile, $postal_code, $encrypted_card_number, $card_type, $exp_date, $hashed_cvv, $item, $quantity, $totalprice, $points);


if ($stmt->execute()) {
    $sql1 = "UPDATE user SET loyalty='$loyalty' WHERE user_id='$user_id'";
    if ($conn->query($sql1) === TRUE){
    // Empty the cart after successful order
    $_SESSION['cart'] = [];

    echo '<script>
            window.onload = function() {
                showPopupMessage("' . addslashes($name) . '", "' . addslashes($email) . '");
            };
          </script>';
          }
} else {
    echo '<script>alert("Insert not successful: ' . $stmt->error . '")</script>';
}

$stmt->close();
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

    <style>
        body {
        font-family: 'Arial', sans-serif;
        background-color: #f9f9f9; 
        margin: 0;
        padding: 20px;
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
 
body {
    font-family: 'Arial', sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 20px;
}


.order-heading {
    text-align: center;
    color: #333;
    font-size: 2em;
    margin-bottom: 20px;
}


.order-container {
    background-color: #fff;
    width: 90%;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 30px;
    margin-bottom: 15px;
}

.order-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #eee;
    padding: 20px 0;
}

.item-details {
    flex-grow: 1;
}


.item-label {
    font-weight: bold;

}

.inputbox1 {
    border: none;
    border-radius: 5px;
    padding: 10px;
    width: 140px;
    margin-top: 5px;
    margin-right: 5px;
    background-color: #f1f1f1;
    font-size: 15px;
}

.inputbox1:focus {
    outline: none;
    background-color: #eaeaea;
}

.inputbox2 {
    border: none;
    border-radius: 5px;
    padding: 8px;
    margin-top: 5px;
    background-color: #f1f1f1;
    text-align: end;
    font-size: 15px;
}

.inputbox2:focus {
    outline: none;
    background-color: #eaeaea;
}

.total-section {
    margin-top: 20px;
}

.total-details {
    display: flex;
    justify-content: space-between;
    padding-top: 10px;
}

.total-label {
    font-weight: bold;
   
}

@media (max-width: 600px) {
    .order-item {
        flex-direction: column; 
        align-items: flex-start; 
        padding-bottom: 15px; 
    }
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
            <a href="./Inventory/products.php">Products</a>
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
                    <form id="paymentForm" method="POST" action="" onsubmit="return validateForm()">
    <h1><center>CheckOut</center></h1>
    <h2>Payment Information</h2>

    <p>Full Name</p>
    <input 
        type="text" 
        class="inputbox" 
        name="name" 
        id="fullName" 
        value="<?php echo htmlspecialchars($fname . ' ' . $lname); ?>" 
        onkeypress="return /[a-zA-Z\s]/.test(event.key)" 
        
    >

    <p>E-mail</p>
    <input 
        type="email" 
        class="inputbox" 
        placeholder="example@example.com" 
        name="email" 
        id="email" 
        value="<?php echo $email; ?>" 
        
    >

    <p>Address</p>
    <input 
        type="text" 
        class="inputbox" 
        name="address" 
        id="address" 
        
    />

    <div class="exp">
        <p class="exptext">Phone Number</p>
        <input 
            type="text" 
            class="inputbox" 
            name="mobile" 
            id="mobileNumber" 
            value="<?php echo $contact; ?>" 
            onkeypress="return /[0-9]/.test(event.key)" 
            maxlength="10" 
            
        >
        <p class="exptext2">Postal Code</p>
        <input 
            type="text" 
            class="inputbox" 
            name="postalcode" 
            id="postalCode" 
            onkeypress="return /[0-4]/.test(event.key)" 
            maxlength="5"
        >
    </div>

    <p>Card Number</p>
<input 
    type="text" 
    class="inputbox" 
    name="cardnumber" 
    id="cardNumber" 
    placeholder="1111-2222-3333-4444"  
    oninput="formatCardNumber(this)" 
    maxlength="19" 
    
/>

    <p>Card Type</p>
    <select class="inputbox" name="cardtype" id="cardType" >
        <option value="">--Select a Card Type--</option>
        <option value="Visa">Visa</option>
        <option value="Paypal">Paypal</option>
        <option value="MasterCard">MasterCard</option>
        <option value="AmericanExpress">American Express</option>
    </select>

    <center><img src="./images/gateways.jpg" class="cardimg"></center>

    <div class="exp">
    <p class="exptext">Expiry</p>
    <input 
        type="text" 
        class="inputbox" 
        name="expdate" 
        id="expiryDate" 
        placeholder="MM/YY" 
        oninput="formatExpiryDate(this)" 
        maxlength="5" 
    />

        <p class="exptext2">CVV</p>
        <input 
            type="password" 
            class="inputbox" 
            name="cvv" 
            id="cvv" 
            onkeypress="return /[0-9]/.test(event.key)" 
            maxlength="3" 
            
        />
    </div>

            <h1 class="order-heading">Order Summary</h1>
                <div class="order-container">
                <?php foreach ($_SESSION['cart'] as $cake): ?>
                <div class="order-item">
        <div class="item-details">
            <p class="item-label">Item:</p>
            <input type="text" class="inputbox1" name="item" id="item" value="<?php echo htmlspecialchars($cake['name']);?>" readonly>
        </div>
        <div class="item-details">
            <p class="item-label">Quantity:</p>
            <input type="text" class="inputbox1" name="quantity" id="quantity" value="<?php echo isset($cake['quantity']) ? $cake['quantity'] : 1; ?>" readonly>
        </div>
        <div class="item-details">
            <p class="item-label">Item Price:</p>
            <input type="text" class="inputbox1" name="price" id="price" value="Rs. <?php echo number_format($cake['price'], 2); ?>" readonly>
        </div>
    </div>
    <?php endforeach; ?>

    <div class="total-section">
        <div class="total-details">
            <p class="total-label">Delivery Charges:</p>
            <input type="text" class="inputbox2" name="deliverycharge" id="deliverycharge" value="Rs. <?php echo number_format($delivery_charge, 2); ?>" readonly>
        </div>
        <div class="total-details">
            <p class="total-label">Total Price:</p>
            <input type="text" class="inputbox2" name="totalprice" id="totalprice" value="Rs. <?php echo number_format($final_total, 2); ?>" readonly>
        </div>
    </div>
</div>
                        <button name="submit" type="submit" class="button">Pay Now</button>
                    </form>
                </div>
            </div>
        </div>

</div>

<div id="popupMessage" class="popup hidden">
    <div class="popup-content">
        <span class="close-btn" onclick="closePopup()">&times;</span>
        <h2>✅ Payment Successful!</h2>
        <p id="popupText"></p>
        <button class="popup-btn" ><a href="./Inventory/products.php">Close</a></button>
        
        </div>
</div>

<script src="checkout.js"></script>
<script src="pay.js"></script>

</body>
</html>
