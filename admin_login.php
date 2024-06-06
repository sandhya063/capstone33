<?php

// Include the config.php file
include 'config.php';

// Initialize variables
$email = '';
$pw = '';
$type = '';
$storedPassword = '';

// Check if email and password are set
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pw = $_POST['password'];

    $sql = "SELECT Id, Type, TRIM(Password) AS Password FROM User WHERE Email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $type = $row['Type'];
        $storedPassword = $row['Password'];

        if ($type == 'Admin') {
            // Only check the password if the user type is Admin
            echo "Entered Password: $pw <br>";
            echo "Stored Password: $storedPassword <br>";
        
            if (password_verify($pw, $storedPassword) || $pw === $storedPassword) {
                session_start();
                $_SESSION['user_type'] = $type;
                $_SESSION['user_id'] = $row['Id'];
        
                header("Location: admin.php"); // Redirect to admin.php if login successful
                exit();
            } else {
                echo "<script>alert('Invalid login credentials')</script>";
                echo "<pre>";
                print_r($row);
                echo "</pre>";
                echo "User type: $type <br>";
                echo "Stored Password: $storedPassword <br>";
                echo "Password verification failed!";
                // echo "<script>window.location.href='admin_login.html';</script>";
            }
        } else {
            echo "<script>alert('Invalid user type')</script>";
            echo "<script>window.location.href='admin_login.html';</script>";
        }
        
    } else {
        echo "Error in database query: " . mysqli_error($conn);
    }
} else {
    echo "Please enter both email and password.";
}

mysqli_close($conn);

?>
