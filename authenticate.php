<?php 
session_start(); 

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "caketownbakers";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_POST['login'])) { 

    // Prepare and bind the SQL statement 
    $stmt = $mysqli->prepare("SELECT user_id, email, pass, fname, lname, type FROM user WHERE email = ?");
    
    // Get the form data 
    $email = $_POST['email']; 
    $password = $_POST['password']; 
    
    $stmt->bind_param("s", $email);

    // Execute the SQL statement 
    $stmt->execute();
    $stmt->store_result(); 

    // Check if the user exists 
    if ($stmt->num_rows > 0) { 
        // Bind the result to variables 
        $stmt->bind_result($user_id, $email, $hashed_password, $fname, $lname, $type); 
        $stmt->fetch(); 

        // Verify the password 
        if (password_verify($password, $hashed_password)) { 
            // Set the session variables 
            $_SESSION['loggedin'] = true; 
            $_SESSION['loggedin_id'] = $user_id; 
            $_SESSION['fname'] = $fname; 
            $_SESSION['lname'] = $lname;
            $_SESSION['email'] = $email;
             

            // Redirect based on user type
            if($type == 'admin'){
                header("Location: admin.php"); 	
            } else {
                header("Location: index.php"); 	
            }
            exit; 
        } else { 
            echo "Incorrect password!"; 
        } 
    } else { 
        echo "User not found!"; 
    } 

    // Close the statement and connection 
    $stmt->close(); 
    $mysqli->close(); 
}
?>
