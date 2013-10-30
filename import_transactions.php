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
	$url = $_GET["url"];
	echo "url: $url<br>";

	$content = file_get_contents("$url");
	$data_lines = explode("\n", $content);
	array_pop($data_lines);

	foreach($data_lines as $val) {
		$line = explode(',', $val);

		$sql = mysqli_query($con, "INSERT INTO Transactions (txdate, account, subcode, amount, description) VALUES ('$line[1]', '$line[2]', '$line[3]', '$line[4]', '$line[5]')");
	}
	
	// close connection
	$close = mysqli_close($con);
}


?>

<!-- return to piras.php -->
<form action="piras.php" method="get">
	<input type="submit" value="Return">
</form>

</body>
</html>