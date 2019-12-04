<!DOCTYPE html>
<?php
		$currentpage="List Shops";

?>
<html>
	<head>
		<title>List Shops</title>
		<link rel="stylesheet" href="index.css">
	</head>
<body>


<?php
// change the value of $dbuser and $dbpass to your username and password
	include 'header.php';	

	include 'connectvars.php'; 
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}	

// query to select all information from supplier table
	$query = "SELECT * FROM `Shop` ";
	
// Get results from query
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}

	if(mysqli_num_rows($result) > 0){
        echo "<h1>Shops</h1>";  
		echo"<h3>Click a shop to see their information</h3>";
		echo "<table id='t01' border='1'>";
        echo "<thead>";
			echo "<tr>";
			echo "<th>ShopID</th>";
			echo "<th>Address</th>";
			echo "<th>Phone</th>";
			echo "<th>Hours</th>";
			echo "<th>managerID</th>";
			echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
		
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>" . $row['ShopID'] . "</td>";
			echo "<td>" . $row['Address'] . "</td>";
            echo "<td>" . $row['Phone'] . "</td>";
            echo "<td>" . $row['Hours'] . "</td>";
			echo "<td>" . $row['managerID'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";                            
        echo "</table>";
		// Free result set
        mysqli_free_result($result);
    } else{
		echo "<p class='lead'><em>No records were found.</em></p>";
    } 
	mysqli_close($conn);
?>
</body>

</html>

	
