<?php
if (isset($_GET['er'])) {
    $decoded_er = urldecode($_GET['er']);
    echo "<script>alert('invalid username or password')</script>";
    // exit();
} 
?>

<?php
include "./connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $address = $_POST['address'];

  $qry = 'INSERT INTO register (UserName, Email, Password, address) VALUES ("' . $username . '","' . $email . '", "' . $password . '", "'.$address.'")';
  $result = mysqli_query($con, $qry);
  if ($result) {
    $formsubmitted = true;
    header("Location: ./web_assig/account.php");
    exit();
  } else {
    die(mysqli_error($con));
  }
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Al Hayat & Co.</title>
    <link rel="stylesheet" href="./art/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/svg+xml" href="./images/header/favicon.svg">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="icon" type="image/svg+xml" href="./art/logo.png" />
</head>
<body>
    <img src="./art/logo.png" style="display: none;">
    <div class="header" style="max-height:130px;">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <a class="logo-img" href="/web_assig/home.php"><img src="./art/logo.png" alt="comp" width="200px" /></a>
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
                        }?>
                        <?php
                        if (isset($_GET['logout'])) {
                            session_destroy();
                            header("Location: /web_assig/home.php");
                            exit();
                        }
                        if (!isset($_SESSION['AdminID']) && !isset($_SESSION['ID'])) {
                            echo '<li class="nav-item"><a href="/web_assig/account.php">Login</a></li>';
                        } else {
                            echo '<li class="nav-item"><a href="/web_assig/home.php?logout=true">Logout</a></li>';
                        }
                        if (isset($_SESSION['AdminID'])) {
                            echo '<li class="nav-item"><a href="/web_assig/addproducts.php">Add Product</a></li>';
                            echo '<li class="nav-item"><a href="/web_assig/admin.php">View messages</a></li>';
                        }
                        ?>
                    </ul>
                </nav>
                <a href="/web_assig/cart.php"><img class="cart" src="./art/cart/cart.svg"; /></a>
                <div class="toggle"><i class="fa fa-bars"></i></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="formPage">
            <div class="btn" id="removeLog"  onclick="login()">Existing User? Login</div>
            <div class="btn" id="removeReg" onclick="register()">New User? Register</div>
            <div class="btn" id="adminlog" onclick="adminlogin()">Admin? Login</div>
            <form class= "showForm" id="loginForm" method="post" action="/web_assig/cradentialCheck.php">
                <h3>Login</h3>
                <input type="text" placeholder="Username" name="username" required>
                <input type="password" placeholder="Password" name="password" required>
                <button type="submit" class="btn" name="Usubmit" value="user">Login</button>
            </form>
            <form class="showForm" id="registerForm" method="post">
                <h3>Register</h3>
                <input type="text" placeholder="Username" name="username" required>
                <input type="email" placeholder="E-mail" name="email" required>
                <input type="password" placeholder="Password" name="password" required>
                <input type="text" placeholder="Address" name="address" required>
                <small>I agree to the following Terms and Conditions*</small>
                <button type="submit" class="btn">Register</button>
            </form>
            <form class= "showForm" id="adminloginform" method="post" action="/web_assig/cradentialCheck.php">
                <h3>Admin Login</h3>
                <input type="text" placeholder="Username" name="username" required>
                <input type="password" placeholder="Password" name="password" required>
                <button type="submit" class="btn" name="Usubmit" value="admin">Login</button>
            </form>
        </div>
    </div>
    <div class="footer" id="footer" >
        <div class="container">
            <div class="child" style="background-color:#333;">
                <div class="footerChild1">
                    <img src="./art/logo.png">
                    <h4>Mail us at: <a href="mailto:0001sarim@gmail.com">0001sarim@gmail.com</a></h4>
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
                        <li>Officers Hostel, Room 20</li>
                        <li>I9-1</li>
                        <li>Islamabad</li>
                        <li>-</li>
                    </ul>
                </div>
            </div>
            <div class="belowfooter">
                &copy; B+ & Co. Associates, 2023 <br>
                 All rights reserved.
            </div>
        </div>
    </div>
    <script src="./art/js/script.js"></script>
    <script>
        <?php 
        if ($formsubmitted) {
            echo 'alert("Registration successful, click OK to continue");';
        }
        ?>
    </script>

</body>
</html>
