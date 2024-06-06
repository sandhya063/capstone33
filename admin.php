<?php
include 'config.php';

function fetchAllUsers($conn) {
    $sql = "SELECT * FROM User";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

function fetchProducts($conn) {
    $sql = "SELECT * FROM Product_item";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

function fetchOrders($conn) {
    $sql = "SELECT * FROM orders";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

function fetchReviews($conn) {
    $sql = "SELECT * FROM Review";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

// Handle form submission for removing InStore Staff
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_instore_staff'])) {
    $inStoreStaffId = $_POST['instore_staff_id'];

    $sql = "DELETE FROM InStore_staff WHERE Id = $inStoreStaffId";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php#instorestaff");
        exit();
    } else {
        echo "Error removing InStore Staff: " . $conn->error;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_user'])) {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $sql = "INSERT INTO User (FName, LName, Email, Type) VALUES ('$firstName', '$lastName', '$email', '$role')";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php#users");
        exit();
    } else {
        echo "Error adding user: " . $conn->error;
    }
}


// Handle form submission for adding new product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $productName = $_POST['product_name'];
    $productDescription = $_POST['product_description'];
    $productPrice = $_POST['product_price'];

    $sql = "INSERT INTO Product_item (Name, Description, Price) VALUES ('$productName', '$productDescription', '$productPrice')";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php#products");
        exit();
    } else {
        echo "Error adding product: " . $conn->error;
    }
}

// Handle form submission for adding new order
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_order'])) {
    $customerId = $_POST['customer_id'];
    $totalAmount = $_POST['total_amount'];
    $status = $_POST['status'];

    $sql = "INSERT INTO Shop_order (Customer_id, Total_amount, Status) VALUES ('$customerId', '$totalAmount', '$status')";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php#orders");
        exit();
    } else {
        echo "Error adding order: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
    <h2>Manage Users</h2>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $users = fetchAllUsers($conn);
                foreach ($users as $user) {
                    echo "<tr>";
                    echo "<td>{$user['Id']}</td>";
                    echo "<td>{$user['FName']}</td>";
                    echo "<td>{$user['LName']}</td>";
                    echo "<td>{$user['Email']}</td>";
                    echo "<td>{$user['Type']}</td>";
             
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</section>

<section>
    <h2>Manage Products</h2>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $products = fetchProducts($conn);
                foreach ($products as $product) {
                    echo "<tr>";
                    echo "<td>{$product['Id']}</td>";
                    echo "<td>{$product['Name']}</td>";
                    echo "<td>{$product['Description']}</td>";
                    echo "<td>{$product['Price']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</section>


<section>
    <h2>Manage Orders</h2>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Total Amount</th>
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
                    echo "<td>{$order['Status']}</td>";
                     echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</section>

<section>
    <h2>View Reviews</h2>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Review ID</th>
                    <th>Customer</th>
                    <th>Order</th>
                    <th>Rating</th>
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $reviews = fetchReviews($conn);
                foreach ($reviews as $review) {
                    echo "<tr>";
                    echo "<td>{$review['Id']}</td>";
                    echo "<td>{$review['Customer_id']}</td>";
                    echo "<td>{$review['Shop_order_id']}</td>";
                    echo "<td>{$review['Rating']}</td>";
                    echo "<td>{$review['Comment']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

        </div>
    </div>
    

  
   

    <?php
    $conn->close();
    ?>


</body>
   <!-- Bootstrap JS (Popper.js and Bootstrap JS) -->
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</html>
