<?php
  session_start();
    

  $user_id = $_SESSION['loggedin_id'];

  include 'config.php';

  

    // Prepare and bind the SQL statement 
    $stmt = $conn->prepare("SELECT email, fname, lname, contact, loyalty  FROM user WHERE user_id = ?");
    
    
    
    $stmt->bind_param("s", $user_id);

    // Execute the SQL statement 
    $stmt->execute();
    $stmt->store_result(); 

    // Check if the user exists 
    if ($stmt->num_rows > 0) { 
        // Bind the result to variables 
        $stmt->bind_result($email, $fname, $lname, $contact, $loyalty); 
        $stmt->fetch(); 

         
    } 

    // Close the statement and connection 
    $stmt->close();

    

    $conn->close(); 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('images/abc.webp'); /* Add  cake image here */
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            filter :blur(0px)
        }
        .register-container {
            background: rgba(90, 89, 89, 0.367);
            padding: 30px;
            border-radius: 20px;
            width: 400px;
            text-align: center;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.892);
        }
        .register-container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }
        .register-container input {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #cccccc;
            border-radius: 10px;
            font-size: 16px;
        }
        .register-container input#firstName,
        .register-container input#lastName {
            background-color: #cccccc; /* grey transparent for First Name and Last Name */
            border-color: #cccccc; /* border */
        }
        .register-container input[type="email"],
        .register-container input[type="password"],
        .register-container input[type="tel"] {
            background-color:#cccccc; /* grey transparentfor other inputs */
            border-color: #cccccc; /* Standard border color */
        }
        .register-container select {
            width: 84%;
            padding: 10px;
            margin: 10px 0;
            background-color: #cccccc; /* Light grey background */
            color: #000; /* Text color */
            border: 1px solid #cccccc;
            border-radius: 10px;
            font-size: 16px;
        }
        .register-container select:focus {
            outline: none;
            border-color: #35259d; /* Darker border on focus */
            background-color: #cccccc; /* Transparent grey background on focus */
        }
        .register-container .button {
            width: 50%;
            padding: 10px;
            background-color: #35259d;
            border: none;
            color: rgba(255, 255, 255, 0.919);
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }
        .register-container .deleteButton {
            width: 50%;
            padding: 10px;
            background-color: #FF474D;
            border: none;
            color: rgba(255, 255, 255, 0.919);
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }
        .register-container .home {
            width: 45%;
            padding: 10px;
            background-color: lightgreen;
            border: none;
            color: rgba(255, 255, 255, 0.919);
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        .register-container .reports {
            width: 45%;
            padding: 10px;
            background-color: darkorange;
            border: none;
            color: rgba(255, 255, 255, 0.919);
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        .register-container .home:hover {
            background-color: green;
        }

        .register-container .reports:hover {
            background-color: orangered;
        }

        .register-container .button:hover {
            background-color: blue;
        }
        .register-container .deleteButton:hover {
            background-color: red;
        }
        .loyalty{
            border: 3px solid red;
            padding: 10px;
            color: white;
        }
        
        
    </style>
</head>
<body>

    <div class="register-container">
        <h1>User Profile</h1>
        <form action="profileUpdate.php" method="post">
        <input type="text" placeholder="First Name" id="firstName" name="fname" value=<?php echo $fname?>>
        <input type="text" placeholder="Last Name" id="lastName" name="lname" value=<?php echo $lname?>>
        <input type="email" placeholder="Email" id="email" name="email" value=<?php echo $email?>>
        <input type="password" placeholder="Password" id="password" name="password">
        <input type="tel" placeholder="Contact Number" id="contactNumber" name="contact" value=<?php echo $contact?>>
        <h4>
        <div class="loyalty">
            Loyalty Points : <?php echo $loyalty;?>
        </div>
        </h4>
        <input type="submit" name="update" value="UPDATE" class="button">
        <input type="submit" name="delete" value="DELETE" class="deleteButton">
        </form>
        <a href="index.php"><button class="home">HOME</button></a>
        <a href="reports.php"><button class="reports">REPORTS</button></a>
        
        <!-- <button onclick="registerUser()">Create</button> -->
    </div>

    <!-- <script>
        function registerUser() {
            const firstName = document.getElementById("firstName").value;
            const lastName = document.getElementById("lastName").value;
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            const contactNumber = document.getElementById("contactNumber").value;

            if (firstName && lastName && email && password && contactNumber) {
                // Here, you would typically send the data to a backend server
                alert("User Registered Successfully!");
                console.log({
                    firstName,
                    lastName,
                    email,
                    password,
                    contactNumber
                });
            } else {
                alert("Please fill out all fields.");
            }
        }
    </script> -->

    
</body>
</html>

