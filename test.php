<?php
session_start();

include 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $variation_id = $_POST['variation_id'];
    $price = $_POST['price'];
    $quantity = $_POST['qty'];

    echo "Product ID: " . $product_id . "<br>";
    echo "Variation ID: " . $variation_id . "<br>";
    echo "Price: " . $price . "<br>";
    echo "Quantity: " . $quantity . "<br>";
}
case "add":
    // Get the product configuration id from the $_GET array
    $product_configuration_id = $_GET["product_configuration_id"];
    // Prepare a SQL statement to select the product details by product configuration id
    $sql = "SELECT * FROM Product_Configuration WHERE Product_Configuration_id = ?";
    $stmt = $conn->prepare($sql);
    // Bind the product configuration id to the parameter of the SQL statement
    $stmt->bind_param("i", $product_configuration_id);
    // Execute the SQL statement
    $stmt->execute();
    // Get the result as an associative array
    $productByCode = $stmt->get_result()->fetch_assoc();
    // Check if the product is already in the cart session
    $itemArray = array($productByCode["Product_Configuration_id"]=>array('name'=>$productByCode["name"], 'product_configuration_id'=>$productByCode["Product_Configuration_id"], 'quantity'=>1, 'price'=>$productByCode["price"], 'image'=>$productByCode["image"]));
    if (!empty($_SESSION["cart_item"])) {
      if (in_array($productByCode["Product_Configuration_id"], array_keys($_SESSION["cart_item"]))) {
        // Increment the quantity by one
        foreach ($_SESSION["cart_item"] as $k => $v) {
          if ($productByCode["Product_Configuration_id"] == $k) {
            $_SESSION["cart_item"][$k]["quantity"] += 1;
          }
        }
      } else {
        // Add the product to the cart session
        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
      }
    } else {
      // Create the cart session with the product
      $_SESSION["cart_item"] = $itemArray;
    }
    // Redirect the user back to the cart.php page
    header("Location: cart.php");
    break;
    case "remove":
        // Get the product configuration id from the $_GET array
        $product_configuration_id = $_GET["product_configuration_id"];
        // Loop through the cart session to find the matching product
        if (!empty($_SESSION["cart_item"])) {
          foreach ($_SESSION["cart_item"] as $k => $v) {
            if ($product_configuration_id == $k) {
              // Decrement the quantity by one
              $_SESSION["cart_item"][$k]["quantity"] -= 1;
              // If the quantity becomes zero, remove the product from the cart session
              if ($_SESSION["cart_item"][$k]["quantity"] == 0) {
                unset($_SESSION["cart_item"][$k]);
              }
            }
          }
        }
        // Redirect the user back to the cart.php page
        header("Location: cart.php");
        break;
            // Case for emptying the cart
    case "empty":
        // Unset the cart session
        unset($_SESSION["cart_item"]);
        // Destroy the session
        session_destroy();
        // Redirect the user back to the cart.php page
        header("Location: cart.php");
        break;
    }
  }
?>

<div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text" name="Fname" placeholder="<?php echo $first_name; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" placeholder="<?php echo $last_name ; ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text" placeholder="<?php echo $country ; ?>">
                            </div>
                            <div class="checkout__input">
                                <p>Unt No.<span>*</span></p>
                                <input type="text" placeholder="<?php echo $unit_no ; ?>" class="checkout__input__add">
                            </div>
                            <div class="checkout__input">
                                <p>Address line 1<span>*</span></p>
                                <input type="text" placeholder="<?php echo $address_line_1 ; ?>" class="checkout__input__add">
                            </div>
                            <div class="checkout__input">
                                <p>Address line 2<span>*</span></p>
                                <input type="text" placeholder="<?php echo $address_line_2 ; ?>" class="checkout__input__add">
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" placeholder="<?php echo $city ; ?>">
                            </div>
                            <div class="checkout__input">
                                <p>Country/State<span>*</span></p>
                                <input type="text" placeholder="<?php echo $country ; ?>">
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" placeholder="<?php echo $postcode ; ?>">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" placeholder="<?php echo $phone ; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" placeholder="<?php echo $email ; ?>">
                                    </div>
                                </div>
                            </div>