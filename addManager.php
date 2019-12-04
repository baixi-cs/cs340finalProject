<!DOCTYPE html>
<!-- Add Shop Info to Table Part -->
<?php
		$currentpage="Add Manager";
?>
<html>
	<head>
		<title>Add Manager</title>
		<link rel="stylesheet" href="index.css">
		<script type = "text/javascript"  src = "verifyInput.js" > </script> 
	</head>
<body>


<?php
	include "header.php";
	$msg = "Add new Manager record to the Shop Table";

// change the value of $dbuser and $dbpass to your username and password
	include 'connectvars.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Escape user inputs for security
		$managerID = mysqli_real_escape_string($conn, $_POST['managerID']);
		$Name = mysqli_real_escape_string($conn, $_POST['Name']);
		$Email = mysqli_real_escape_string($conn, $_POST['Email']);
		
		


	// The POST values were entered from the form
	
	
	// See if pid is already in the table
		$queryIn = "SELECT * FROM Manager where managerID='$managerID' ";
		$resultIn = mysqli_query($conn, $queryIn);
		if (mysqli_num_rows($resultIn)> 0) {
			$msg ="<h2>Can't Add managerID to Table</h2> There is already a managerID with managerID $managerID<p>";
		} else {
		
		// Query to insert the shop into the table 
		//  ADD the query to insert a new shop into the Shops table
		
			$query = "INSERT INTO Manager (managerID, Name, Email) VALUES ('$managerID', '$Name', '$Email')";		
			if(mysqli_query($conn, $query)){
				$msg =  "Manager added successfully.<p>";
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
			<label for="managerID">Manager ID:</label>
			<input type="number" min=1 max = 99999 class="required" name="managerID" id="managerID" title="managerID should be numeric">
		</p>
		<p>
			<label for="Name">Name:</label>
			<input type="text" class="required" name="Name" id="Name">
		</p>
			<p>
			<label for="Email">Email:</label>
			<input type="text" class="required" name="Email" id="Email">
		</p>
		
	</fieldset>

    <p>
		<input type = "submit"  value = "Submit" />
        <input type = "reset"  value = "Clear Form" />
    </p>
	</form>
</body>
</html>
