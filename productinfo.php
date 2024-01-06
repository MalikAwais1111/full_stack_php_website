<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Al Hayat & Co.</title>
    <link rel="stylesheet" href="./art/css/style.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/svg+xml" href="./images/header/favicon.svg">
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <link rel="icon" type="image/svg+xml" href="./art/logo.png" />
    <style>
        /* Add some styles for the popup */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #28a745;
            color: white;
            padding: 15px;
            border-radius: 5px;
            z-index: 1000;
        }
    </style>
</head>
<body>

<div class="header">
      <div class="container">
        <div class="navbar">
          <div class="logo">
            <a class="logo-img" href="/web_assig/home.php"
              ><img
                src="./art/logo.png"
                alt="comp"
                width="200px"
            /></a>
          </div>
          <nav>
            <ul class="nav-menu">
              <li class="nav-item"><a href="/web_assig/home.php">Home</a></li>
              <li class="nav-item"><a href="/web_assig/about.php">About Us</a></li>
              <li class="nav-item"><a href="/web_assig/home.php#line1">Products</a></li>
              <?php
                                session_start();
               if (!isset($_SESSION['AdminID'])) {
                echo "<li class='nav-item'><a href='./contact.php'>Contact Us</a></li>";
              }?>                    <?php

                  // Check if the logout action is triggered
                  if (isset($_GET['logout'])) {
                      // Destroy the session and redirect to the home page
                      session_destroy();
                      header("Location: /web_assig/home.php");
                      exit();
                  }

                  // Check if the user is not logged in
                  if (!isset($_SESSION['AdminID']) && !isset($_SESSION['ID'])) {
                      echo '<li class="nav-item"><a href="/web_assig/account.php">Login</a></li>';
                  } else {
                      // Display logout link
                      echo '<li class="nav-item"><a href="/web_assig/home.php?logout=true">Logout</a></li>';
                  }
                  if (isset($_SESSION['AdminID'])) {
                    echo '<li class="nav-item"><a href="/web_assig/addproducts.php">Add Product</a></li>';
                    echo '<li class="nav-item"><a href="/web_assig/admin.php">View messages</a></li>';
                  }
                ?>
            </ul>
          </nav>
          <a href="/web_assig/cart.php"
            ><img class="cart" src="./art/cart/cart.svg";
          /></a>
          <div class="toggle"><i class="fa fa-bars"></i></div>
        </div>
      </div>
    </div>



<?php
include "./connection.php";

// Check if the form is submitted for updating
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input to prevent SQL injection
    $productId = mysqli_real_escape_string($con, $_POST['id']);
    $productName = mysqli_real_escape_string($con, $_POST['name']);
    $productPrice = mysqli_real_escape_string($con, $_POST['price']);

    // Update the product in the database
    $query = "UPDATE products SET Name='$productName', price='$productPrice' WHERE id=$productId";
    $result = mysqli_query($con, $query);

    // Check if the update was successful
    if ($result) {
        header("Location: home.php");
        exit();
    } else {
        // Handle the case where the update fails
        echo 'Error updating product: ' . mysqli_error($con);
    }
}

// Continue with the existing code to fetch and display the product for editing

if (isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $productId = mysqli_real_escape_string($con, $_GET['id']);

    // Query to fetch product information based on the provided ID
    $query = "SELECT * FROM products WHERE id = $productId";
    $result = mysqli_query($con, $query);

    // Check if the query was successful

    if ($result) {
        // Fetch the product details
        $product = mysqli_fetch_assoc($result);

        // Check if a product with the given ID was found
        if ($product) {
            if (isset($_SESSION['AdminID'])) {
                // Display the product information in a Bootstrap form for editing
                echo '<div class="container mt-5">';
                echo '<form action="" method="post">';
                echo '<input type="hidden" name="id" value="' . $product['id'] . '">';
                echo '<div class="form-group">';
                echo '<label for="name">Name:</label>';
                echo '<input type="text" class="form-control" id="name" name="name" value="' . $product['Name'] . '">';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="price">Price:</label>';
                echo '<input type="text" class="form-control" id="price" name="price" value="' . $product['price'] . '">';
                echo '</div>';
                echo '<button type="submit" class="btn btn-primary">Update</button>';
                echo '</form>';
                echo '<br>';
                echo '<a href="delete_product.php?id=' . $product['id'] . '" class="btn btn-danger">Delete</a>';
                echo '</div>';
            } elseif (isset($_SESSION['ID'])) {
                echo '<div class="container mt-5">';
                echo '<table class="table table-bordered">';
                echo '<tr><th>Name</th><th>Price</th><th>Action</th></tr>';
                echo '<tr><td>' . $product['Name'] . '</td><td>' . $product['price'] . '</td>';
                echo '<td class="text-center" style="display:flex; flex-direction:column;">';
                echo '<a href="addcart.php?id=' . $productId . '" class="btn btn-danger mx-2">Add to cart</a>';
                echo '</td></tr>';
                echo '</table>';
                echo '</div>';
            }
            else{
                header("location: /web_assig/account.php");
            }
            mysqli_free_result($result);
        } else {
            // Handle the case where the 'id' parameter is not present in the query string
            echo 'Product ID not specified';
        }

        // Close the database connection
        mysqli_close($con);
    }
}
else{
    echo '<div class="alert alert-success mt-3" role="alert">';
    echo "Product added to cart successfully!";
    echo '</div>';
}
?>
</body>
</html>
