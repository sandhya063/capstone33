<?php
session_start();

// Check if the product ID to be removed is set in the URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $remove_id = $_GET['id'];

    // Loop through the cart and remove the item with the specified ID
    foreach($_SESSION['user_id'] as $key => $product_id) {
        if($product['product_id'] == $remove_id) {
            unset($_SESSION['user_id'][$key]);
            // Optional: You can set a flag to indicate successful removal
            $_SESSION['item_removed'] = true;
            break; // Stop the loop after removing the item
        }
    }
}

// Redirect back to the cart page or wherever you want to go
header("Location: cart.php");
exit();
?>
