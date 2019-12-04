
<!DOCTYPE html>
<?php
		$currentpage="Show Shops";
    $customer = $_GET['Shops'];
?>
<html>
	<head>
		<title>Show shops/title>
		<link rel="stylesheet" href="index.css">
	</head>
<body>

	<?php
	// change the value of $dbuser and $dbpass to your username and password
		include 'connectvars.php';
		include 'header.php';

	// Connect to the database
		$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if (!$conn) {
			die('Could not connect: ' . mysql_error());
		}

	// query to select all information from parts table
		$query = "SELECT Shop.Address, Manager.Name,Manager.Email, Drink.Flavor
			FROM `Manager`, `Drink`, `Shop`
			WHERE Shop.managerID = Manager.managerID
			AND Drink.shopID = Shop.ShopID";

	// Get results from query
		$result = mysqli_query($conn, $query);
		if (!$result) {
			die("Query to show fields from table failed");
		}
		// If there are parts in the database construct an HTML table
		// to display the results
		$row = mysqli_fetch_array($result);
		if(mysqli_num_rows($result) > 0){
	        echo "<h1>" . $row['Name']. "</h1>";
			echo "<table id='t01' border='1'>";
			// Create the table header
	        echo "<thead>";
				echo "<tr>";
				echo "<th>Address</th>";
				echo "<th>Name</th>";
				echo "<th>Drink</th>";
				echo "</tr>";
	        echo "</thead>";
	        echo "<tbody>";

			// Extract rows from the results returned from the database
			mysqli_data_seek($result, 0);
	        while($row = mysqli_fetch_array($result)){
						echo "<tr>";
						echo "<td>" . $row['Address'] . "</td>";
						echo "<td>" . $row['Name'] . "</td>";
						echo "<td>" . $row['Drink'] . "</td>";
						//echo "<td>" . $row['NumStars'] . "</td>";
						echo "</tr>";
	        }
	        echo "</tbody>";
	        echo "</table>";
			// Free result set
	        mysqli_free_result($result);
	    } else{
			echo "<p class='lead'><em>No records were found.</em></p>";
	    }
		// Close the database connection
		mysqli_close($conn);
	?>
	</body>

	</html>
