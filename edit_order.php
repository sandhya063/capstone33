<?php
include 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $customerId1 = $_POST['customer_id'];

}
function fetchAddresses($conn, $customerId1) {
    $sql = "SELECT * FROM Address WHERE Customer_id = $customerId1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}
function fetchDeliveryStaff($conn) {
    $sql = "SELECT U.Id, CONCAT(U.FName, ' ', U.LName) AS Name
    FROM User U
    INNER JOIN Delivery_staff D ON U.Id = D.Id
    WHERE U.Type = 'Delivery_staff';
    ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $orderId = $_GET['id'];

    // Fetch order details by ID
    $sql = "SELECT * FROM Shop_order WHERE Id = $orderId";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $order = $result->fetch_assoc();
    } else {
        echo "Order not found.";
        exit();
    }
} else {
    // Handle form submission for updating order details
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $orderId = $_POST['order_id'];
        $customerId2 = $_POST['customer_id'];
        $totalAmount = $_POST['total_amount'];
        $status = $_POST['status'];

        // Validate and update order details in the database
        $sql = "UPDATE Shop_order SET Customer_id = '$customerId2', Total_amount = '$totalAmount', Status = '$status' WHERE Id = $orderId";

        if ($conn->query($sql) === TRUE) {


            // Redirect to the order management page after updating
            header("Location: admin.php#orders");
            exit();
        } else {
            echo "Error updating order: " . $conn->error;
        }
    }
}
      
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $customerId1 = $_POST['customer_id'];
            $deliveryStaffId = $_POST['delivery_staff_id'];
        
            if ($customerId1 !== NULL && $deliveryStaffId !== NULL) {
                $addressId = fetchAddresses($conn, $customerId1);
                // Assuming $addressId is obtained from $addresses
        
                // Prepare SQL statement
                $stmt = $conn->prepare("INSERT INTO Delivery (Customer_id, Address_id, Delivery_staff_id, Status) VALUES (?, ?, ?, 0)");
                $stmt->bind_param("iii", $customerId1, $addressId, $deliveryStaffId);
        
                // Execute the prepared statement
                if ($stmt->execute()) {
                    echo "New delivery created successfully";
                } else {
                    echo "Error: " . $stmt->error;
                }
            } else {
                echo "Customer ID or Delivery Staff ID is missing.";
            }
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: #fff;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Edit Order</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mt-3">
        <input type="hidden" name="order_id" value="<?php echo $order['Id']; ?>">
        
        <label for="customer_id">Customer ID:</label>
        <input type="text" id="customer_id" name="customer_id" value="<?php echo $order['Customer_id']; ?>">

        <label for="total_amount">Total Amount:</label>
        <input type="text" id="total_amount" name="total_amount" value="<?php echo $order['Total_amount']; ?>">

        <label for="status">Status:</label>
        <select id="status" name="status">
        <option value="0" <?php echo $order['Status'] == '0' ? 'selected' : ''; ?>>Pending</option>
        <option value="1" <?php echo $order['Status'] == '1' ? 'selected' : ''; ?>>Confirmed</option>
        </select>

        <div class="mb-3">
        <label for="delivery_staff_id">Delivery Staff:</label>
        <select class="form-control" id="delivery" name="delivery_staff_id" required>
        <?php
    $staffMembers = fetchDeliveryStaff($conn);
    $first = true;
    foreach ($staffMembers as $staff) {
        if ($first) {
            echo "<option value='{$staff['Id']}' selected>{$staff['Name']}</option>";
            $first = false;
        } else {
            echo "<option value='{$staff['Id']}'>{$staff['Name']}</option>";
        }
    }
?>

</select>
        </div>

        <input type="submit" value="Ready For Delivery">
        
    </form>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
