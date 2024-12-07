<?php
    include 'Config.php';
?>

<?php

if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];

    $sql="DELETE FROM `orders` WHERE id='$id'";
    
    $result=mysqli_query($conn,$sql);

    if($result){

         header('location:checkoutRecord.php');

         

    }

    else{

     die("connection failed".mysqli_connect_error());

    }
}

?>                       