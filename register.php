<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$fname = $lname = $phone = $email = $password = $confirm_password = $gender = "";
$fname_err = $lname_err = $phone_err = $email_err = $password_err = $confirm_password_err = $gender_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate email
    if (empty(trim($_POST["Email"]))) {
        $email_err = "Please enter an email.";
    } elseif (!filter_var(trim($_POST["Email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Please enter a valid email.";
    } else {
        // Prepare a select statement
        $sql = "SELECT Id FROM User WHERE Email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_email);
            $param_email = trim($_POST["Email"]);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    $email_err = "This email is already registered.";
                } else {
                    $email = trim($_POST["Email"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }

    // Validate first name
    if (empty(trim($_POST["First_Name"]))) {
        $fname_err = "Please enter your first name.";
    } else {
        $fname = trim($_POST["First_Name"]);
    }

    // Validate last name
    if (empty(trim($_POST["Last_Name"]))) {
        $lname_err = "Please enter your last name.";
    } else {
        $lname = trim($_POST["Last_Name"]);
    }

    // Validate phone number
    if (empty(trim($_POST["Phone_no"]))) {
        $phone_err = "Please enter your phone number.";
    } else {
        $phone = trim($_POST["Phone_no"]);
    }

    // Validate password
    if (empty(trim($_POST["Password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["Password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["Password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["ConfirmPassword"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["ConfirmPassword"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Validate gender
    if (empty(trim($_POST["gender"]))) {
        $gender_err = "Please select your gender.";
    } else {
        $gender = trim($_POST["gender"]);
    }

    // Check input errors before inserting in database
    if (empty($fname_err) && empty($lname_err) && empty($phone_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($gender_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO User (FName, LName, Phone_no, Password, Email, Type, gender) VALUES (?, ?, ?, ?, ?, 'Customer', ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssss", $param_fname, $param_lname, $param_phone, $param_password, $param_email, $param_gender);

            // Set parameters
            $param_fname = $fname;
            $param_lname = $lname;
            $param_phone = $phone;
            $param_password = $password; // Storing password in plain text as per your request
            $param_email = $email;
            $param_gender = $gender;

            if ($stmt->execute()) {
                echo "<script>alert('Registration successful'); window.location.href = 'login.html';</script>";
            } else {
                echo "Something went wrong. Please try again later.";
            }

            $stmt->close();
        }
    } else {
        echo "There were errors in your form submission.";
    }

    $conn->close();
}
?>
