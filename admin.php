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
</head>
<style>
    body {
        font-family: Arial;
        background-color: #555;
    }
</style>

<body>
    <img src="./art/logo.png" style="display: none" />
    <div class="header" style="margin-bottom:15px;">
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
    <!-- <form method="post">
      <div class="form-floating mb-3">
        <input type="text" class="form-control text-bg-dark" name="name" placeholder="name">
        <label for="name">Name</label>
      </div>
      <div class="form-floating mb-3">
        <input type="number" class="form-control text-bg-dark" name="name" placeholder="Price">
        <label for="name">Price</label>
      </div>
      <button type="submit" class="btn btn-dark btn-lg" name="submit">Submit</button>
  </div>

  </form> -->

  <table class="table table-striped table-hover">
  <thead>
    <tr>
    <th scope="col">id</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">subject</th>
                <th scope="col">comments</th>
                <th scope="col">options</th>
    </tr>
  </thead>
  <tbody>
  <?php

include './connection.php';

$sarim = 'SELECT * from contact ';
$result = mysqli_query($con, $sarim);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $name = $row['name'];
        $email = $row['email'];
        $subject = $row['subject'];
        $comment = $row['comment'];

        ?>
        
            <tr>
        <th scope="row"><?= $id ?></th>
        <td><?= $name ?></td>
        <td><?= $email ?></td>
        <td><?= $subject?></td>
        <td><?= $comment ?></td>
        <td>
              <form action="./reject.php" method="POST">  
        <button type="submit" name="user_delete" value="<?=$row['id'];?>" class="btn btn-danger">Reject</button>
      </form> 
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