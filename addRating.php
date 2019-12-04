<!DOCTYPE html>
<!-- Add Ratings Info to Table Part -->
<?php
		$currentpage="Add Ratings";
?>
<html>
	<head>
		<title>Add Ratings</title>
		<link rel="stylesheet" href="index.css">
		<script type = "text/javascript"  src = "verifyInput.js" > </script> 
	</head>
<body>


<?php
	include "header.php";
	$msg = "Add a new Rating include ShopID, DrinkID, Numstars & comments";
	include 'connectvars.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could NOT connect!!! ' . mysql_error());
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$RatingID = mysqli_real_escape_string($conn, $_POST['RatingID']);
		$DrinkID = mysqli_real_escape_string($conn, $_POST['DrinkID']);
		$ShopID = mysqli_real_escape_string($conn, $_POST['ShopID']);
		$CustomerID = mysqli_real_escape_string($conn, $_POST['CustomerID']);
		$Comment = mysqli_real_escape_string($conn, $_POST['Comment']);
		$NumStars = mysqli_real_escape_string($conn, $_POST['NumStars']);
		
		$queryIn = "SELECT * FROM `Rating` where RatingID='$RatingID' ";
		$resultIn = mysqli_query($conn, $queryIn);
		if (mysqli_num_rows($resultIn)> 0) {
			$msg ="<h2>Can't Add Ratings to Table</h2> There is already a same Rating ID $RatingID<p>";
		} 
		else {
			
			$query = "INSERT INTO `Rating` (RatingID, DrinkID, ShopID, CustomerID, Comment, NumStars) VALUES ('$RatingID', '$DrinkID', '$ShopID', '$CustomerID', '$Comment', '$NumStars')";		
			if(mysqli_query($conn, $query)){
				$msg =  "Rating added successfully.<p>";
			} 
			else{
				echo "ERROR: Couldn't add the query to Rating Table. " . mysqli_error($conn);
			}
		}
}
// close connection
mysqli_close($conn);
?>
    <h2> <?php echo $msg; ?> </h2>

	<form method="post" id="addForm">
	<fieldset>
		<legend>Rating Info:</legend>
		<p>
			<label for="RatingID">Rating ID:</label>
			<input type="number" min=0 max=9999 class="required" name="RatingID" id="RatingID">
		</p>
		<p>
			<label for="DrinkID">DrinkID:</label>
			<input type="number" min=0 max=9999 class="required" name="DrinkID" id="DrinkID">
		</p>
		<p>
			<label for="ShopID">shopID:</label>
			<input type="number" min=0 max=9999 class="required" name="ShopID" id="ShopID">
		</p>
		<p>
			<label for="CustomerID">CustomerID:</label>
			<input type="number" min=0 max=9999 class="required" name="CustomerID" id="CustomerID">
		</p>
		<p>
			<label for="Comment">Comment:</label>
			<input type="text" class="required" name="Comment" id="Comment">
		</p>
		<p>
			<label for="NumStars">NumStars:</label>
			<input type="number" min=0 max=9999 class="required" name="NumStars" id="NumStars">
		</p>
	</fieldset>

    <p>
		<input type = "submit"  value = "Submit" />
        <input type = "reset"  value = "Clear Form" />
    </p>
	</form>
</body>
</html>
