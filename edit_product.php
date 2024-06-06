<?php
include 'config.php';

// Fetch product details
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $sql = "SELECT * FROM Product_item WHERE Id = $productId";
    $result = $conn->query($sql);
    $product = $result->num_rows > 0 ? $result->fetch_assoc() : null;
}

// Handle update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_product'])) {
    $productId = $_POST['product_id']; // Ensure this matches the name attribute of your hidden input field
    $productName = $_POST['product_name'];
    $productDescription = $_POST['product_description'];
    $productPrice = $_POST['product_price'];

    // Prepare the SQL statement to update product details
    $stmt = $conn->prepare("UPDATE Product_item SET Name = ?, Description = ?, Price = ? WHERE Id = ?");
    $stmt->bind_param("ssdi", $productName, $productDescription, $productPrice, $productId);
    
    if ($stmt->execute()) {
        echo "<script>alert('Product updated successfully'); window.location.href = 'manage_products.php';</script>"; // Redirect to product list or confirmation page
    } else {
        echo "Error updating product: " . $conn->error;
    }
    $stmt->close();
}


// Handle delete
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_product'])) {
    $productId = $_POST['product_id']; // Ensure this matches the name attribute of your hidden input field
    
    // Prepare statement for deletion
    $stmt = $conn->prepare("DELETE FROM Product_item WHERE Id = ?");
    $stmt->bind_param("i", $productId);
    
    if ($stmt->execute()) {
        echo "<script>alert('Product deleted successfully'); window.location.href = 'manage_products.php';</script>";
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
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            background-color: #333;
            color: #fff;
            padding: 20px;
        }

        .form-table {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border-collapse: collapse;
            width: 50%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-table th, .form-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .form-table th {
            background-color: #4CAF50;
            color: white;
        }

        .form-table tr:hover {
            background-color: #f5f5f5;
        }

        input[type="text"], input[type="email"], input[type="submit"] {
            width: 95%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: auto;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .delete-button {
            background-color: #f44336;
        }

        .form-container {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <?php if ($product): ?>
        <form method="POST" action="">
            <!-- Display product details in editable form fields -->
            <input type="hidden" name="product_id" value="<?php echo $product['Id']; ?>">
            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $product['Name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="product_description">Description:</label>
                <input type="text" class="form-control" id="product_description" name="product_description" value="<?php echo $product['Description']; ?>" required>
            </div>
            <div class="form-group">
                <label for="product_price">Price:</label>
                <input type="number" class="form-control" id="product_price" name="product_price" value="<?php echo $product['Price']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="update_product">Update Product</button>
            <button type="submit" class="btn btn-danger" name="delete_product" onclick="return confirm('Are you sure?')">Delete Product</button>
        </form>
    <?php else: ?>
        <p>Product not found.</p>
    <?php endif; ?>
</body>
</html>
