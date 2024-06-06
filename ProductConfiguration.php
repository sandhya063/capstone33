<?php
                            // Start the session
                            session_start();
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QueenWharf</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a href="#"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.html">Home</a></li>
                <li><a href="./shop-grid.html">Shop</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.html">Shop Details</a></li>
                        <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                        <li><a href="./checkout.html">Check Out</a></li>
                        <li><a href="./blog-details.html">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="./testimonial.html">testimonial</a></li>
                <li><a href="./contact.html">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> QueenWharf@gmail.com</li>
                <li>Free Shipping for all Order of $99</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i>QueenWharf@gmail.com</li>
                                <li>Free Shipping for all Order of $99</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <div class="header__top__right__language">
                                <img src="img/language.png" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Spanis</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div>
                            <div class="header__top__right__language">
                            <div><i class="fa fa-user"></i> Account</div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="ViewAccount.php">View</a></li>
                                <li><a href="#">Update</a></li>
                                <li><a href="#">Past Orders</a></li>
                                <li><a href="./logout.php">LogOut</a></li>
                            </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.html"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="./index.html">Home</a></li>
                            <li class="active"><a href="./shop-grid.html">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shop-details.html">Shop Details</a></li>
                                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                    <li><a href="./checkout.html">Check Out</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="./testimonial.html">Testimonial</a></li>
                            <li><a href="./contact.html">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                        </ul>
                        <div class="header__cart__price">item: <span>$150.00</span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All departments</span>
                        </div>
                        <ul>
                            <li><a href="shop-grid.html">Milk & Dairy</a></li>
                            <li><a href="shop-grid.html">Vegetables</a></li>
                            <li><a href="shop-grid.html">Fruits & Nut Gifts</a></li>
                            <li><a href="shop-grid.html">Eggs &Butter </a></li>
                            <li><a href="shop-grid.html">Fresh Meats</a></li>
                            <li><a href="shop-grid.html">Cereals</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                      <?php

                            // Connect to the database
                            include 'config.php';

                            // Get the customer_id from the session
                            $customer_id = $_SESSION['user_id'];
                            // Get the other values from the form data
                            $product_id = $_POST["product_id"];
                            $variation_id = $_POST["variation_id"];
                            $total = $_POST["price"];
                            $quantity = $_POST["qty"];
                            $item_total = $total * $quantity;

                            // Format the totals with two decimal places
                            $total = number_format($total, 2, ".", "");
                            $item_total = number_format($item_total, 2, ".", "");


                            // Prepare an SQL statement to insert the form data into the product configuration table
                            // Omit the product configuration id column from the statement
                            $sql = "INSERT INTO Product_configuration (Product_id, Variation_id, Total) VALUES (?, ?, ?)";
                            $stmt = $conn->prepare($sql);
                            // Bind the form data to the parameters of the SQL statement
                            $stmt->bind_param("iid", $product_id, $variation_id, $total); // Use "d" for double type

                            // Execute the SQL statement
                            if ($stmt->execute()) {
                              // If the insertion is successful, get the last inserted id
                              $product_configuration_id = $stmt->insert_id;
                            }

                            // Get the user_id from the session
                            $customer_id = $_SESSION['user_id'];

                            // Prepare an SQL statement to insert the cart items using a subquery
                            $sql2 = "INSERT INTO cart_item (Cart_id, Product_Configuration_id, Quantity, Total) SELECT c.Id, ?, ?, ? FROM (SELECT Id FROM Cart WHERE Customer_id = ?) c";
                            $stmt2 = $conn->prepare($sql2);
                            // Bind the data to the parameters of the SQL statement
                            $stmt2->bind_param("iidi", $product_configuration_id, $quantity, $item_total, $customer_id); // Use "d" for double type and $product_configuration_id instead of $customer_id

                            // Execute the SQL statement
                            if ($stmt2->execute()) {
                              // If the insertion is successful, update the cart total by adding the item total
                              $sql3 = "UPDATE cart SET Total = Total + ? WHERE Customer_id = ?";
                              $stmt3 = $conn->prepare($sql3);
                              // Bind the data to the parameters of the SQL statement
                              $stmt3->bind_param("di", $item_total, $customer_id); // Use "d" for double type
                              // Execute the SQL statement
                              if ($stmt3->execute()) {
                                // If the update is successful, query the database to get the cart items and the total for the current customer
                                $sql4 = "SELECT ci.Id,p.Name, ci.Quantity, pc.Total, ci.Total as Subtotal FROM cart_item ci JOIN Product_configuration pc ON ci.Product_Configuration_id = pc.Id JOIN Product_item p ON pc.Product_id = p.Id JOIN Cart c ON ci.Cart_id = c.Id WHERE c.Customer_id = ?";
                                $stmt4 = $conn->prepare($sql4);
                                // Bind the customer_id to the parameter of the SQL statement
                                $stmt4->bind_param("i", $customer_id); // Use "i" for integer type
                                // Execute the SQL statement
                                if ($stmt4->execute()) {
                                  // If the query is successful, get the result set
                                  $result = $stmt4->get_result();
                                  // Check if the result set is not empty

                                  if ($result->num_rows > 0) {
                                    // Start a table to display the cart items and the total
                                  

                                    echo "<table>";
                                    echo "<tr> <th class=\"shoping__product\">Delete</th><th class=\"shoping__product\">Products</th><th>Quantity</th><th>Price</th><th>Subtotal</th></tr>";
                                    // Loop through the result set and display the product name, quantity, price, and subtotal for each item
                                    while ($row = $result->fetch_assoc()) {
                                      echo "<tr>";
                                      // Add a delete button with a confirmation message and the row id in the URL
                                      echo "<td><a href=\"delete.php?id=" . $row["Id"] . "\" onclick=\"return confirm('Are you sure you want to delete this item?')\">Delete</a></td>";
                                      echo "<td>" . $row["Name"] . "</td>";
                                      echo "<td>" . $row["Quantity"] . "</td>";
                                      echo "<td>" . $row["Total"] . "</td>";
                                      echo "<td>" . $row["Subtotal"] . "</td>";
                                      echo "</tr>";
                                    }
                                    // End the table
                                    echo "</table>";
                                    // Display the cart total
                                    $subtotal = $conn->query("SELECT Total FROM Cart WHERE Customer_id = $customer_id")->fetch_assoc()["Total"];
                                    echo "<p>Cart Total: " . $subtotal . "</p>";

                                    

                                  } else {
                                    // If the result set is empty, display a message
                                    echo "<p>Your cart is empty.</p>";
                                  }
                                } else {
                                  // If the query fails, display an error message
                                  echo "Error: " . $stmt4->error;
                                }
                                // Close the statement
                                $stmt4->close();
                              } else {
                                // If the update fails, display an error message
                                echo "Error: " . $stmt3->error;
                              }
                              // Close the statement
                              $stmt3->close();
                            } else {
                              // If the insertion fails, display an error message
                              echo "Error: " . $stmt2->error;
                            }
                            // Close the statement
                            $stmt2->close();
                            // Close the connection
                            $conn->close();
                            ?>
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span><?php echo $subtotal;?></span></li>
                            
                        </ul>
                        <a href="checkout.php" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="index.html" target="_blank">GroupA</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                        <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>


</body>

</html>