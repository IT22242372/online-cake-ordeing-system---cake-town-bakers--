<?php
    session_start();
    $_SESSION['loggedin'] = false; 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            height: 100vh;
            overflow: hidden; /* Prevents scrollbars */
            position: relative; /* Required for absolute positioning of the pseudo-element */
            display: flex; /* Use flexbox to center content */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('images/cake.webp'); /* Set background image */
            background-size: cover;
            background-position: center;
            filter: blur(0px); /* Adjust blur radius as needed */
            z-index: -1; /* Make sure the pseudo-element is behind the content */
        }

        .login-container {
            position: relative; /* Ensure the container is on top of the pseudo-element */
            background-color:rgba(199, 191, 191, 0.341); /* Transparent background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.942);
            text-align: center;
            width: 350px;
            height: 250px;
        }

        input[type="text"], input[type="password"] {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #d6d3d35b;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #370384;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 50%;
        }

        input[type="submit"]:hover {
            background-color: #4c22a1;
        }

        .login-container a {
            text-decoration: none;
            color: #007bff;
            display: block;
            margin-top: 15px;
        }

        .login-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        <form action="authenticate.php" method="post">
            <input type="text" id="username" placeholder="Username" name="email">
            <input type="password" id="password" placeholder="Password" name="password">
            <input type="submit" value="Login" name="login">
            
            <a href="register.html">Create an account</a>
        </form>
    </div>

    <!-- <script>
        function validateForm() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;


            if (username === "" || password === "") {
                alert("Please fill in all fields.");
                return false;
            }
            // Add more validation logic if needed
            alert("Login successful");
            return true;
        }
    </script> -->

</body>
</html>

