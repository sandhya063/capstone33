<?php
include 'config.php';

function fetchAllUsers($conn) {
    $sql = "SELECT * FROM `user`"; // Updated table name
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

function fetchProducts($conn) {
    $sql = "SELECT * FROM `product_item`"; // Updated table name
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

function fetchOrders($conn) {
    $sql = "SELECT * FROM `orders`"; // Updated table name
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

// Handle form submission for adding new order
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_order'])) {
    $customerId = $_POST['customer_id'];
    $totalAmount = $_POST['total_amount'];
    $status = $_POST['status'];

    $sql = "INSERT INTO `orders` (User_id, Total_price, Status) VALUES ('$customerId', '$totalAmount', '$status')"; // Updated table name

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php#orders");
        exit();
    } else {
        echo "Error adding order: " . $conn->error;
    }
}

// Handle form submission for adding new delivery
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_delivery'])) {
    $customerId = $_POST['customer_id'];
    $addressId = $_POST['address_id'];
    $deliveryStaffId = $_POST['delivery_staff_id'];
    $status = $_POST['status'];

    $sql = "INSERT INTO `delivery` (Customer_id, Address_id, Delivery_staff_id, Status) VALUES ('$customerId', '$addressId', '$deliveryStaffId', '$status')"; // Updated table name

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php#deliveries");
        exit();
    } else {
        echo "Error adding delivery: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <style>
  body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
        }

        #navbar {
            width: 300px;
            background-color: #333;
            padding-top: 20px;
            position: fixed;
            height: 100%;
            overflow: auto;
            color: white;
            transition: width 0.3s;
        }

        #navbar img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto;
            display: block;
            margin-bottom: 20px;
        }

        #navbar a {
            padding: 15px;
            text-decoration: none;
            font-size: 16px;
            color: #fff;
            display: block;
            transition: background-color 0.3s;
        }

        #navbar a:hover {
            background-color: #555;
        }

        .content {
            margin-left: 300px;
            padding: 20px;
            transition: margin-left 0.3s;
            width: calc(100% - 300px);
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: #fff;
        }

        /* Responsive styling */
        @media screen and (max-width: 600px) {
            #navbar {
                width: 100%;
                margin-left: -100%;
                transition: margin-left 0.3s;
            }

            .content {
                margin-left: 0;
                width: 100%;
                transition: margin-left 0.3s;
            }

            #navbar a {
                text-align: center;
            }
        }
    </style>
</head>
<body>

<div id="navbar">
        <img src="img/admin.png" alt="Profile Picture">
        <a href="admin.php">Admin</a>
        <a href="manage_users.php">Manage Users</a>
        <a href="manage_products.php">Manage Products</a>
        <a href="manage_orders.php">Manage Orders</a>
        <a href="manage_reviews.php">View Reviews</a>
        <a href="manage_suppliers.php">Manage Suppliers</a>
        <a href="logout.php">Logout</a>
    </div>
<div class="container">
<div class="content">
        <h1>Admin Dashboard</h1>

        <section>
            <h2>Manage Orders</h2>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User ID</th>
                        <th>Total Price</th>
                        <th>Order Date</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $orders = fetchOrders($conn);
                    foreach ($orders as $order) {
                        echo "<tr>";
                        echo "<td>{$order['Id']}</td>";
                        echo "<td>{$order['User_id']}</td>";
                        echo "<td>{$order['Total_price']}</td>";
                        echo "<td>{$order['Order_date']}</td>";
                        echo "<td>{$order['Status']}</td>";
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <h3>Add New Order</h3>
            <form method="post">
                <div class="mb-3">
                    <label for="user_id" class="form-label">User ID:</label>
                    <input type="text" class="form-control" id="user_id" name="user_id" required>
                </div>
                <div class="mb-3">
                    <label for="total_price" class="form-label">Total Price:</label>
                    <input type="text" class="form-control" id="total_price" name="total_price" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status:</label>
                    <input type="text" class="form-control" id="status" name="status" required>
                </div>
                <button type="submit" class="btn btn-primary" name="add_order">Add Order</button>
            </form>
        </section>
    </div>
</div>
    <?php
    $conn->close();
    ?>

   
</body>
</html>
