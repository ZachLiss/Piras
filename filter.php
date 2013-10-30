<!DOCTYPE html>
<html>
<head>
<div id="identity"><h3>Zach Liss | zll1@pitt.edu</h3></div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<script type="text/javascript">

$(function() {
    $( "#datemin" ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: '1990:2020',
        onSelect: function( selectedDate ) {
            $( "#datemax" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#datemax" ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: '1990:2020',
        onSelect: function( selectedDate ) {
            $( "#datemin" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
});

// function to initialize table
function initialize() {
	buildAccounts();
	buildSubcodes();
	buildTable();
}

function buildAccounts() {
	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}

	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var htmlString = xmlhttp.responseText;
			var startdex = htmlString.search(/::\d+/);
			numAccounts = htmlString.substring(startdex+2, htmlString.length);

			htmlString = htmlString.replace(/::\d+/, "");
		
    		document.getElementById("faccounts").innerHTML=htmlString;
    	}
	}

	xmlhttp.open("GET","filter_server.php?fun=buildAccounts",true);
	xmlhttp.send();
}

function buildSubcodes() {
	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp1=new XMLHttpRequest();
	} else {// code for IE6, IE5
		xmlhttp1=new ActiveXObject("Microsoft.XMLHTTP");
  	}

	xmlhttp1.onreadystatechange=function() {
		if (xmlhttp1.readyState==4 && xmlhttp1.status==200) {
			var htmlString = xmlhttp1.responseText;
			var startdex = htmlString.search(/::\d+/);
			numSubcodes = htmlString.substring(startdex+2, htmlString.length);

			htmlString = htmlString.replace(/::\d+/, "");
		
    		document.getElementById("fsubcodes").innerHTML=htmlString;
    	}
	}

	xmlhttp1.open("GET","filter_server.php?fun=buildSubcodes",true);
	xmlhttp1.send();
}

function buildTable() {
	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp2=new XMLHttpRequest();
	} else {// code for IE6, IE5
		xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
  	}

	xmlhttp2.onreadystatechange=function() {
		if (xmlhttp2.readyState==4 && xmlhttp2.status==200) {
			//document.write(xmlhttp2.responseText);
    		document.getElementById("theTable").innerHTML=xmlhttp2.responseText;
    	}
	}

	xmlhttp2.open("GET","filter_server.php?fun=buildTable",true);
	xmlhttp2.send();
}

function sendFilter() {
	var keyword = document.getElementById("keyword").value;

	// add keyword to arguments
	var argString = "&keyword="+keyword;

	// add the accounts to arguments
	for(var i = 1; i <= numAccounts; i++) {
		var tmpChecked = document.getElementById("account"+i).checked;
		var tmpAccount = document.getElementById("account"+i).value;

		argString += "&"+tmpAccount+"="+tmpChecked;
	}

	// add the subcodes to arguments
	for(var i = 1; i <= numSubcodes; i++) {
		var tmpChecked = document.getElementById("subcode"+i).checked;
		var tmpSubcode = document.getElementById("subcode"+i).value;

		argString += "&"+tmpSubcode+"="+tmpChecked;
	}

	// add min and max to arguments
	var min = document.getElementById("min").value;
	var max = document.getElementById("max").value;
	if((min != "" && max != "") && min > max) { alert("make sure min < max"); return; }
	
	argString += "&min="+min+"&max="+max;

	// add datemin and datemax to arguments
	var datemin = document.getElementById("datemin").value;
	var datemax = document.getElementById("datemax").value;
	argString += "&datemin="+datemin+"&datemax="+datemax;

	console.log(argString);

	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp2=new XMLHttpRequest();
	} else {// code for IE6, IE5
		xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
  	}

	xmlhttp2.onreadystatechange=function() {
		if (xmlhttp2.readyState==4 && xmlhttp2.status==200) {
    		document.getElementById("theTable").innerHTML=xmlhttp2.responseText;
    	}
	}

	xmlhttp2.open("GET","filter_server.php?fun=sendFilter"+argString,true);
	xmlhttp2.send();
}

function reset() {
	document.getElementById("fkeyword").innerHTML = "Keyword:<input type=\"text\" id=\"keyword\">";
	document.getElementById("famount range").innerHTML = "Amount Range:<br>max:<input type=\"text\" id=\"max\">min:<input type=\"text\" id=\"min\">";
	document.getElementById("date range").innerHTML = "Date Range:<br><input type=\"text\" id=\"datemin\" class=\"datep\" readonly=\"readonly\"> to <input type=\"text\" id=\"datemax\" class=\"datep\" readonly=\"readonly\">";
	$(function() {
    $( "#datemin" ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: '1990:2020',
        onSelect: function( selectedDate ) {
            $( "#datemax" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#datemax" ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: '1990:2020',
        onSelect: function( selectedDate ) {
            $( "#datemin" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
});

	initialize();
}

var numAccounts, numSubcodes;
window.onload = initialize();
</script>

</head>
<body>

<div id="fkeyword">Keyword:<input type="text" id="keyword"></div><br>
Accounts:<div id="faccounts"></div><br>
Subcodes:<div id="fsubcodes"></div><br>
<div id="famount range">
Amount Range:<br>
max:<input type="text" id="max">min:<input type="text" id="min">
</div>
<br>
<div id="date range">
Date Range:<br>
<input type="text" id="datemin" class="datep" readonly="readonly"> to <input type="text" id="datemax" class="datep" readonly="readonly">
</div>
<br>
<div id="resetANDfilter">
	<button onclick="reset()">Reset</button>
	<button onclick="sendFilter()">Filter</button>
</div>

<div id="theTable"></div>

<!-- return to piras.php -->
<form action="piras.php" method="get">
	<input type="submit" value="Return">
</form>

</body>
</html>