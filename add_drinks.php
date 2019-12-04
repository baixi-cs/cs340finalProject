<!DOCTYPE html>
<!-- Add Supplier Info to Table Supplier -->
<?php
		$currentpage="Add Drink";		
?>
<html>
	<head>
		<title>Add Drink</title>
		<link rel="stylesheet" href="index.css">
		<script type = "text/javascript"  src = "verifyInput.js" > </script> 
	</head>
<body>

<?php
	include "header.php";
	$msg = "Add new drink record to the Drink Table";

// change the value of $dbuser and $dbpass to your username and password
	include 'connectvars.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Escape user inputs for security
		$DrinkID = mysqli_real_escape_string($conn, $_POST['DrinkID']);
		$Flavor = mysqli_real_escape_string($conn, $_POST['Flavor']);
		$Temperature = mysqli_real_escape_string($conn, $_POST['Temperature']);
		$Price = mysqli_real_escape_string($conn, $_POST['Price']);
		$ShopID = mysqli_real_escape_string($conn, $_POST['ShopID']);

	
// See if sid is already in the table
		$queryIn = "SELECT * FROM `a.Drink` where DrinkID='$DrinkID' ";
		$resultIn = mysqli_query($conn, $queryIn);
		if (mysqli_num_rows($resultIn)> 0) {
			$msg ="<h2>Can't Add to Table</h2> There is already a supplier with DrinkID $DrinkID<p>";
		} else {
		
		// attempt insert query 
			$query = "INSERT INTO `a.Drink` (DrinkID, Flavor, Temperature, Price, ShopID) VALUES ('$DrinkID', '$Flavor', '$Temperature', '$Price', '$ShopID')";
			if(mysqli_query($conn, $query)){
				$msg =  "Record added successfully.<p>";
			} else{
				echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
			}
		}
}
// close connection
mysqli_close($conn);

?>

	<h2> <?php echo $msg; ?> </h2>
	
	<form method="post" id="addForm">
	<fieldset>
		<legend>Drink Info:</legend>
		<p>
			<label for="DrinkID">Drink ID:</label>
			<input type="number" min=1 max = 99999 class="required" name="DrinkID" id="DrinkID" title="DrinkID should be numeric">
		</p>
		<p>
			<label for="Flavor">Drink Flavor:</label>
			<input type="text" class="required" name="Flavor" id="Flavor">
		</p>
		<p>
			<label for="Temperature">Drink Temperature:</label>
			<input type="text" class="required" name="Temperature" id="Temperature">
      	<p>
		<p>
			<label for="Price">Drink Price:</label>
			<input type="number" min=1 max = 99999 class="required" name="Price" id="Price" title="Price should have a decimal">
		</p>
		<p>
			<label for="Price">Shop ID:</label>
			<input type="number" min=1 max = 99999 class="required" name="ShopID" id="ShopID" title="ShopID should have a decimal">
		</p>
	</fieldset>


        <input type = "submit"  value = "Submit" />
        <input type = "reset"  value = "Clear Form" />
      </p>
	</form>
	</body>
</html>
