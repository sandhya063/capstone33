<?php
include 'config.php';

function fetchAllSuppliers($conn) {
    $sql = "SELECT * FROM supplier";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

// Handle form submission for adding new supplier
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_supplier'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $item = $_POST['item'];
    $unitNo = $_POST['unit_no'];
    $addressLine1 = $_POST['address_line_1'];
    $addressLine2 = $_POST['address_line_2'];
    $city = $_POST['city'];
    $region = $_POST['region'];
    $postcode = $_POST['postcode'];
    $country = $_POST['country'];

    $sql = "INSERT INTO supplier (Name, Email, Phone_no, Supplied_item, Unit_no, Address_line_1, Address_line_2, City, Region, Postcode, Country) 
            VALUES ('$name', '$email', '$phone', '$item', '$unitNo', '$addressLine1', '$addressLine2', '$city', '$region', '$postcode', '$country')";

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_suppliers.php");
        exit();
    } else {
        echo "Error adding supplier: " . $conn->error;
    }
}

?>
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <!-- Bootstrap CSS -->
    <style>
    body {
        font-family: Arial, sans-serif;
    }
    table {
        width: 90%;
        border-collapse: collapse;
        margin: 20px 0;
    }
    th, td {
        text-align: left;
        padding: 8px;
        border: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
    tr:nth-child(even) {background-color: #f9f9f9;}
    tr:hover {background-color: #e2e2e2;}
    a.edit-btn {
        display: inline-block;
        padding: 5px 10px;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }
    a.edit-btn:hover {
        background-color: #45a049;
    }
</style>
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
    <h1>Manage Suppliers</h1>

<form method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="phone" name="phone" required>
    </div>
    <div class="mb-3">
        <label for="item" class="form-label">Supplied Item</label>
        <input type="text" class="form-control" id="item" name="item" required>
    </div>
    <div class="mb-3">
        <label for="unit_no" class="form-label">Unit Number</label>
        <input type="number" class="form-control" id="unit_no" name="unit_no" required>
    </div>
    <div class="mb-3">
        <label for="address_line_1" class="form-label">Address Line 1</label>
        <input type="text" class="form-control" id="address_line_1" name="address_line_1" required>
    </div>
    <div class="mb-3">
        <label for="address_line_2" class="form-label">Address Line 2</label>
        <input type="text" class="form-control" id="address_line_2" name="address_line_2">
    </div>
    <div class="mb-3">
        <label for="city" class="form-label">City</label>
        <input type="text" class="form-control" id="city" name="city" required>
    </div>
    <div class="mb-3">
        <label for="region" class="form-label">Region</label>
        <input type="text" class="form-control" id="region" name="region" required>
    </div>
    <div class="mb-3">
        <label for="postcode" class="form-label">Postcode</label>
        <input type="text" class="form-control" id="postcode" name="postcode" required>
    </div>
    <div class="mb-3">
        <label for="country" class="form-label">Country</label>
        <input type="text" class="form-control" id="country" name="country" required>
    </div>
    <button type="submit" class="btn btn-primary" name="add_supplier">Add Supplier</button>
</form>

<hr>

<h2>Existing Suppliers</h2>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Supplier ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Supplied Item</th>
                <th>Unit Number</th>
                <th>Address</th>
                <th>City</th>
                <th>Region</th>
                <th>Postcode</th>
                <th>Country</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $suppliers = fetchAllSuppliers($conn);
            foreach ($suppliers as $supplier) {
                echo "<tr>";
                echo "<td>{$supplier['Id']}</td>";
                echo "<td>{$supplier['Name']}</td>";
                echo "<td>{$supplier['Email']}</td>";
                echo "<td>{$supplier['Phone_no']}</td>";
                echo "<td>{$supplier['Supplied_item']}</td>";
                echo "<td>{$supplier['Unit_no']}</td>";
                echo "<td>{$supplier['Address_line_1']}, {$supplier['Address_line_2']}, {$supplier['City']}, {$supplier['Region']}, {$supplier['Postcode']}, {$supplier['Country']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</div>
    <?php
    $conn->close();
    ?>

    <script>
        function removeInStoreStaff(staffId) {
            if (confirm("Are you sure you want to remove this InStore Staff member?")) {
                document.getElementById("instore_staff_id").value = staffId;
                document.getElementById("remove_instore_staff_form").submit();
            }
        }
    </script>
</body>
</html>
