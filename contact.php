<?php

include './connection.php';
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $comment = $_POST['comment'];

  $qry = 'INSERT INTO contact (name, email, subject, comment ) VALUES ("' . $name . '","' . $email . '", "' . $subject . '","' . $comment . '")';
  $result = mysqli_query($con, $qry);
  if ($result) {
    echo '<div style="position: absolute; top: 10px; right: 10px; z-index: 1000;">';
        echo '<div class="alert alert-success" role="alert">';
        echo 'Message sent successfully!';
        echo '</div>';
        echo '</div>'; 
        // header("location: /web_assig/contact.php");
        // header('');
  } else {
    echo '<div style="position: absolute; top: 10px; right: 10px; z-index: 1000;">';
        echo '<div class="alert alert-success" role="alert">';
        echo 'Message not sent ';
        echo '</div>';
        echo '</div>'; 
    die(mysqli_error($con));
  }
}

$con->close();


?>
<!DOCTYPE html>
<html lang="en">

<head>
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

<body>

  <style>
    * {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

    }

    body {
      background-color: #555;
    }
  </style>
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

  <div class="container" style="margin-top:20px;">
    <form method="post">
      <div class="form-floating mb-3">
        <input type="text" class="form-control text-bg-dark" name="name" placeholder="name">
        <label for="name">Name</label>
      </div>
      <div class="form-floating mb-3">
        <input type="email" class="form-control text-bg-dark" name="email" placeholder="name@example.com">
        <label for="email">Email address</label>
      </div>
      <div class="form-floating mb-3">
        <textarea class="form-control text-bg-dark" placeholder="Leave a comment here" name="subject"></textarea>
        <label for="subject">Subject</label>
      </div>
      <div class="form-floating">
        <textarea class="form-control text-bg-dark" placeholder="Leave a comment here" name="comment"
          style="height: 100px"></textarea>
        <label for="comment">Comments</label>
      </div>
      <button type="submit" class="btn btn-dark btn-lg" name="submit">Submit</button>
  </div>
  </form>
  <div class="footer" id="footer">
    <div class="container">
      <div class="child" style="background-color: #333;">
        <div class="footerChild1">
          <img src="./art/logo.png" />
          <h4>
            Mail us at:
            <a href="mailto:0001sarim@gmail.com">0001sarim@gmail.com</a>
          </h4>
        </div>
        <div class="footerChild2">
          <h3>Help</h3>
          <ul>
            <li><a href="linkgoeshere">Payments</a></li>
            <li><a href="linkgoeshere">Shipping</a></li>
            <li><a href="linkgoeshere">Return Policy</a></li>
            <li><a href="linkgoeshere">FAQ Topics</a></li>
          </ul>
        </div>
        <div class="footerChild2">
          <h3>Our Socials</h3>
          <ul>
            <li><a href="linkgoeshere">Instagram</a></li>
            <li><a href="linkgoeshere">Facebook</a></li>
            <li><a href="linkgoeshere">Twitter</a></li>
            <li><a href="linkgoeshere">Linkedin</a></li>
          </ul>
        </div>
        <div class="footerChild2">
          <h3>Registered Office</h3>
          <ul>
            <li>Officers Hostel,Room 20</li>
            <li>I9-1</li>
            <li>Islamabad</li>
            <li>First Bed For Business discussions </li>
          </ul>
        </div>
      </div>
      <div class="belowfooter">
        &copy; B+ & Co. Associates, 2023 <br />
        All rights reserved.
      </div>
    </div>
  </div>
  <script src="./src/js/script.js"></script>
</body>

</html>