<?php
 session_start();
// get the value of the first name input field
$First_name = $_POST['Fname'];
// get the value of the last name input field
$Last_name = $_POST['Lname'];
// get the value of the Address Line 1 input field
$Address_line_1 = $_POST['address_line_1'];
// get the value of the Address line 2 input field
$Address_line_2 = $_POST['address_line_2'];
// get the value of the City input field
$City = $_POST['city'];
// get the value of the Region input field
$Region = $_POST['region'];
// get the value of the Country input field
$Country = $_POST['country'];
// get the value of the Postcode input field
$Postcode = $_POST['postcode'];
// get the value of the Name on card input field
$Name_on_card = $_POST['name_on_card'];
// get the value of the Provider input field
$Provider = $_POST['provider'];
// get the value of the Card no input field
$Card_no = $_POST['card_no'];
// get the value of the Expiry date input field
$Expiry_date = $_POST['expiry_date'];
// get the value of the CVV input field
$Cvv = $_POST['cvv'];

// Get the customer_id from the session
$customer_id = $_SESSION['user_id'];
// Connect to the database
include 'config.php';
    // Prepare an SQL statement to select the address id of the customer from the customer table
    $sql4 = "SELECT * FROM Address WHERE User_id = ?";
    $stmt4 = $conn->prepare($sql4);
    // Bind the customer_id to the parameter of the SQL statement
    $stmt4->bind_param("i", $customer_id); // Use "i" for integer type
    // Execute the SQL statement
    if ($stmt4->execute()) {
      // If the query is successful, get the result set
      $result4 = $stmt4->get_result();
      // Check if the result set is not empty
      if ($result4->num_rows > 0) {
        // Fetch the address id from the result set
        $row = $result4->fetch_assoc();
        $address_id = $row["Id"];
        // Prepare an SQL statement to update the address table with the new address information
        $sql5 = "UPDATE Address SET Address_line_1 = ?, Address_line_2 = ?, City = ?, Region = ?, Country = ?, Postcode = ? WHERE Id = ?";
        $stmt5 = $conn->prepare($sql5);
        // Bind the parameters to the SQL statement
        $stmt5->bind_param("ssssssi", $Address_line_1, $Address_line_2, $City, $Region, $Country, $Postcode, $address_id); // Use "s" for string type and "i" for integer type
        // Assign the values to the variables from the POST data
        $Address_line_1 = $_POST['address_line_1'];
        $Address_line_2 = $_POST['address_line_2'];
        $City = $_POST['city'];
        $Region = $_POST['region'];
        $Country = $_POST['country'];
        $Postcode = $_POST['postcode'];
        
        // Execute the SQL statement
        if ($stmt5->execute()) {
          // If the query is successful, display a success message
          echo "Address updated successfully.";
        } else {
          // If the query fails, display an error message
          echo "Error updating address: " . $conn->error;
        }
      } else {
        // If the result set is empty, display an error message
        echo "Customer not found.";
      }
    } else {
      // If the query fails, display an error message
      echo "Error selecting address: " . $conn->error;
    }
    
// Prepare an SQL statement to join the cart item table with the product configuration table, the product item table, the variation table, and the cart table
$sql1 = "SELECT ci.Product_Configuration_id, ci.Quantity, ci.Total, p.Name as Product_Name, v.Name as Variation_Name FROM cart_item ci 
        INNER JOIN product_configuration pc ON ci.Product_Configuration_id = pc.Id 
        INNER JOIN product_item p ON pc.Product_id = p.Id
        INNER JOIN variation v ON pc.Variation_id = v.Id
        INNER JOIN cart c ON ci.Cart_id = c.Id 
        WHERE c.Customer_id = ?";
$stmt1 = $conn->prepare($sql1);
// Bind the customer_id to the parameter of the SQL statement
$stmt1->bind_param("i", $customer_id); // Use "i" for integer type
// Execute the SQL statement
if ($stmt1->execute()) {
  // If the query is successful, get the result set
  $result1 = $stmt1->get_result();
  // Check if the result set is not empty
  if ($result1->num_rows > 0) {
    // Declare an empty array to store the product configuration ids
    $product_configuration_ids = array();
    // Declare an empty array to store the quantities
    $quantities = array();
    // Declare an empty array to store the totals
    $totals = array();
    // Declare an empty array to store the product names
    $product_names = array();
    // Declare an empty array to store the variation names
    $variation_names = array();
    // Loop through the result set and store the product configuration id, quantity, total, product name, and variation name in arrays
    while ($row = $result1->fetch_assoc()) {
      // Append the product configuration id to the product_configuration_ids array
      array_push($product_configuration_ids, $row["Product_Configuration_id"]);
      // Append the quantity to the quantities array
      array_push($quantities, $row["Quantity"]);
      // Append the total to the totals array
      array_push($totals, $row["Total"]);
      // Append the product name to the product_names array
      array_push($product_names, $row["Product_Name"]);
      // Append the variation name to the variation_names array
      array_push($variation_names, $row["Variation_Name"]);
    }
  }
}
 // Loop through the arrays and insert each product into the order items table
for ($i = 0; $i < count($product_configuration_ids); $i++) {
    // Prepare an SQL statement to insert the product configuration id, quantity, price, and date created into the order items table
    $sql2 = "INSERT INTO Order_items (Product_Configuration_id, Quantity, Price, Date_created) VALUES (?, ?, ?, ?)";
    $stmt2 = $conn->prepare($sql2);
    // Bind the parameters to the SQL statement
    $stmt2->bind_param("iids", $product_configuration_id, $quantity, $price, $date_created); // Use "i" for integer type, "d" for decimal type, and "s" for string type
    // Assign the values to the variables
    $product_configuration_id = $product_configuration_ids[$i]; // Get the product configuration id from the array
    $quantity = $quantities[$i]; // Get the quantity from the array
    $price = $totals[$i]; // Get the price from the array
    $date_created = date("Y-m-d H:i:s"); // Get the current date and time
    // Execute the SQL statement
    if ($stmt2->execute()) {
      // If the query is successful, get the last inserted id of the order items table
      $order_item_id = $conn->insert_id;

      $order_item_ids = array();
      // Append the order item id to the order_item_ids array
      array_push($order_item_ids, $order_item_id);
    }
  }

 // Prepare an SQL statement to insert the card information into the Cards table
$sql6 = "INSERT INTO Cards (Customer_id, Name_on_Card, Provider, Card_no, Expiry_date, CVV) VALUES (?, ?, ?, ?, ?, ?)";
$stmt6 = $conn->prepare($sql6);
// Bind the parameters to the SQL statement
$stmt6->bind_param("isissi", $customer_id, $Name_on_Card, $Provider, $Card_no, $Expiry_date, $Cvv); // Use "i" for integer type, "s" for string type, and "d" for date type
// Assign the values to the variables from the POST data
$customer_id = $_SESSION['user_id']; // Get the customer id from the session
$Name_on_Card = $_POST['name_on_card']; // Get the name on card from the form
$Provider = $_POST['provider']; // Get the provider from the form
$Card_no = $_POST['card_no']; // Get the card number from the form
$Expiry_date = $_POST['expiry_date']; // Get the expiry date from the form
$Cvv = $_POST['cvv']; // Get the CVV from the form
// Execute the SQL statement
if ($stmt6->execute()) {
  // If the query is successful, get the last inserted id of the card table
  $card_id = $conn->insert_id;
  // Free the result set of the query
  $stmt6->free_result();
} else {
  // If the query fails, display an error message
  echo "Error adding card information: " . $conn->error;
}

// Prepare an SQL statement to select the total from the cart table
$sql4 = "SELECT Total FROM Cart WHERE Customer_id = ?";
$stmt4 = $conn->prepare($sql4);
// Bind the customer_id to the parameter of the SQL statement
$stmt4->bind_param("i", $customer_id); // Use "i" for integer type
// Execute the SQL statement
$stmt4->execute();
//  bind the result variable
$stmt4->bind_result($Total);
// Fetch the value from the result set
$stmt4->fetch();
//assign the value to $total_amount
$total_amount = $Total;
// Free the result set of the query
$stmt4->free_result();

// Prepare an SQL statement to insert the order information into the shop order table
$sql3 = "INSERT INTO Shop_order (Invoice_no, Customer_id, Address_id, order_item_id, Card_id, Total_amount, Status, Date_created, Date_updated) VALUES (?, ?, ?, ?, ?, ?, ?, CURDATE(), ?)";
$stmt3 = $conn->prepare($sql3);
// Bind the parameters to the SQL statement
$stmt3->bind_param("iiisidss", $invoice_no, $customer_id, $address__Id, $order_item_id, $card__id, $total__amount, $status, $date_updated); // Use "i" for integer type, "d" for decimal type, and "s" for string type
// Assign the values to the variables
$invoice_no = rand(100000, 999999); // Generate a random invoice number
$customer_id = $_SESSION['user_id']; // Get the customer id from the session
$address__Id = $address_id; // Get the address id from the session
$order_item_id = implode(",", $order_item_ids); // Join the elements of the order_item_ids array into a single string, separated by a comma
$card__id = $card_id; // Get the card id 
$total__amount = $total_amount; // Get the total amount from the cart total variable
$status = 0; // Set the status to 0, meaning pending
$date_updated = NULL; // Set the date updated to NULL, meaning not updated yet
// Execute the SQL statement
if ($stmt3->execute()) {
  // If the query is successful, display a success message
  echo "Your order has been placed successfully!";
} else {
  // If the query fails, display an error message
  echo "Error inserting order: " . $conn->error;
}



header("Location: notification.html");
?>