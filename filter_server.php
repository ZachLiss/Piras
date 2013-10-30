<?php

// get function from URL
$fun = $_GET["fun"];

if($fun == "buildAccounts") {
	// code to build the accounts area
	buildAccounts();
} else if($fun == "buildSubcodes") {
	// code to build the subcodes area
	buildSubcodes();
} else if($fun == "buildTable") {
	// code to build the table
	buildTable();
} else if($fun == "sendFilter") {
	// code to build the filtered table
	filterTable();
}

function buildAccounts() {
	// create connection
	$con = mysqli_connect();

	// check connection
	if(mysqli_connect_errno($con)) {
		$content += "Failed to connect to MySQL: " . mysqli_connect_error();
	} else {
		// begin the creation of the checkboxes
		$result = "";
		$numAccounts = 0;
		$content = mysqli_query($con,"SELECT DISTINCT account FROM Transactions");
	
		while($row = mysqli_fetch_array($content)) {
			$numAccounts++;
			$result = $result . "<input type=\"checkbox\" checked=\"true\" id=\"account$numAccounts\" value=\"$row[account]\">$row[account]";
  		}	

		// close connection
		$close = mysqli_close($con);

		// finish the table and return the result
		//$result = $result . "</table>";
		$result = $result . "::$numAccounts";
		echo $result;
	}
}

function buildSubcodes() {
	// create connection
	$con = mysqli_connect();

	// check connection
	if(mysqli_connect_errno($con)) {
		$content += "Failed to connect to MySQL: " . mysqli_connect_error();
	} else {
		// begin the creation of the checkboxes
		$result = "";
		$numSubcodes = 0;
		$content = mysqli_query($con,"SELECT DISTINCT subcode FROM Subcodes");
	
		while($row = mysqli_fetch_array($content)) {
			$numSubcodes++;
			$result = $result . "<input type=\"checkbox\" checked=\"true\" id=\"subcode$numSubcodes\" value=\"$row[subcode]\">$row[subcode]";	
  		}	

		// close connection
		$close = mysqli_close($con);

		// finish the table and return the result
		//$result = $result . "</table>";
		$result = $result . "::$numSubcodes";
		echo $result;
	}
}

function buildTable() {
	// create connection
	$con = mysqli_connect();

	// check connection
	if(mysqli_connect_errno($con)) {
		$content += "Failed to connect to MySQL: " . mysqli_connect_error();
	} else {
		// begin the creation of the table
		$result = "<table border='1'>
			  	 <tr>
		 	  		<th>txid</th>
			  	 	<th>txdate</th>
			   		<th>account</th>
			   		<th>subcode</th>
			   		<th>amount</th>
			  	 	<th>description</th>
			  	 </tr>";

		$content = mysqli_query($con,"SELECT * FROM Transactions ORDER BY txdate DESC");
	
		while($row = mysqli_fetch_array($content)) {
		
			$result = $result . "<tr>
					 			   <td>$row[txid]</td>
					 		 	   <td><div id=\"$row[txid]txdate\">$row[txdate]</div></td>
							 	   <td><div id=\"$row[txid]account\">$row[account]</div></td>
					 		 	   <td><div id=\"$row[txid]subcode\">$row[subcode]</div></td>
					 		  	   <td><div id=\"$row[txid]amount\">$row[amount]</div></td>
					 		 	   <td><div id=\"$row[txid]description\">$row[description]</div></td>
							 	</tr>";
  		}	

		// close connection
		$close = mysqli_close($con);

		// finish the table and return the result
		$result = $result . "</table>";
		echo $result;
	}
}

function filterTable() {
	$keyword = $_GET["keyword"];
	$min = $_GET["min"];
	$max = $_GET["max"];
	$datemin = $_GET["datemin"];
	$datemax = $_GET["datemax"];
	$sql = "";

	$needWHERE = 0;
	if($keyword == "" && $min == "" && $max == "") {
		$needWHERE = 1;
		$sql = "SELECT * FROM Transactions";
	} else if($keyword == "" && $min != "" && $max == "") {
		$sql = "SELECT * FROM Transactions WHERE amount>'$min'";
	} else if($keyword == "" && $min == "" && $max != "") {
		$sql = "SELECT * FROM Transactions WHERE amount<'$max'";
	} else if($keyword == "" && $min != "" && $max != "") {
		$sql = "SELECT * FROM Transactions WHERE amount<'$max' AND amount>'$min'";
	} else if($keyword != "" && $min == "" && $max == "") {
		$sql = "SELECT * FROM Transactions WHERE description LIKE '%$keyword%'";
	} else if($keyword != "" && $min != "" && $max == "") {
		$sql = "SELECT * FROM Transactions WHERE description LIKE '%$keyword%' AND amount>'$min'";
	} else if($keyword != "" && $min == "" && $max != "") {
		$sql = "SELECT * FROM Transactions WHERE description LIKE '%$keyword%' AND amount<'$max'";
	} else if($keyword != "" && $min != "" && $max != "") {
		$sql = "SELECT * FROM Transactions WHERE description LIKE '%$keyword%' AND amount<'$max' AND amount>'$min'";
	}

	if($needWHERE == 1) {
		if($datemin != "" && $datemax == "") {
			$sql = $sql . " WHERE txdate>='$datemin'";
		} else if($datemin == "" && $datemax != "") {
			$sql = $sql . " WHERE txdate<='$datemax'";
		} else if($datemin != "" && $datemax != "") {
			$sql = $sql . " WHERE txdate>='$datemin' AND txdate<='$datemax'";
		}
	} else {
		if($datemin != "" && $datemax == "") {
			$sql = $sql . " AND txdate>='$datemin'";
		} else if($datemin == "" && $datemax != "") {
			$sql = $sql . " AND txdate<='$datemax'";
		} else if($datemin != "" && $datemax != "") {
			$sql = $sql . " AND txdate>='$datemin' AND txdate<='$datemax'";
		}
	}
	$sql = $sql . " ORDER BY txdate DESC";

	// create connection
	$con = mysqli_connect();

	// check connection
	if(mysqli_connect_errno($con)) {
		$content = "Failed to connect to MySQL: " . mysqli_connect_error();
	} else {
		// begin the creation of the table
		$result = "<table border='1'>
			  	 <tr>
		 	  		<th>txid</th>
			  	 	<th>txdate</th>
			   		<th>account</th>
			   		<th>subcode</th>
			   		<th>amount</th>
			  	 	<th>description</th>
			  	 </tr>";

		//echo $sql . "<br>";
		$content = mysqli_query($con,"$sql");
	
		while($row = mysqli_fetch_array($content)) {
			if(($_GET["$row[account]"] == "false") || ($_GET["$row[subcode]"] == "false")) continue;
		
			$result = $result . "<tr>
					 			   <td>$row[txid]</td>
					 		 	   <td><div id=\"$row[txid]txdate\">$row[txdate]</div></td>
							 	   <td><div id=\"$row[txid]account\">$row[account]</div></td>
					 		 	   <td><div id=\"$row[txid]subcode\">$row[subcode]</div></td>
					 		  	   <td><div id=\"$row[txid]amount\">$row[amount]</div></td>
					 		 	   <td><div id=\"$row[txid]description\">$row[description]</div></td>
							 	</tr>";
  		}	

		// close connection
		$close = mysqli_close($con);

		// finish the table and return the result
		$result = $result . "</table>";
		echo $result;
	}

}


?>