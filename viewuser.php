<?php
include 'config.php';
// Function to fetch order details by ID
function fetchOrderDetails($conn, $orderId) {
    $sql = "SELECT * FROM Shop_order WHERE Id = '$orderId'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Function to fetch customer details by ID
function fetchCustomerDetails($conn, $customerId) {
    $sql = "SELECT * FROM User WHERE Id = '$customerId'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}




if (isset($_GET['id'])) {
    $orderId = $_GET['id'];
    $order = fetchOrderDetails($conn, $orderId);

    if (!$order) {
        echo "Order not found.";
        exit();
    }

    $customerId = $order['Customer_id'];
    $customer = fetchCustomerDetails($conn, $customerId);

    if (!$customer) {
        echo "Customer not found.";
        exit();
    }
  
}
?>
    


  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
    <div class="container">
        <h1>Order Details</h1>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer ID</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $order['Id']; ?></td>
                        <td><?php echo $order['Customer_id']; ?></td>
                        <td><?php echo $order['Total_amount']; ?></td>
                        <td><?php echo $order['Status']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h2>Customer Details</h2>
    
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <?php
                            $sql = "SELECT customer.Id AS Id,
                            user.FName, user.LName, user.Phone_no, user.Email,
                            address.Unit_no,address.Address_line_1,address.City,address.Region,address.Postcode
                            
                            FROM customer
                            INNER JOIN user ON customer.id = user.id
                            INNER JOIN address ON customer.id = address.id";

                             $result = $conn->query($sql);

                    // Check if the query was successful
                                  if ($result) {
                                     if ($result->num_rows > 0) {
                            // Display data in a single table
                                    echo "<div class='table-responsive'>
                                    <table class='table table-bordered'>";
                                    echo "<tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Deilvery Address</th>
                                    
                                    </tr>";

                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr><td>" . $row['Id'] . "</td>
                                        <td>" . $row['FName'] . "</td>
                                        <td>" . $row['LName'] . "</td>
                                        <td>" . $row['Phone_no'] . "</td>
                                        <td>" . $row['Email'] . "</td>
                                        <td>" . $row['Unit_no'] . ' ' . $row['Address_line_1'] . ' ,' . $row['City'] . ' ,' . $row['Region'] . ' ,' . $row['Postcode'] ."</td>
                                        
                                        
                                        </tr>";
                                                            }

                                                            echo "</table>";
                                                        } else {
                                        echo "No records found";
                                    }

                        }
                        ?>
                </tbody>
            </table>
        </div>

        <h2>Products Bought</h2>

    
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <?php
$sql = "SELECT Product_item.Name, Product_item.Description, Product_item.Price, Variation.Name as VariationName, Order_items.Quantity, Order_items.Price as OrderPrice
FROM Product_item
INNER JOIN Product_Configuration ON Product_item.Id = Product_Configuration.Product_id
INNER JOIN Variation ON Product_Configuration.Variation_id = Variation.Id
INNER JOIN Order_items ON Product_Configuration.Id = Order_items.Product_Configuration_id
INNER JOIN Shop_order ON Order_items.Id = Shop_order.order_item_id
WHERE Shop_order.Customer_id = $customerId";

$result = $conn->query($sql);

                // Check if the query was successful
                              if ($result) {
                                 if ($result->num_rows > 0) {
                        // Display data in a single table
                                echo "<div class='table-responsive'>
                                <table class='table table-bordered'>";
                                echo "<tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Order Price</th>
                    
                                
                                </tr>";

                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                    <td>" . $row["Name"]. " (" . $row["VariationName"]. ")</td>
                                    <td>" . $row['Description'] . "</td>
                                    <td>" . $row['Price'] . "</td>
                                    <td>" . $row['Quantity'] . "</td>
                                    <td>" . $row['OrderPrice'] ."</td>
                                    </tr>";
                                }
                                
                                echo "</table>";
                                } else {
                                    echo "No records found";
                                
                                }

                    }
                    ?>
            </tbody>
        </table>
    </div>

       

        <a href="manage_orders.php" class="btn btn-primary">Back to Orders</a>
    </div>
</body>
</html>
<?php
$conn->close();
?>
