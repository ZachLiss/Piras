<!DOCTYPE html>
<html>
<head>
<div id="identity"><h3>Zach Liss | zll1@pitt.edu</h3></div>
</head>
<body>
<?php

// create connection
$con = mysqli_connect();

// check connection
if(mysqli_connect_errno($con)) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
	// reset the stuff
	$var1 = mysqli_query($con, "TRUNCATE TABLE zll1db.Subcodes");
	$var2 = mysqli_query($con, "TRUNCATE TABLE zll1db.Transactions");
	// close connection
	$close = mysqli_close($con);

	echo "Database Reset<br>";
}

?>

<!-- return to piras.php -->
<form action="piras.php" method="get">
	<input type="submit" value="Return">
</form>

</body>
</html>