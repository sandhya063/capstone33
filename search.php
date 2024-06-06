<?php
include 'config.php';  // Ensure this path is correct

// Fetch the search query from the URL
$query = isset($_GET['query']) ? $_GET['query'] : '';

function searchDatabase($conn, $query) {
    $results = [];

    // Sanitize the query to prevent SQL injection
    $query = $conn->real_escape_string($query);

    // Define your search queries for each table you want to search
    $sqlUsers = "SELECT 'User' AS TableName, Id, CONCAT(FName, ' ', LName) AS Name, Email, Type AS Details FROM User WHERE FName LIKE '%$query%' OR LName LIKE '%$query%' OR Email LIKE '%$query%'";
    $sqlProducts = "SELECT 'Product_item' AS TableName, Id, Name, Description AS Details, Price FROM Product_item WHERE Name LIKE '%$query%' OR Description LIKE '%$query%'";
    $sqlOrders = "SELECT 'Orders' AS TableName, Id, User_id, Total_price AS Details, Order_date FROM orders WHERE Id LIKE '%$query%' OR Status LIKE '%$query%'";
    $sqlReviews = "SELECT 'Review' AS TableName, Id, Customer_id, Rating AS Details, Comment FROM review WHERE Comment LIKE '%$query%' OR Rating LIKE '%$query%'";

    // Execute each query and merge the results
    $resultUsers = $conn->query($sqlUsers);
    $resultProducts = $conn->query($sqlProducts);
    $resultOrders = $conn->query($sqlOrders);
    $resultReviews = $conn->query($sqlReviews);

    if ($resultUsers->num_rows > 0) {
        $results = array_merge($results, $resultUsers->fetch_all(MYSQLI_ASSOC));
    }

    if ($resultProducts->num_rows > 0) {
        $results = array_merge($results, $resultProducts->fetch_all(MYSQLI_ASSOC));
    }

    if ($resultOrders->num_rows > 0) {
        $results = array_merge($results, $resultOrders->fetch_all(MYSQLI_ASSOC));
    }

    if ($resultReviews->num_rows > 0) {
        $results = array_merge($results, $resultReviews->fetch_all(MYSQLI_ASSOC));
    }

    return $results;
}

$searchResults = searchDatabase($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>Search Results for "<?php echo htmlspecialchars($query); ?>"</h1>
    <?php if (!empty($searchResults)) : ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Table</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($searchResults as $result) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($result['TableName']); ?></td>
                            <td><?php echo htmlspecialchars($result['Id']); ?></td>
                            <td><?php echo htmlspecialchars($result['Name']); ?></td>
                            <td><?php echo htmlspecialchars($result['Details']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <p>No results found for "<?php echo htmlspecialchars($query); ?>"</p>
    <?php endif; ?>
</div>
</body>
</html>

<?php
$conn->close();
?>
