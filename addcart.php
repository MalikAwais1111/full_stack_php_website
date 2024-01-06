<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
// Include the connection file
include('connection.php');
session_start();
// Check if the 'id' parameter is set in the query string
if(isset($_GET['id'])) {
    // Get the product ID from the query string
    $productId = $_GET['id'];

    // Fetch the product details from the database based on the product ID
    $sql = "SELECT * FROM products WHERE id = $productId";
    $result = mysqli_query($con, $sql);

    if($result) {
        // Fetch the product details as an associative array
        $product = mysqli_fetch_assoc($result);

        // Close the result set
        mysqli_free_result($result);

        // Insert the product details into the 'cart' table
        $cartName = $product['Name'];
        $cartPrice = $product['price'];
        $userid = $_SESSION['ID'];
        $cartCount = 1; // You mentioned count should be 1

        $insertSql = "INSERT INTO cart (Name,userid, price, count) VALUES ('$cartName',$userid, $cartPrice, $cartCount)";
        $insertResult = mysqli_query($con, $insertSql);

        if($insertResult) {
            header("location:./productinfo.php");
        } else {
            echo "Error adding product to cart: " . mysqli_error($con);
        }
    } else {
        echo "Error fetching product details: " . mysqli_error($con);
    }
} else {
    echo "Product ID not provided in the query string.";
}

// Close the database connection
mysqli_close($con);
?>

</body>
</html>