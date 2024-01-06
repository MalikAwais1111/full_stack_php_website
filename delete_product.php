<?php
include "./connection.php";

// Check if the 'id' parameter is present in the query string
if (isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $productId = mysqli_real_escape_string($con, $_GET['id']);

    // Query to delete the product based on the provided ID
    $deleteQuery = "DELETE FROM products WHERE id = $productId";
    $deleteResult = mysqli_query($con, $deleteQuery);

    // Check if the deletion was successful
    if ($deleteResult) {
        header("Location: /web_assig/home.php");
exit();

    } else {
        // Handle the case where the deletion fails
        echo '<div class="container mt-5">';
        echo '<p class="text-danger">Error deleting product: ' . mysqli_error($con) . '</p>';
        echo '</div>';
    }
} else {
    // Handle the case where the 'id' parameter is not present in the query string
    echo '<div class="container mt-5">';
    echo '<p class="text-danger">Product ID not specified.</p>';
    echo '</div>';
}

// Close the database connection
mysqli_close($con);
?>
