<?php
session_start();

include 'config.php';

// Check if email and password are set
if (isset($_POST['email']) && isset($_POST['password'])) {
    // get the email and password from the login form
    $email = $_POST['email'];
    $pw = $_POST['password'];
  
    // sanitize the input to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $email);
  
    // query the user table to find the matching user and type
    $sql = "SELECT Id, Type, Password FROM User WHERE Email = '$email'";
    $result = mysqli_query($conn, $sql);
  
    // check if the query returned any row
    if (mysqli_num_rows($result) > 0) {
        // fetch the row as an associative array
        $row = mysqli_fetch_assoc($result);
  
        // get the user type and password from the row
        $type = $row['Type'];
        $storedPassword = $row['Password'];
  
        // compare the plain text passwords
        if ($pw === $storedPassword) {
            // password is correct, start a session and store the user type
            session_start();
            $_SESSION['user_type'] = $type;
            $_SESSION['user_id'] = $row['Id']; // store the user id here
  
            // redirect to the appropriate page based on the user type
            switch ($type) {
                case 'Customer':
                    header("Location: Customer.php");
                    break;
                case 'Admin':
                    header("Location: admin.php");
                    break;
                case 'InStore_staff':
                    header("Location: instore_staff.php");
                    break;
                case 'Delivery_staff':
                    header("Location: delivery_staff.php");
                    break;
                default:
                    echo "Invalid user type";
            }
        } else {
            // password is incorrect, display an error message
            echo "Wrong password";
        }
    } else {
        // no matching user found, display an error message
        echo "User not found";
    }
} else {
    // email or password not set, redirect back to the login form or display an error message
    echo "Please enter both email and password.";
}

// close the database connection
mysqli_close($conn);

?>
