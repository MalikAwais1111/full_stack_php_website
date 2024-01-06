<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
              <li class="nav-item"><a href="#line1">Products</a></li>
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

    <!--  <div class="headerimg">
            <h1> Give Your Daily Life <br>A new Style!</h1>
            <p> Discover timeless ele gance and modern sophistication with our clothing brand. We blend style and comfort to empower you to embrace your unique fashion journey.</p>
            <a href="#hot" class="btn">Explore Now &#8594;</a> -->

    <div
      id="hero-carousel"
      class="carousel slide carousel-fade"
      data-bs-ride="carousel"
    >
      <div class="carousel-indicators">
        <button
          type="button"
          data-bs-target="#hero-carousel"
          data-bs-slide-to="0"
          class="active"
          aria-current="true"
          aria-label="Slide 1"
        ></button>
        <button
          type="button"
          data-bs-target="#hero-carousel"
          data-bs-slide-to="1"
          aria-label="Slide 2"
        ></button>
        <button
          type="button"
          data-bs-target="#hero-carousel"
          data-bs-slide-to="2"
          aria-label="Slide 3"
        ></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active c-item">
          <img
            src="./art/pexels-ksenia-chernaya-5691611.jpg"
            class="d-block w-100 c-img"
            alt="..."
          />
          <div class="carousel-caption d-none d-md-block">
            <p>Established since 2015.</p>
          </div>
        </div>
        <div class="carousel-item c-item">
          <img
            src="./art/pexels-orlando-allo-2273486.jpg"
            class="d-block w-100 c-img"
            alt="..."
          />
          <div class="carousel-caption d-none d-md-block">
            <p>Trusted by more than 1400+ testimonials</p>
          </div>
        </div>
        <div class="carousel-item c-item">
          <img
            src="./art/pexels-sandro-sandrone-lazzarini-6333061.jpg"
            class="d-block w-100 c-img"
            alt="..."
          />
          <div class="carousel-caption d-none d-md-block">
            <p>Click on the button to explore our products.</p>
          </div>
        </div>
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#hero-carousel"
          data-bs-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#hero-carousel"
          data-bs-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>

    <!--     <div class="offer">
            <div class="small-container">
                <div class="child">
                    <div class="halfchild">
                        <img src="./images/promos/whodie-removebg-preview.png" class="offer-img">
                    </div>
                    <div class="halfchild">
                        <p>Exclusively available here</p>
                        <h1>Women's Fleece Hoodie.</h1>
                        <small>
                            Exclusive Designed Hoodie's to Enhance the Fasion of Women. 
                            <br>
                        </small>
                        <a href="./product_details.html" class="btn">Buy Now &#8594;</a>
                    </div>
                </div>
            </div>
        </div> -->
        <?php
        include "./connection.php";

$query = "SELECT * FROM products";
$result = mysqli_query($con, $query);

// Check if the query was successful
if ($result) {
    // Start the container div
    echo '<div id="line1" class="small-container" id="hot">';
    echo '<h2>Our top selling</h2>';
    echo '<div class="line1"></div>';
    echo '<div class="child">';

    // Loop through the fetched data
    while ($row = mysqli_fetch_assoc($result)) {
        // Start a child div for each record
        echo '<div class="childprods">';
        echo '<a href="/web_assig/productinfo.php?id='. $row['id'] . '" style="text-decoration:none; color:#FFFFFF">';
        echo '<img src="' . $row['img_src'] . '">';
        echo '<h4>' . $row['Name'] . '</h4>';
        echo '<div class="rating">';
        
        // Assuming your rating is an integer indicating the number of stars
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $row['ratings']) {
                echo '<i class="fa fa-star"></i>';
            } else {
                echo '<i class="fa fa-star-o"></i>';
            }
        }
        
        echo '</div>';
        echo '<p>Price : ' . $row['price'] . ' PKR</p>';
        echo '</a>';
        echo '</div>';
    }

    // Close the container div
    echo '</div>';
    echo '</div>';

    // Free the result set
    mysqli_free_result($result);
} else {
    // Handle the case where the query fails
    echo 'Error executing query: ' . mysqli_error($con);
}

// Close the database connection
mysqli_close($con);
?>

      
  
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
        <div class="belowfooter">
          &copy; B+ & Co. Associates, 2023 <br />
          All rights reserved.
        </div>
      
    </div>
    <script src="./script.js"></script>
  </body>
</html>
