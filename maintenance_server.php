<?php

// get function from URL
$fun = $_GET["fun"];

if($fun == 1) {
	// code for initialize
	initialize();
} else if($fun == 2) {
	// code for delete...
	dlete($_GET["id"]);
} else if($fun == 3) {
	// code for update...
	update($_GET["id"], $_GET["txdate"], $_GET["account"], $_GET["subcode"], $_GET["amount"], $_GET["description"]);
} else if($fun == 4) {
	// code to make the text boxes
	makeForm($_GET["id"]);
} else if($fun == 5) {
	// code for new transaction text boxes
	newTran();
} else if($fun == 6) {
	// code to add new transaction
	addTran($_GET["txdate"], $_GET["account"], $_GET["subcode"], $_GET["amount"], $_GET["description"]);
}

function initialize() {
	// create connection
	$con = mysqli_connect();

	// check connection
	if(mysqli_connect_errno($con)) {
		$content += "Failed to connect to MySQL: " . mysqli_connect_error();
	} else {
		// begin the creation of the table
		$result = "<table border='1'>
			  	 <tr>
		 	  		<th></th>
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
								   <td><button onclick=\"dlete($row[txid])\">delete</button>
								       <button onclick=\"update($row[txid])\">update</button></td>
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

function dlete($id) {
	// create connection
	$con = mysqli_connect();

	// check connection
	if(mysqli_connect_errno($con)) {
		$content += "Failed to connect to MySQL: " . mysqli_connect_error();
	} else {

		mysqli_query($con, "DELETE FROM Transactions WHERE txid = $id");

		// begin the creation of the table
		$result = "<table border='1'>
			  	 <tr>
		 	  		<th></th>
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
								   <td><button onclick=\"dlete($row[txid])\">delete</button>
								       <button onclick=\"update($row[txid])\">update</button></td>
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

function update($id, $txdate, $account, $subcode, $amount, $description) {
	// create connection
	$con = mysqli_connect();

	// check connection
	if(mysqli_connect_errno($con)) {
		$content += "Failed to connect to MySQL: " . mysqli_connect_error();
	} else {
		
		mysqli_query($con, "UPDATE Transactions SET txdate='$txdate', account='$account', subcode='$subcode', amount='$amount', description='$description'  WHERE txid=$id");

		// begin the creation of the table
		$result = "<table border='1'>
			  	 <tr>
		 	  		<th></th>
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
								   <td><button onclick=\"dlete($row[txid])\">delete</button>
								       <button onclick=\"update($row[txid])\">update</button></td>
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

function makeForm($id) {
	// create connection
	$con = mysqli_connect();

	// check connection
	if(mysqli_connect_errno($con)) {
		$content += "Failed to connect to MySQL: " . mysqli_connect_error();
	} else {
		// begin the creation of the table
		$result = "<table border='1'>
			  	 <tr>
		 	  		<th></th>
		 	  		<th>txid</th>
			  	 	<th>txdate</th>
			   		<th>account</th>
			   		<th>subcode</th>
			   		<th>amount</th>
			  	 	<th>description</th>
			  	 </tr>";

		$content = mysqli_query($con,"SELECT * FROM Transactions ORDER BY txdate DESC");
		$retcodes = mysqli_query($con, "SELECT DISTINCT subcode FROM Subcodes");
		$codeStr = "<select id=\"subcode\">";
		while($row = mysqli_fetch_array($retcodes)) {
			$codeStr = $codeStr . "<option value=\"$row[subcode]\">$row[subcode]</option>";
		}

	
		while($row = mysqli_fetch_array($content)) {
			if($row["txid"] == $id) {
				$result = $result . "<tr>
								   	  <td><button>delete</button>
								      	  <button>update</button></td>
					 			  	  <td>$row[txid]</td>
					 		 	  	  <td><div id=\"$row[txid]txdate\"><input type=\"text\" id=\"txdate\" value=\"$row[txdate]\" class=\"datep\" readonly=\"readonly\"></div></td>
							 	  	  <td><div id=\"$row[txid]account\"><input type=\"text\" id=\"account\" value=\"$row[account]\"></div></td>
					 		 	   	  <td><div id=\"$row[txid]subcode\">$codeStr</div></td>
					 		  	   	  <td><div id=\"$row[txid]amount\"><input type=\"text\" id=\"amount\" value=\"$row[amount]\"></div></td>
					 		 	  	  <td><div id=\"$row[txid]description\"><input type=\"text\" id=\"description\" value=\"$row[description]\"></div></td>
					 		 	  	  <td><button onclick=\"sendUpdate($row[txid])\">Save</button>
					 		 	  	 	  <button onclick=\"initialize()\">Cancel</button>
					 		 	  	  </td>
							 		</tr>";
			} else {
				$result = $result . "<tr>
								   	  <td><button onclick=\"dlete($row[txid])\">delete</button>
								      	  <button onclick=\"update($row[txid])\">update</button></td>
					 			  	  <td>$row[txid]</td>
					 		 	  	  <td><div id=\"$row[txid]txdate\">$row[txdate]</div></td>
							 	  	  <td><div id=\"$row[txid]account\">$row[account]</div></td>
					 		 	   	  <td><div id=\"$row[txid]subcode\">$row[subcode]</div></td>
					 		  	   	  <td><div id=\"$row[txid]amount\">$row[amount]</div></td>
					 		 	  	  <td><div id=\"$row[txid]description\">$row[description]</div></td>
							 		</tr>";
			}
  		}	

		// close connection
		$close = mysqli_close($con);

		// finish the table and return the result
		$result = $result . "</table>";
		echo $result;
	}
}

function newTran() {
	// create connection
	$con = mysqli_connect();

	// check connection
	if(mysqli_connect_errno($con)) {
		$content += "Failed to connect to MySQL: " . mysqli_connect_error();
	} else {
		// begin the creation of the table
		$result = "<table border='1'>
			  	 <tr>
		 	  		<th></th>
		 	  		<th>txid</th>
			  	 	<th>txdate</th>
			   		<th>account</th>
			   		<th>subcode</th>
			   		<th>amount</th>
			  	 	<th>description</th>
			  	 </tr>";

		$retcodes = mysqli_query($con, "SELECT DISTINCT subcode FROM Subcodes");
		$codeStr = "<select id=\"subcode\">";
		while($row = mysqli_fetch_array($retcodes)) {
			$codeStr = $codeStr . "<option value=\"$row[subcode]\">$row[subcode]</option>";
		}

		$result = $result . "<tr>
							  <td><button>delete</button>
								  <button>update</button></td>
					 		  <td></td>
					 		  <td><input type=\"text\" id=\"txdate\" value=\"$row[txdate]\" class=\"datep\" readonly=\"readonly\"></td>
							  <td><input type=\"text\" id=\"account\"></td>
					 		  <td>$codeStr</td>
					 		  <td><input type=\"text\" id=\"amount\"></td>
					 		  <td><input type=\"text\" id=\"description\"></td>
					 		  <td><button onclick=\"sendTran()\">Save</button>
					 		 	  <button onclick=\"initialize()\">Cancel</button></td>
							 </tr>";
		$content = mysqli_query($con,"SELECT * FROM Transactions ORDER BY txdate DESC");
		
		while($row = mysqli_fetch_array($content)) {
			
			$result = $result . "<tr>
							   	  <td><button onclick=\"dlete($row[txid])\">delete</button>
								      <button onclick=\"update($row[txid])\">update</button></td>
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

function addTran($txdate, $account, $subcode, $amount, $description) {
	// create connection
	$con = mysqli_connect();

	// check connection
	if(mysqli_connect_errno($con)) {
		$content += "Failed to connect to MySQL: " . mysqli_connect_error();
	} else {
		//echo "INSERT INTO Transactions (txdate, account, subcode, amount, description) VALUES ('$txdate', '$account', '$subcode', '$amount', '$description')";
		mysqli_query($con, "INSERT INTO Transactions (txdate, account, subcode, amount, description) VALUES ('$txdate', '$account', '$subcode', '$amount', '$description')");

		// begin the creation of the table
		$result = "<table border='1'>
			  	 <tr>
		 	  		<th></th>
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
								   <td><button onclick=\"dlete($row[txid])\">delete</button>
								       <button onclick=\"update($row[txid])\">update</button></td>
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