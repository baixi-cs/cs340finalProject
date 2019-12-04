<!DOCTYPE html>
<!-- Add Shop Info to Table Part -->
<?php
		$currentpage="Add Shop";
?>
<html>
	<head>
		<title>Add Shop</title>
		<link rel="stylesheet" href="index.css">
		<script type = "text/javascript"  src = "verifyInput.js" > </script> 
	</head>
<body>


<?php
	include "header.php";
	$msg = "Add new Shop record to the Shop Table";

// change the value of $dbuser and $dbpass to your username and password
	include 'connectvars.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Escape user inputs for security
		$shopID = mysqli_real_escape_string($conn, $_POST['shopID']);
		$Address = mysqli_real_escape_string($conn, $_POST['Address']);
		$Phone = mysqli_real_escape_string($conn, $_POST['Phone']);
		$Hours = mysqli_real_escape_string($conn, $_POST['Hours']);
		$managerID = mysqli_real_escape_string($conn, $_POST['managerID']);


	// The POST values were entered from the form
	
	
	// See if pid is already in the table
		$queryIn = "SELECT * FROM Shop where shopID='$shopID' ";
		$resultIn = mysqli_query($conn, $queryIn);
		if (mysqli_num_rows($resultIn)> 0) {
			$msg ="<h2>Can't Add shop to Table</h2> There is already a Shop with shopID $shopID<p>";
		} else {
		
		// Query to insert the shop into the table 
		//  ADD the query to insert a new shop into the Shops table
		
			$query = "INSERT INTO Shop (shopID, Address, Phone, Hours, managerID) VALUES ('$shopID', '$Address', '$Phone', '$Hours', '$managerID')";		
			if(mysqli_query($conn, $query)){
				$msg =  "Shop added successfully.<p>";
			} else{
				echo "ERROR: Could not insert the shop $query. " . mysqli_error($conn);
			}
		}
}

// close connection
mysqli_close($conn);

?>
    <h2> <?php echo $msg; ?> </h2>

	<form method="post" id="addForm">
	<fieldset>
		<legend>Shop Info:</legend>
		<p>
			<label for="shopID">Shop ID:</label>
			<input type="number" min=1 max = 99999 class="required" name="shopID" id="shopID" title="shopID should be numeric">
		</p>
		<p>
			<label for="Address">Address:</label>
			<input type="text" class="required" name="Address" id="Address">
		</p>
		<p>
			<label for="Phone">Phone:</label>
			<input type="number" min=1 max = 99999 class="required" name="Phone" id="Phone" title="Phone should be numeric">
		</p>
		<p>
			<label for="Hours">Hours:</label>
			<input type="number" min=1 max = 30 class="required" name="Hours" id="Hours" title="Hours should be numeric">
		</p>
		<p>
			<label for="managerID">Manager ID:</label>
			<input type="number" min=1 max = 99999 class="required" name="managerID" id="managerID" title="managerID should be numeric">
		</p>
	</fieldset>

    <p>
		<input type = "submit"  value = "Submit" />
        <input type = "reset"  value = "Clear Form" />
    </p>
	</form>
</body>
</html>
