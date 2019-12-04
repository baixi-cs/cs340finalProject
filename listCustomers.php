
﻿<!DOCTYPE html>
<?php
		$currentpage="List Customers";
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
$query = "SELECT * FROM `Customers` ";

// Get results from query
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
	// If there are parts in the database construct an HTML table
	// to display the results

	if(mysqli_num_rows($result) > 0){
        echo "<h1>Customers</h1>";
				echo "<h3>Click a customer to see all their ratings</h3>";
		echo "<table id='t01' border='1'>";
		// Create the table header
        echo "<thead>";
			echo "<tr>";
			echo "<th>ID</th>";
			echo "<th>Name</th>";
			echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

		// Extract rows from the results returned from the database
        while($row = mysqli_fetch_array($result)){
					echo "<tr>";
					echo "<td>" . $row['CustomerID'] . "</td>";
					echo "<td><a href = 'listRatingsByCustomer?user=".$user."&cust=".$row['CustomerID']
					."' >".$row['Name'] . "</td>";
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

