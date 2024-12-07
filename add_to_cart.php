<?php
session_start();
include './config.php'; // Adjusted path

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("Location: ../login.php");
    exit;
}

// Initialize cart in session if not already done
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if a cake ID is sent to add to cart
if (isset($_POST['cake_id'])) {
    $cake_id = $_POST['cake_id'];

    // Fetch the cake details from the database
    $sql = "SELECT id, name, price, image FROM cakes WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $cake_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $cake = $result->fetch_assoc();

            // Add cake to cart session
            $_SESSION['cart'][] = $cake;
            // Return the updated cart count
            echo count($_SESSION['cart']);
            exit;
        } else {
            echo "Cake not found.";
            exit;
        }
    } else {
        echo "Failed to prepare statement.";
        exit;
    }
}
