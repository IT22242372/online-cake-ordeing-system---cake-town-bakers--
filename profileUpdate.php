<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIGNUP SUCCESS</title>
  
  <link rel="stylesheet" type="text/css" href="css/nav-bar.css">
  <style type="text/css">
    p{
      text-align: center;
    }

    b{
      color: red;
    }

  
    .signup-sucess{
      border: 5px ridge ;
      top: 25%;
      left: 17%;
      width: 66%;
      height: 30%;
      padding: 5px;
      position: fixed;
      color: white;
      background-color: #2c2a2a7a;
      font-size: 20px;
      font-family: "Courier New", monospace;
      line-height: 1.5;
    }

    .link{
      text-decoration: none;
      color:#ff0000;
      font-weight: bold;
    }
  </style>
</head>
<body style="background-image: url('images/cake3.jpg'); background-repeat: no-repeat; background-size: cover;filter: none;">

  
  
  
    
    
   

    

  ?>
</body>
</html>

<?php
      session_start();
      if (isset($_POST['update'])) { 
        include 'config.php';
        $user_id = $_SESSION['loggedin_id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $contact = $_POST['contact'];

        if(empty($password)){

          $sql1 = "UPDATE user SET fname='$fname', lname='$lname', email='$email', contact='$contact' WHERE user_id='$user_id'";

          if ($conn->query($sql1) === TRUE) {
            
            echo "<div class='signup-sucess'>";
            echo "<center>";
            echo "<h1>" . "USER DETAILS HAS BEEN UPDATED SUCCESSFULLY" . "</h1>";
            echo "<h3>" . "Please check" . "<a href='profile.php'>" . " User Profile " . "</a>";
            echo "</h3>";
            echo "</center>";
            echo "</div>";

          } else {
            echo "Error updating record: " . $conn->error;
          }

          $conn->close();
    } else {
          $password_hash = password_hash($password, PASSWORD_DEFAULT);
          $sql1 = "UPDATE user SET fname='$fname', lname='$lname', email='$email' ,pass='$password_hash' ,contact='$contact' WHERE user_id='$user_id'";

          if ($conn->query($sql1) === TRUE) {
            
            echo "<div class='signup-sucess'>";
            echo "<center>";
            echo "<h1>" . "USER DETAILS HAS BEEN UPDATED SUCCESSFULLY" . "</h1>";
            echo "<h3>" . "Please check" . "<a href='profile.php'>" . " User Profile " . "</a>";
            echo "</h3>";
            echo "</center>";
            echo "</div>";

          } else {
            echo "Error updating record: " . $conn->error;
          }

          $conn->close();

    }
  }

  if (isset($_POST['delete'])) { 
        include 'config.php';
        $user_id = $_SESSION['loggedin_id'];
        

          $sql1 = "DELETE from user WHERE user_id='$user_id'";

          if ($conn->query($sql1) === TRUE) {
            
            session_start();
            session_unset();
            session_destroy();
            header("Location: login.php");

          } else {
            echo "Error updating record: " . $conn->error;
          }

          $conn->close();
    }
  

    ?>