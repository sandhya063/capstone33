
<!DOCTYPE html>
<html>
<head>
	<title>Oder Details</title>
	<link href="css/style1.css" rel="stylesheet">
</head>
<body>

<div class="top">
	<h1 style="color:green;">Oder Details</h1>

</div>

<button  class="b1" onclick="history.back()">Go Back</button>
    
<div class="top_body_button">
<button class="b1"><a href="index.php"> Home </a>  </button><br>

</div>
<div>

<?php
// Database connection parameters
include 'config.php';

// Fetch data from table1
$sql = "SELECT customer.Id AS Id,
         user.FName, user.LName, user.Phone_no, user.Email,
         address.Unit_no,address.Address_line_1,address.City,address.Region,address.Postcode
         
        FROM customer
        INNER JOIN user ON customer.id = user.id
        INNER JOIN address ON customer.id = address.id";

$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    if ($result->num_rows > 0) {
        // Display data in a single table
        echo "<table border='1' class='top_table'>";
        echo "<tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Dilvery Address</th>
        
        </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['Id'] . "</td>
            <td>" . $row['FName'] . "</td>
            <td>" . $row['LName'] . "</td>
            <td>" . $row['Phone_no'] . "</td>
            <td>" . $row['Email'] . "</td>
            <td>" . $row['Unit_no'] . ' ' . $row['Address_line_1'] . ' ' . $row['City'] . ' ' . $row['Region'] . ' ' . $row['Postcode'] ."</td>
                      
            </tr>";
        }

        echo "</table>";
    } else {
        echo "No records found";
    }

  }
// Close the connection
$conn->close();
?>



</div>


<div class="footer">
	 &copy; <?php echo date('Y'); ?>
	</div>

</body>
</html>




