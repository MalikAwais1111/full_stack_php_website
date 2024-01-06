




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Al Hayat & Co.</title>
    <link rel="stylesheet" href="./style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <link rel="icon" type="image/svg+xml" href="./art/logo.png" />
</head>
<style>
    body {
        font-family: Arial;
        background-color: #555;
    }
</style>

<body>
    <img src="./art/logo.png" style="display: none" />
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

    <div class="container">
        <?php
if (isset($_GET['updateid'])) {
    $updateId = $_GET['updateid'];

    define('dbHostname', 'localhost');
    define('dbUserName', 'root');
    define('dbPassword', '');
    define('dbName', 'al_hayat');
    $con = new mysqli(dbHostname, dbUserName, dbPassword, dbName);
    if (!$con) {
        die(mysqli_error($con));
    }
    
    $productName = '';
    $productPrice = '';

    $query = "SELECT * FROM products   WHERE  id=$updateId ";
    $result = mysqli_query($con, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $productName = $row['Name'];
        $productPrice = $row['price'];
        echo '<form method="post">
        <div class="form-floating mb-3">
            <input type="text" class="form-control text-bg-dark" name="name" placeholder="name" value="<?php echo $productName?>">
            <label for="name">Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control text-bg-dark" name="price" placeholder="Price" value="<?= $productPrice ?>">
            <label for="price">Price</label>
        </div>
        <button type="submit" class="btn btn-dark btn-lg" name="submit">Update</button>
    </form>
    
        ';
    } else {
        echo "Error retrieving product details: " . mysqli_error($con);
    }
    mysqli_close($con);
}
?>
  <table class="table table-striped table-hover">
  <thead>
    <tr>
    <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
    </tr>
  </thead>
  <tbody>
  <?php
include './connection.php';
$sarim = 'SELECT * from products ';
$result = mysqli_query($con, $sarim);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $name = $row['Name'];
        $price = $row['price'];
        ?>
        
            <tr>
        <th scope="row"><?= $id ?></th>
        <td><?= $name ?></td>
        <td><?= $price ?></td>
        <td>
        <a href="./adminproductupdate.php?updateid=<?= $row['id']; ?>">update</a>
x                update
    </a>        
        </td>

        </tr>   
        <?php 
            };
          };
            
      ?>  
  </tbody>
</table>

</body>
</html>