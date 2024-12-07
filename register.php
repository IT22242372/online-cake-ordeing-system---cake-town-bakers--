<?php
	
	include "config.php";

	$sql = "SELECT user_id FROM user ORDER BY user_id DESC LIMIT 1";
    		$result = $conn->query($sql);

    		if ($result->num_rows > 0) {
      
			      while($row = $result->fetch_assoc()) {
			        
			        $user_id = $row['user_id']; //EH0001
			        $sub = substr($user_id, 4);
			        $int_value = (int) $sub;
			      	$int_value = $int_value+1;
			      	$add =  strval($int_value);
			      	
			      	$new_user_id = "USER".$add;
			          			        
			      }
			      
			    } else {
			      $new_user_id = 'USER125481';
			    }
	
	
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$password = $_POST['pass'];
	$contact = $_POST['contact'];
	$loyalty = 0;
	$type = $_POST['user_type'];

	$password_hash = password_hash($password, PASSWORD_DEFAULT);

	

	$sql = "INSERT INTO user (user_id,fname,lname,email,pass,contact,loyalty,type) VALUES(?,?,?,?,?,?,?,?)";

	$stmt = $conn->stmt_init();

	if(!$stmt->prepare($sql)){
		die("SQL Error: " . $conn->error);
	}

	$stmt->bind_param("ssssssis",$new_user_id,$fname,$lname,$email,$password_hash,$contact,$loyalty,$type);

	if($stmt->execute()){
		header("Location: register-success.php");
		exit;
		
	}
	elseif($conn->errno === 1062){
		die("Email alrady exists");
	}
	else{
		die($conn->error . " " . $conn->errno);	
	}
	

	

?>