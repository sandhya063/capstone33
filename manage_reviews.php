<?php
include 'config.php';

function fetchReviews($conn) {
    $sql = "SELECT * FROM Review";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reviews</title>
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

    <div class="content">
    <h1>View Reviews</h1>


    <section>

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
   

    <?php
    $conn->close();
    ?>

   
</body>
</html>
