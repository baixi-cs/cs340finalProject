<!DOCTYPE html>
<?php
		$currentpage="Ratings by Customer";
    $customer = $_GET['cust'];
?>
<html>
	<head>
		<title>List Parts</title>
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
		$query = "SELECT Shop.ShopID, Drink.Flavor, Rating.Comment, Rating.NumStars, Customers.Name
			FROM `Rating`, `Customers`, `Drink`, `Shop`
			WHERE Rating.CustomerID = Customers.CustomerID
			AND Rating.DrinkID = Drink.DrinkID
			AND Rating.ShopID = Shop.ShopID
			AND Rating.CustomerID = $customer";

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
				echo "<th>Shop</th>";
				echo "<th>Drink</th>";
				echo "<th>Comment</th>";
				echo "<th>Rating(1-5)</th>";
				echo "</tr>";
	        echo "</thead>";
	        echo "<tbody>";

			// Extract rows from the results returned from the database
			mysqli_data_seek($result, 0);
	        while($row = mysqli_fetch_array($result)){
						echo "<tr>";
						echo "<td>" . $row['ShopID'] . "</td>";
						echo "<td>" . $row['Flavor'] . "</td>";
						echo "<td>" . $row['Comment'] . "</td>";
						echo "<td>" . $row['NumStars'] . "</td>";
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
