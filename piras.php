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
	$subc = mysqli_query($con, "SELECT COUNT(*) FROM Subcodes");
	$tran = mysqli_query($con, "SELECT COUNT(*) FROM Transactions");

	$subc = mysqli_fetch_array($subc);
	$tran = mysqli_fetch_array($tran);

	echo "<h5>Subcodes: $subc[0] | Transactions: $tran[0]</h5>";
	// close connection
	$close = mysqli_close($con);
}

?>

<form action="resetdb.php" method="get">
	<input type="submit" value="Reset Database">
</form>
<hr/>

<form action="import_subcodes.php" method="get">
	url: <input type="text" name="url">
	<input type="submit" value="Import Subcodes">
</form>
<p>http://db.cs.pitt.edu/courses/cs1520/spring2013/assign/piras.subcodes.csv</p>
<hr/>

<form action="import_transactions.php" method="get">
	url: <input type="text" name="url">
	<input type="submit" value="Import Transactions">
</form>
<p>http://db.cs.pitt.edu/courses/cs1520/spring2013/assign/piras.transactions.csv</p>
<hr/>

<form action="maintenance.php" method="get">
	<input type="submit" value="Maintenance">
</form>

<form action="filter.php" method="get">
	<input type="submit" value="Querying">
</form>
<hr/>

</body>
</html>