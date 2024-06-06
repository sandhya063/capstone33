<?php
// Start the session
session_start();

include 'config.php';

// Check if the $_GET array has an action key
if (!empty($_GET["action"])) {
  // Get the action value
  $action = $_GET["action"];
  // Switch on the action value
  switch ($action) {
    // Case for adding a product to the cart
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
    // Case for removing a product from the cart
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
<html>
<head>
  <title>Cart</title>
  <link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
  <div id="shopping-cart">
    <div class="txt-heading">Shopping Cart</div>
    <!-- Display the cart items from the session in a table -->
    <?php
    if (isset($_SESSION["cart_item"])) {
      $total_quantity = 0;
      $total_price = 0;
    ?>
    <table class="tbl-cart" cellpadding="10" cellspacing="1">
      <tbody>
        <tr>
          <th style="text-align:left;">Name</th>
          <th style="text-align:left;">Product Configuration ID</th>
          <th style="text-align:right;" width="5%">Quantity</th>
          <th style="text-align:right;" width="10%">Unit Price</th>
          <th style="text-align:right;" width="10%">Price</th>
          <th style="text-align:center;" width="5%">Remove</th>
        </tr>
        <?php
        foreach ($_SESSION["cart_item"] as $item) {
          // Calculate the item price and the cart total
          $item_price = $item["quantity"] * $item["price"];
          $total_price += $item_price;
          $total_quantity += $item["quantity"];
        ?>
        <tr>
          <td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
          <td><?php echo $item["product_configuration_id"]; ?></td>
          <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
          <td style="text-align:right;"><?php echo "$ " . number_format($item["price"], 2); ?></td>
          <td style="text-align:right;"><?php echo "$ " . number_format($item_price, 2); ?></td>
          <td style="text-align:center;"><a href="cart.php?action=remove&product_configuration_id=<?php echo $item["product_configuration_id"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
        </tr>
        <?php
        }
        ?>
        <tr>
          <td colspan="2" align="right">Total:</td>
          <td align="right"><?php echo $total_quantity; ?></td>
          <td align="right" colspan="2"><strong><?php echo "$ " . number_format($total_price, 2); ?></strong></td>
          <td></td>
        </tr>
      </tbody>
    </table>
    <?php
    } else {
    ?>
    <div class="no-records">Your Cart is Empty</div>
    <?php
    }
    ?>
  </div>
  <!-- Add a link to empty the cart -->
  <div class="cart-footer">
    <a id="btnEmpty" href="cart.php?action=empty">Empty Cart</a>
  </div>
  <!-- Add a button to proceed to checkout -->
  <div class="cart-footer">
    <a id="btnCheckout" href="checkout.php">Checkout</a>
  </div>
</body>
</html>
