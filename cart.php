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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <link rel="icon" type="image/svg+xml" href="./art/logo.png" />
    </head>
    <body>
        <img src="./art/logo.png" style="display: none;">
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
              }?>                <?php

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
    if(!isset($_SESSION['AdminID']) && !isset($_SESSION['ID'])){
       // header("Location: ./checka.php");
       echo  '<div class="container">
       <div class="formPage">
       <h2>You aren\'t logged in. You need an account to add items/view your cart.</h2>
       <div class="btn"><a href="./account.php">My Account</a></div>
       </div>
       </div>
       ';
       echo '<br>';
    }
//header("Location: CRUDA/Select.php");

else {
    if (isset($_SESSION['ID'])) {
    include "./connection.php";
    $totalBill = 0;

    $sid = $_SESSION['ID'];

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
        if (isset($_POST['placeOrder'])) {
            
        // Iterate through the posted counts and update the database
        foreach ($_POST['count'] as $productId => $newCount) {
            // Validate and sanitize inputs before using them in the query
            $productId = mysqli_real_escape_string($con, $productId);
            $newCount = mysqli_real_escape_string($con, $newCount);

            // Update the database with the new count
            $query = "UPDATE cart SET count = $newCount WHERE id = $productId AND userid = '$sid'";
            mysqli_query($con, $query);
            // Add error handling as needed
        }

        // Show a success message or redirect the user to a confirmation page
        echo '<div class="container mt-5" style="max-height:12px;">';
        echo '<div class="alert alert-success" role="alert">';
        echo 'Order placed successfully! ';
        echo '</div>';
        echo '</div>'; } 
        elseif(isset($_POST['update'])){
            foreach ($_POST['address'] as $userid => $newaddress) {
                // Validate and sanitize inputs before using them in the query
                $userid = mysqli_real_escape_string($con, $userid);
                $newaddress = mysqli_real_escape_string($con, $newaddress);
    
                // Update the database with the new count
                $query1 = "UPDATE register SET address = ? WHERE ID = ?";
                $stmt = mysqli_prepare($con, $query1);
                
                // Bind the parameters
                mysqli_stmt_bind_param($stmt, 'ss', $newaddress, $sid);
                
                // Execute the statement
                mysqli_stmt_execute($stmt);
                
                // Close the statement
                mysqli_stmt_close($stmt);
                
            }
    
            // Show a success message or redirect the user to a confirmation page
            echo '<div class="container mt-5" style="max-height:12px;">';
            echo '<div class="alert alert-success" role="alert">';
            echo 'Address updated successfully! ';
            echo '</div>';
            echo '</div>';
        }
        else{
            echo "";
        }
    }

    // Retrieve products from the user's cart using their session ID
    $query = "SELECT * FROM cart WHERE userid = '$sid'";
$query2 = "SELECT * FROM register WHERE ID = '$sid'";
$result = mysqli_query($con, $query);
$result2 = mysqli_query($con, $query2);

echo '<div class="container" style="overflow:auto;">';
echo '<h2>Products in Your Cart</h2>';
echo '<form method="post" action="">'; // Add a form element
echo '<table class="table table-bordered table-striped">';
echo '<thead class="thead-dark">';
echo '<tr><th scope="col">Product Name</th><th scope="col">Price</th><th scope="col">Quantity</th><th scope="col">Action</th></tr>';
echo '</thead>';
echo '<tbody>';

while (($row = mysqli_fetch_assoc($result))) {
    echo '<tr>';
    echo '<td>' . $row['Name'] . '</td>';
    echo '<td>$' . $row['Price'] . '</td>';
    echo '<td><input type="number" name="count[' . $row['id'] . ']" value="' . $row['count'] . '" style="color:black;"></td>';

    // Calculate total price for the product
    $productTotal = $row['Price'] * $row['count'];
    $totalBill += $productTotal;

    echo '<td><button class="btn btn-danger" onclick="deleteProduct(' . $row['id'] . ')">Delete</button></td>';
    echo '</tr>';
}
while($row2 = mysqli_fetch_assoc($result2)){
    echo '<tr>';
echo '<td colspan="2" ">Address: <input  type="text" name="address['.$row2['ID'].']" value="' . $row2['address'] . '" style="color:black; margin-top:35px; max-width:303px;"></td>';
echo '<td colspan="2"><button type="submit" class="btn btn-warning" name="update" >Update address</button></td>';
echo '</tr>';

}

echo '</tbody>';
echo '<tfoot>';
// echo '<tr>';
// echo '<td colspan="3"><strong>Total Bill:</strong></td>';
// echo '<td>$' . number_format($totalBill, 2) . '</td>';
// echo '</tr>';
echo '</tfoot>';
echo '</tbody>';
echo '<button type="submit" class="btn btn-success" name="placeOrder">Place Order</button>';
echo '<strong>   Total Bill  :      </strong>$' . number_format($totalBill, 2) . '';

echo '</table>';



    // Place Order Button

    echo '</form>'; // Close the form element
    echo '</div>';

    // Close the database connection
    mysqli_close($con);
}
elseif (isset($_SESSION['AdminID'])) {
    include "./connection.php";
    $adminId = $_SESSION['AdminID'];

    // Retrieve all products from the cart
    $query = "SELECT * FROM cart";
    $result = mysqli_query($con, $query);

    echo '<div class="container">';
    echo '<h2>All Products in Cart (Admin View)</h2>';
    echo '<table class="table table-bordered table-striped">';
    echo '<thead class="thead-dark">';
    echo '<tr><th scope="col">Product Name</th><th scope="col">Price</th><th scope="col">Quantity</th></tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['Name'] . '</td>';
        echo '<td>$' . $row['Price'] . '</td>';
        echo '<td>' . $row['count'] . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';

    // Close the database connection
    mysqli_close($con);
} else {
    // Other code for regular users...
}

}
?>
       
        <script src="./src/js/script.js"></script>
        <script>
        function placeOrder() {
    // You can customize this alert or replace it with your order placement logic
    alert('Your order has been placed!');
}
function deleteProduct(productId) {
    // You can use AJAX here to send a request to the server to delete the product from the database
    // For simplicity, you can use a confirmation prompt
    if (confirm("Are you sure you want to delete this product?")) {
        // Redirect to a delete script or handle the deletion using AJAX
        window.location.href = '/web_assig/deletecart.php?id=' + productId;
    }
}
</script>
    </body>
</html>