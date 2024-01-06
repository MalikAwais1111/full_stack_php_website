<?php
session_start();
include "./connection.php";

// Check if the user is logged in
if (!isset($_SESSION['ID'])) {
    // Redirect to the login page or any other appropriate action
    header("Location: /web_assig/account.php");
    exit();
}

// Get the user's ID from the query parameter
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Update the user's address in the database (assuming you have the new address)
    $newAddress = urldecode($_GET['address']);

    // Validate and sanitize the input if necessary

    // Update the user's address in the database
    $query = "UPDATE register SET address = '$newAddress' WHERE ID = '$userId'";
    mysqli_query($con, $query);

    // Redirect to the cart page or any other appropriate action
    header("Location: /web_assig/cart.php");
    exit();
} else {
    // Redirect to the cart page or any other appropriate action
    header("Location: /web_assig/cart.php");
    exit();
}
?>
