<?php

    // Start the session
    session_start();
// Connect to the database
include 'config.php';

// Get the customer_id from the session
$customer_id = $_SESSION['user_id'];

// Prepare an SQL statement to join the tables and select the product name, cart item total, and cart total
$sql = "SELECT p.Name, ci.Total as Cart_Item_Total, c.Total as Cart_Total FROM cart_item ci JOIN product_configuration pc ON ci.Product_Configuration_id = pc.Id JOIN product_item p ON pc.Product_id = p.Id JOIN cart c ON ci.Cart_id = c.Id WHERE c.Customer_id = ?";
$stmt = $conn->prepare($sql);
// Bind the customer_id to the parameter of the SQL statement
$stmt->bind_param("i", $customer_id); // Use "i" for integer type
// Execute the SQL statement
if ($stmt->execute()) {
  // If the query is successful, get the result set
  $result = $stmt->get_result();
  // Check if the result set is not empty
  if ($result->num_rows > 0) {
    // Declare an empty array to store the product names
    $product_names = array();
    // Declare an empty array to store the cart item totals
    $cart_item_totals = array();
    // Declare a variable to store the cart total
    $cart_total = 0;
    // Loop through the result set and store the product name, cart item total, and cart total in variables or arrays
    while ($row = $result->fetch_assoc()) {
      // Append the product name to the product_names array
      array_push($product_names, $row["Name"]);
      // Append the cart item total to the cart_item_totals array
      array_push($cart_item_totals, $row["Cart_Item_Total"]);
      // Assign the cart total to the cart_total variable
      $cart_total = $row["Cart_Total"];
    }
  }

}
    // query the data from the User, Customer, Address, and Cards tables
        $sql = "SELECT User.*, Customer.*, Address.*, Cards.* FROM User 
            INNER JOIN Customer ON User.Id = Customer.Id 
            INNER JOIN Address ON User.Id = Address.Id 
            LEFT JOIN Cards ON Customer.Id = Cards.Customer_id
            WHERE User.Id = $customer_id";
        $result = $conn->query($sql);

    // check if the query returned any row
    if ($result->num_rows > 0) {
    // fetch the data as an array
    $row = $result->fetch_array();
        // assign the values to variables
        $first_name = $row['FName'];
        $last_name = $row['LName'];
        $phone = $row['Phone_no'];
        $email = $row['Email'];
        $unit_no = $row['Unit_no'];
        $address_line_1 = $row['Address_line_1'];
        $address_line_2 = $row['Address_line_2'];
        $city = $row['City'];
        $region = $row['Region'];
        $postcode = $row['Postcode'];
        $country = $row['Country'];
        $name_on_card = $row['Name_on_Card'];
        $provider = $row['Provider'];
        $card_no = $row['Card_no'];
        $expiry_date = $row['Expiry_date'];
        $cvv = $row['CVV'];

    } else {

    // no data found for the user
     // assign empty strings to the variables
        $first_name = "";
        $last_name = "";
        $phone = "";
        $email = "";
        $unit_no = "";
        $address_line_1 = "";
        $address_line_2 = "";
        $city = "";
        $region = "";
        $postcode = "";
        $country = "";
        $name_on_card = "";
        $provider = "";
        $card_no = "";
        $expiry_date = "";
        $cvv = "";
    }

// Close the connection
$conn->close();
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
                <li><a href="./blog.html">Blog</a></li>
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
                <li><i class="fa fa-envelope"></i> QueenWharf@.com</li>
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
                                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
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
                            <div class="header__top__right__auth">
                                <a href="#"><i class="fa fa-user"></i> Login</a>
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
                            <li><a href="./blog.html">Blog</a></li>
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
                            <li><a href="#">Fresh Meat</a></li>
                            <li><a href="#">Vegetables</a></li>
                            <li><a href="#">Fruit & Nut Gifts</a></li>
                            <li><a href="#">Fresh Berries</a></li>
                            <li><a href="#">Ocean Foods</a></li>
                            <li><a href="#">Butter & Eggs</a></li>
                            <li><a href="#">Fastfood</a></li>
                            <li><a href="#">Fresh Onion</a></li>
                            <li><a href="#">Papayaya & Crisps</a></li>
                            <li><a href="#">Oatmeal</a></li>
                            <li><a href="#">Fresh Bananas</a></li>
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
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div>
            <div class="checkout__form" id="">
                <h4>Billing Details</h4>
                <form action="#" method="post">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text" name="Fname" placeholder="<?php echo $first_name; ?>" name="Fname">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text"placeholder="<?php echo $last_name ; ?>" name="Lname">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Address line 1<span>*</span></p>
                                <input type="text" placeholder="<?php echo $address_line_1 ; ?>" class="checkout__input__add" name="address_line_1">
                            </div>
                            <div class="checkout__input">
                                <p>Address line 2<span>*</span></p>
                                <input type="text" placeholder="<?php echo $address_line_2 ; ?>" class="checkout__input__add"  name="address_line_2">
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" placeholder="<?php echo $city ; ?>" name="city">
                            </div>
                            <div class="checkout__input">
                                <p>Region<span>*</span></p>
                                <input type="text" placeholder="<?php echo $region; ?>"  name="region">
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text" placeholder="<?php echo $country ; ?>" name="country">
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="number" placeholder="<?php echo $postcode ; ?>" name="postcode">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="number" placeholder="<?php echo $phone ; ?>" name="phone">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="email" placeholder="<?php echo $email ; ?>" name="email">
                                    </div>
                                </div>
                            </div>
                          
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text"
                                    placeholder="Notes about your order, e.g. special notes for delivery." name="notes">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">

                        <div class="checkout__order">
                            <h4>Your Order</h4>
                            <div class="checkout__order__products">Products <span>Total</span></div>
                            <ul>
                                <?php
                                    // Loop through the arrays and display the product name and cart item total in a list item
                                    for ($i = 0; $i < count($product_names); $i++) {
                                    echo "<li>" . $product_names[$i] . " <span>$" . $cart_item_totals[$i] . "</span></li>";
                                    }
                                ?>
                            </ul>
                            <div class="checkout__order__subtotal">Subtotal <span>$<?php echo $cart_total; ?></span></div>
                            <div class="checkout__order__total">Total <span>$<?php echo $cart_total; ?></span></div>

                            <div class="checkout__input">
                                <label for="Name on Cardr">
                                Name On Card
                                <input type="text" placeholder="<?php echo $name_on_card ; ?>" name="name_on_card">
                                </label>
                            </div>
                            <div class="checkout__input">
                                <label for="Provider">
                                Provider
                                <input type="text" placeholder="<?php echo $provider ; ?>" name="provider">
                                </label>
                            </div>
                            <div class="checkout__input">
                                <label for="Card No.">
                                Card No.
                                <input type="number" placeholder="<?php echo $card_no ; ?>" name="card_no">
                                </label>
                            </div>     
                            <div class="checkout__input">
                                <label for="Expiry Date">
                                Expiry Date
                                <input type="text" placeholder="<?php echo $expiry_date ; ?>" name="expiry_date">
                                </label>
                            </div>
                            <div class="checkout__input">
                                <label for="CVV">
                                CVV
                                <input type="Number" placeholder="<?php echo $cvv ; ?>" name="cvv">
                                </label>
                            </div>

                            <button type="submit" class="site-btn">PLACE ORDER</button>
                        </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer spad" style="background-color:#b2b2b2;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                         
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 ,NSW,Sydney</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: GroupA@colorlib.com</li>
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
                        <h6>Join Our Supermarket Now</h6>
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
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This website is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="index.html" target="_blank">Group A</a>
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
