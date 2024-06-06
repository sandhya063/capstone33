<!DOCTYPE html>
<html>
<head>
	<title>Employee Dashboard</title>
	<link href="css/style1.css" rel="stylesheet">
</head>
<body onload="myFunction()" style="margin:0;">
<div id="loader"></div>
<div style="display:none;" id="myDiv" class="animate-bottom">
<div>
	<h1>Dashboard</h1>

</div>

<button class="b1" onclick="history.back()">Go Back</button>


<div class>
    
	<button class="b1"><a href="Order_details.php"> View Order </a>  </button><br>
    <button class="b1"><a href="Customer_view.php"> View Customer </a> </button><br>
    <button class="b1"><a href="roster.php"> View Roster </a> </button><br>
	<button class="b1_logout"> <a href="logout.php">Log Out</button>
    
</div>
</div>

<script>
var myVar;

function myFunction() {
  myVar = setTimeout(showPage, 3000);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
</script>




<div class="footer">
	 &copy; <?php echo date('Y'); ?>
	</div>
</div>
</body>
</html>
