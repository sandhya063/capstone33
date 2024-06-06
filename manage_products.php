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

function fetchCategories($conn) {
    $sql = "SELECT * FROM Product_Category";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

function fetchProducts($conn) {
    $sql = "SELECT Product_item.*, Product_Category.Name as CategoryName 
            FROM Product_item 
            INNER JOIN Product_Category ON Product_item.Category_id = Product_Category.Id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

// Handle form submission for adding new product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $productName = $_POST['product_name'];
    $productDescription = $_POST['product_description'];
    $productPrice = $_POST['product_price'];
    $productCategory = $_POST['product_category'];
    $productImagePath = ''; // This can be set to a default image or handled via file upload

    // Insert new product into Product_item table
    $stmt = $conn->prepare("INSERT INTO Product_item (Category_id, Name, Description, Price, Image_path) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $productCategory, $productName, $productDescription, $productPrice, $productImagePath);

    if ($stmt->execute()) {
        header("Location: manage_products.php");
        exit();
    } else {
        echo "Error adding product: " . $conn->error;
    }

    $stmt->close();
}

// Handle Product Deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_product'])) {
    $productId = $_POST['product_id'];
    $stmt = $conn->prepare("DELETE FROM Product_item WHERE Id = ?");
    $stmt->bind_param("i", $productId);

    if ($stmt->execute()) {
        echo "<script>alert('Product deleted successfully'); window.location = 'admin.php';</script>";
    } else {
        echo "Error deleting product: " . $conn->error;
    }

    $stmt->close();
}
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
        <h1>Manage Products</h1>

        <section>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $products = fetchProducts($conn);
                            foreach ($products as $product) {
                                echo "<tr>";
                                echo "<td>{$product['Name']}</td>";
                                echo "<td>{$product['CategoryName']}</td>";
                                echo "<td>{$product['Description']}</td>";
                                echo "<td>\${$product['Price']}</td>";
                                echo "<td><a href='edit_product.php?id={$product['Id']}' class='btn btn-primary'>Edit</a></td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Form for adding new product -->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mt-3">
                <h3>Add New Product</h3>

                <div class="mb-3">
                    <label for="product_name" class="form-label">Product Name:</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" required>
                </div>

                <div class="mb-3">
                    <label for="product_description" class="form-label">Description:</label>
                    <input type="text" class="form-control" id="product_description" name="product_description" required>
                </div>

                <div class="mb-3">
                    <label for="product_price" class="form-label">Price:</label>
                    <input type="text" class="form-control" id="product_price" name="product_price" required>
                </div>

                <div class="mb-3">
                    <label for="product_category" class="form-label">Category:</label>
                    <select class="form-control" id="product_category" name="product_category" required>
                        <?php
                            $categories = fetchCategories($conn);
                            foreach ($categories as $category) {
                                echo "<option value='{$category['Id']}'>{$category['Name']}</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="product_image" class="form-label">Image Path:</label>
                    <input type="text" class="form-control" id="product_image" name="product_image">
                </div>

                <button type="submit" class="btn btn-primary" name="add_product">Add Product</button>
            </form>
        </section>
    </div>
</div>
</body>
</html>
