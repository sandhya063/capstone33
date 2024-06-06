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


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_user'])) {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $sql = "INSERT INTO User (FName, LName, Email, Type) VALUES ('$firstName', '$lastName', '$email', '$role')";

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_users.php");
        exit();
    } else {
        echo "Error adding user: " . $conn->error;
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
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
    <h1>Manage Users</h1>

    <section>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
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
                    echo "<td><a href='edit_user.php?id={$user['Id']}' class='btn btn-primary'>Edit</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Form for adding new user -->
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mt-3">
        <h3>Add New User</h3>

        <div class="mb-3">
            <label for="first_name" class="form-label">First Name:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role:</label>
            <input type="text" class="form-control" id="role" name="role" required>
        </div>

        <button type="submit" class="btn btn-success" name="add_user">Add User</button>
    </form>
</section>









    </div>
   

</div>

    <?php
    $conn->close();
    ?>


</body>
</html>
