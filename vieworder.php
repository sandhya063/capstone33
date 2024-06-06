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
                    <tr>
                        <th>Customer ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $customer['Id']; ?></td>
                        <td><?php echo $customer['Name']; ?></td>
                        <td><?php echo $customer['Email']; ?></td>
                        <td><?php echo $customer['Phone']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h2>Products Bought</h2>
        <ul>
            <?php
            foreach ($orderedProducts as $product) {
                echo "<li>$product</li>";
            }
            ?>
        </ul>

        <a href="manage_orders.php" class="btn btn-primary">Back to Orders</a>
    </div>
</body>
</html>
<?php
$conn->close();
?>
