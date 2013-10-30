<!DOCTYPE html>
<html>
<head>
<div id="identity"><h3>Zach Liss | zll1@pitt.edu</h3></div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<script type="text/javascript">

document.addEventListener("DOMSubtreeModified", function () {
    $( ".datep" ).datepicker({ dateFormat: "yy-mm-dd",changeMonth:true,changeYear:true});
});

// function to initialize table
function initialize() {
	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}

	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    		document.getElementById("theTable").innerHTML=xmlhttp.responseText;
    	}
	}

	xmlhttp.open("GET","maintenance_server.php?fun=1",true);
	xmlhttp.send();
}

function dlete(id) {
	if(confirm("Really delete the Transaction with txid: "+id+"?")) {
		if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		} else {// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  		}

		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    			document.getElementById("theTable").innerHTML=xmlhttp.responseText;
    		}
		}

		xmlhttp.open("GET","maintenance_server.php?fun=2&id="+id,true);
		xmlhttp.send();
	}
}

function update(id) {
	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}

	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    		document.getElementById("theTable").innerHTML=xmlhttp.responseText;
    	}
	}

	xmlhttp.open("GET","maintenance_server.php?fun=4&id="+id,true);
	xmlhttp.send();
}


function sendUpdate(id) {
	var txdate = document.getElementById("txdate").value;
	var account = document.getElementById("account").value;
	var subcode = document.getElementById("subcode").value;
	var amount = document.getElementById("amount").value;
	var description = document.getElementById("description").value;

	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}

	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    		document.getElementById("theTable").innerHTML=xmlhttp.responseText;
    	}
	}

	xmlhttp.open("GET","maintenance_server.php?fun=3&id="+id+"&txdate="+txdate+"&account="+account+"&subcode="+subcode+"&amount="+amount+"&description="+description,true);
	xmlhttp.send();
}

function newBoxes() {
	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}

	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    		document.getElementById("theTable").innerHTML=xmlhttp.responseText;
    	}
	}

	xmlhttp.open("GET","maintenance_server.php?fun=5",true);
	xmlhttp.send();
}

function sendTran() {
	var txdate = document.getElementById("txdate").value;
	var account = document.getElementById("account").value;
	var subcode = document.getElementById("subcode").value;
	var amount = document.getElementById("amount").value;
	var description = document.getElementById("description").value;

	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}

	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    		document.getElementById("theTable").innerHTML=xmlhttp.responseText;
    	}
	}

	xmlhttp.open("GET","maintenance_server.php?fun=6&txdate="+txdate+"&account="+account+"&subcode="+subcode+"&amount="+amount+"&description="+description,true);
	xmlhttp.send();
}
window.onload = initialize();
</script>

</head>
<body>
<button onclick="newBoxes()">Add Transaction</button>

<div id="theTable"></div>

<!-- return to piras.php -->
<form action="piras.php" method="get">
	<input type="submit" value="Return">
</form>

</body>
</html>