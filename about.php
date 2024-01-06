<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Al Hayat & Co.</title>
  <link rel="stylesheet" href="./art/css/about.css">
   <link rel="stylesheet" href="./art/css/style.css">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <link rel="icon" type="image/svg+xml" href="./art/logo.png" />
</head>
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
              }?>
              
                <?php

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

    
        <section class="about">
            <h1>About Us</h1><br><br>
            <p style="font-weight: bold">AL-Hayat is the leading constrution company...</p>
            <div class="about-info">
                <div class="about-img">
                    <img src=
    "./art/logo.png" alt="AL-Hayat">
                </div>
                <div>
         <p>AL-HAYAT is one of the leading construction company in pakistan well known for its Big projects in Sargodha Lahore Islamabad and Multan, We have varity of Construction Materials and professionals to help you achieve your goals
        </p><br><br>
        <a href="./contact.php"><button >Contact Us...</button></a> 
                </div>
            </div>
        </section>
     
        <div class="testimonial">
            <div class="small-container">
              <h3>
                <i class="fa fa-quote-left"></i> &emsp;See what our clients say about
                us -
              </h3>
              <div class="child">
                <div class="testchild">
                  <p>
                    Absolutely loved the fine hoodies I brought from this place. 11/10
                    would buy from here again.
                  </p>
                  <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                  </div>
                  <img
                    src="./art/card/e8958391-eeba-4df7-9525-60acb8047868.jpg"
                  />
                  <h3>Sarim Hayat</h3>
                </div>
                <div class="testchild">
                  <p>
                    Jesus Christ who put up this ugly website. Recommend firing that
                    guy. Jk good site pls no remove comments.
                  </p>
                  <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-o"></i>
                  </div>
                  <img src="./art/card/85b80ff3-bf6a-421c-b108-ace36aa20b22.jpg" />
                  <h3>Waqar Ali</h3>
                </div>
                <div class="testchild">
                  <p>
                    No wonder this site is so popular! It has the best prices in the
                    city and really like the styles.
                  </p>
                  <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                  </div>
                  <img src="./art/card/e8671690-c1ed-4dbe-a2b8-6db56c53ea47.jpg" />
                  <h3>Awais</h3>
                </div>
              </div>
            </div>
          </div>
          <div class="footer" id="footer">
    
            <div class="child-footer">
              <div class="footerChild1">
                <img src="./art/logo.png" />
                <h4>
                  Mail us at:
                  <a href="mailto:awa014886@gmail.com">awa014886@gmail.com</a>
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
          
        </div>
              <div class="belowfooter">
                &copy; AL-HAYAT & Co. Associates, 2023 <br />
                All rights reserved.
              </div>
            </div>
          </div>
          <script src="./src/js/script.js"></script>
</body>
</html>