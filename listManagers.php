﻿<!DOCTYPE html>
<?php
		$currentpage="List Managers";
?>
<html>
	<head>
		<title>List Managers</title>
		<link rel="stylesheet" href="index.css">
	</head>
<body>


<?php
// change the value of $dbuser and $dbpass to your username and password
	include 'connectvars.php'; 
	include 'header.php';	


	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}	

// query to select all information from supplier table
	
	$query = "SELECT Manager.managerID,Manager.Name, Manager.Email,Shop.ShopID
	          FROM `Manager`,'Shop' 
		  WHERE Shop.ShopID = Manager.ShopID ";

// Get results from query
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}

	
	
	if(mysqli_num_rows($result) > 0){
        echo "<h1>Managers</h1>";  
		echo "<table id='t01' border='1'>";
        
		echo "<thead>";
			echo "<tr>";
			echo "<th>managerID</th>";
			echo "<th>Name</th>";
			echo "<th>Email</th>";
			echo "<th>ShopID</th>";
			echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
		
        
		while($row = mysqli_fetch_array($result)){
        
		
		    echo "<tr>";
            echo "<td>" . $row['managerID'] . "</td>";
			echo "<td>" . $row['Name'] . "</td>";
            echo "<td>" . $row['Email'] . "</td>";
			echo "<td>" . $row['ShopID'] . "</td>";
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

	
