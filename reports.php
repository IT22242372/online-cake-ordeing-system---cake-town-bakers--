<?php
  session_start();
  $user_id = $_SESSION['loggedin_id'];
  $email = $_SESSION['email'];
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
        /*PAGINATION*/

        .pagination{
          background-color: red;
          color: white;
          font-size: 20px;
          padding: 5px 10px;
          text-align: center;
          text-decoration: none;
          display: inline-block;

            
        }

        .pagination:hover{
            background-color: blue;
        }

        .pagination:active{
            
        }
        /*END*/
        /*SEARCH RESULT TABLE CSS*/
        .visualization{

            border: 1px solid black;
            border-collapse: collapse;
            border-color: white;
            background-color: #033a4c;
            width: 80%;
            text-align: right;
            

            
        }

        .visualization-tr{
            height: 40px;
            font-size: 16px;
            color: white;


        }

        .visualization-td{
          padding-right: 5px;
        }

        .visualization-tr:hover{
            background-color: #C40000;
            

        }

        /*.visualization-tr:nth-child(even){
            background-color: #A0A0A0;
        }

        .visualization-tr:nth-child(odd){
            background-color: #EBEBEB;
        }*/

        .visualization-header{
            text-align: center;
            background-color: #F39C12;
            color: white;
            height: 40px;
            font-size: 14px;
        }

        /*END OF TABLE STYLES*/
        body {
            font-family: 'Roboto', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            background-color: #f9f9f9;
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
       <?php

        include 'config.php'; 

    $results_per_page = 10;

    $sql = "SELECT * FROM orders WHERE email='$email'";  
    $result = $conn->query($sql);  
    $number_of_result = $result->num_rows;

    $number_of_page = ceil ($number_of_result / $results_per_page);

    //determine which page number visitor is currently on  
    if (!isset ($_GET['page']) ) {  
        $page = 1;  
    } else {  
        $page = $_GET['page'];  
    }  

    //determine the sql LIMIT starting number for the results on the displaying page  
    $page_first_result = ($page-1) * $results_per_page;  

    $sql1 = "SELECT * FROM orders WHERE email='$email' ORDER BY id DESC LIMIT " . $page_first_result . ',' . $results_per_page;
    $result1 = $conn->query($sql1);

    if ($result1->num_rows > 0) {
      // output data of each row
      echo "<table border='1' class='visualization'>";
          echo "<tr class='visualization-head-row'>";
            echo "<th class='visualization-header'>" . "Name" . "</th>" . 
                 "<th class='visualization-header'>" . "Email" . "</th>" . 
                 "<th class='visualization-header'>" . "Items" . "</th>" . 
                 "<th class='visualization-header'>" . "Total Price" . "</th>" . 
                 "<th class='visualization-header'>" . "Loyalty Points" . "</th>";
                 
                 
          echo "</tr>";
      while($row1 = $result1->fetch_assoc()) {
        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        
          echo "<tr class='visualization-tr'>";
          
          echo "<td class='visualization-td'>" . $row1["name"] . "</td>" . 
                 "<td class='visualization-td'>" . $row1["email"] . " " . $row1["name"] . "</td>" . 
                 "<td class='visualization-td'>" . $row1["item"] .     "</td>" . 
                 "<td class='visualization-td'>" . $row1["totalprice"] . "</td>" . 
                 "<td class='visualization-td'>" . $row1["loyalty"] . "</td>";
                 
                 
                 
          echo "</tr>";
        
      }
      
      echo "</table>";
      echo "<br>";
      echo "<br>";
      echo "</div>";
      for($page = 1; $page<= $number_of_page; $page++) {  
        echo '<a class="pagination" href = "reports.php?page=' . $page . '">' . $page . ' </a>';
        echo "&nbsp";  
    } 
    } else {
      echo "0 results";
    }

    
    /*$conn->close();*/
    ?>
    

    

    <div style="background-color: #000; width: 100%; height: 40px; display: flex; justify-content: center; align-items: center; text-align: center; color: #fff; font-size: large; margin-top: 20px;">
        <p class="copyright" style="margin: 0;">&copy; All Rights Reserved by CakeTownBakers (Pvt) Ltd.</p>
    </div>

    <script src="app.js"></script>
</body>

</html>
