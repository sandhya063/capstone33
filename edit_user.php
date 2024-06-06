<?php
include 'config.php';

$userId = 0;
$user = ['FName' => '', 'LName' => '', 'Phone_no' => '', 'Email' => '', 'gender' => ''];

// Fetch user details by ID
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $userId = $_GET['id'];

    $sql = "SELECT * FROM User WHERE Id = $userId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit();
    }
}

// Handle form submission for updating and deleting user details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['userId'];
    
    if (isset($_POST['update'])) {
        // Update user details
        $newFirstName = $_POST['fname'];
        $newLastName = $_POST['lname'];
        $newPhoneNo = $_POST['phone_no'];
        $newEmail = $_POST['email'];
        $newGender = $_POST['gender']; // Add this line to retrieve gender
        
        $sql = "UPDATE User SET FName = '$newFirstName', LName = '$newLastName', Phone_no = '$newPhoneNo', Email = '$newEmail', gender = '$newGender' WHERE Id = $userId";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('User updated successfully'); window.location.href = 'manage_users.php';</script>";
        } else {
            echo "Error updating user: " . $conn->error;
        }
    } elseif (isset($_POST['delete'])) {
        // Delete user
        safelyDeleteUser($conn, $userId);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
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
    <h1>Edit User</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="userId" value="<?php echo $userId; ?>">
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="fname" value="<?php echo $user['FName']; ?>"><br>
        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="lname" value="<?php echo $user['LName']; ?>"><br>
        <label for="phone_no">Phone Number:</label>
        <input type="text" id="phone_no" name="phone_no" value="<?php echo $user['Phone_no']; ?>"><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $user['Email']; ?>"><br>
        <label for="gender">Gender:</label> <!-- Add gender field -->
        <select name="gender">
            <option value="Male" <?php if ($user['gender'] === 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if ($user['gender'] === 'Female') echo 'selected'; ?>>Female</option>
        </select><br>
        <input type="submit" name="update" value="Update">
        <input type="submit" name="delete" value="Delete" class="delete-button">
    </form>
</body>
</html>

<?php
// Close the connection
$conn->close();

// Function to safely delete a user, handling related data
// Function to safely delete a user, handling related data
function safelyDeleteUser($conn, $userId) {
    // Begin transaction
    $conn->begin_transaction();

    try {
        // Example of deleting or handling related records
        // You might need to adjust or add queries to handle your specific database schema
        $conn->query("DELETE FROM Address WHERE User_id = $userId");
        $conn->query("DELETE FROM Review WHERE Customer_id = $userId");
        
        // Finally, delete the user
        $conn->query("DELETE FROM User WHERE Id = $userId");

        // Commit transaction
        $conn->commit();
        echo "<script>alert('User deleted successfully'); window.location.href = 'manage_users.php';</script>";
    } catch (mysqli_sql_exception $exception) {
        $conn->rollback();
        echo "Error deleting user: " . $exception->getMessage();
    }
}

