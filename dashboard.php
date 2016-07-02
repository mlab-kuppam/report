<?php
	session_start();
?>
<html>
	<head>
		<title>DST - Project : Report Card </title>
		<!-- Favicon -->
		<link rel="icon" href="img/favicon.png" sizes="16x16" type="image/png">
		<!-- Bootstrap Core CSS -->
		<link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- jQuery -->
		<script src="bower_components/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap Core JavaScript -->
		<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/report.css">
		
		<style>
			h1{
				font-family: "Times New Roman", Georgia, Serif;
			}

			#pesit-logo{
				float: right;
				position: static;
				padding-bottom: 5px;
				top: 3px;
				right: 2px;
				height: 5.5%;
			}
			#pesimsr-logo{
				float: left;
				position: static;
				margin-top:25px;
				top: 20px;
				left: 15px;
				height: 2.5%;
			}

			table#static-table tr td{
				padding-top: 10px;
			}
			input[type=checkbox] 
			{
				width:20px; 
				height:20px;
			}
			table#med-table td{
				font-family: "Times New Roman", Georgia, Serif;
				font-size: 15px;
			}
			table#med-table th{
				font-family: "Times New Roman", Georgia, Serif;
				font-size: 18px;
			}
			table#treat-table td{
				font-family: "Times New Roman", Georgia, Serif;
				font-size: 15px;
			}
			table#treat-table th{
				font-family: "Times New Roman", Georgia, Serif;
				font-size: 18px;
			}
		</style>
	</head>

	<body onload="begin()">
			<div class="navigation">
					<ul>
					<li style="float:left;"><p>Student Report Generation</p></li>
					  <li id="logMeOut"><a href="logout.php">Logout</a></li>
					  <li id="saveMe"><a onclick='saveStudent()'>Save And Next</a></li>
					</ul>
			</div>
			<div class="page">
				<img id="pesit-logo" src="img/pesit.png" ></img>
				<img id="pesimsr-logo" src="img/pesimsr.png" ></img>
				<h1 style="font-size:25px;"><center>Health Report<center></h1>
				<hr>

				<div id="main">
					<!-- Student Details -->
					<div class="well well-sm">Student Unique ID:  <b><span id="student_id"></span></b>
						<table id="static-table">
							<tr>
								<td>Child Name:  <b><span id="cname"></span></b></td>
							</tr>
							<tr>
								<td>Parent Name:  <b><span id="pname"></span></b></td>
							</tr>
							<tr>
								<td>School Name:  <b><span id="sname"></span></b></td>
							</tr>	
						</table>
					</div>
				</div>
				<div class="panel panel-default" style="margins:0px">
					<div class="panel-heading">Medical Details</div>
					<div class="panel-body">
						<table class="table table-hover table-bordered" id="med-table">
						<thead>
						  <tr>
							<th><center>Observations</center></th>
							<th><center>Advice</center></th>
							<th><center>Referal</center></th>
						  </tr>
						</thead>
					  </table>
					</div>
				</div>
				
				<p style="font-size:15px;"><center>- - - - - - - - - Cut Here - - - - - - - -<center></p>
				
				<div id="treatment-div" class="panel panel-default style="margins:0px"">
					<div class="panel-heading">Prescription <span style="float:right;"><b><span id="student_id_pre"></b></span></div>
					<div class="panel-body">
						<table class="table table-bordered" id="treat-table">
						<thead>
						  <tr>
							<th><center>Medicine</center></th>
							<th><center>Duration</center></th>
							<th><center>Period</center></th>
							<th><center>Check Box</center></th>
						  </tr>
						</thead>
					  </table>
					  <div style="float:right;">
						<button class="btn btn-danger btn-md" id="treat-add" style='padding-left:10px; width:100px;' onclick='deleteTreat()'>Delete</button>
						<button class="btn btn-success btn-md" id="treat-add" style='padding-left:10px; width:100px;' onclick='addTreat()'>Add</button>
					  </div>
					</div>
				</div>
			</div>
		
	</body>
	
	<script>
		// Global data reciever
		var dataReceived;
		var sid = <?php echo $_SESSION['sid'] ?> ;
		//console.log("Stud_id: "+sid);
		//console.log(window.location.hostname);
		var ip_address = window.location.hostname;

		function begin(){
			setDetails();
			getGeneral();
			getOral();
			getEye();		
			getENT();
			getSkin();
			getTreat();
		}
		
		
		function setDetails(){
			document.getElementById("student_id").innerHTML = sid;
			document.getElementById("student_id_pre").innerHTML = sid;
			var child_name = document.getElementById("cname");
			var parent_name = document.getElementById("pname");
			var school_name = document.getElementById("sname");
			
			getData("queryDetails.php", sid);
			var tempdata = dataReceived.split('$');
			
			child_name.innerHTML = tempdata[1];
			school_name.innerHTML = tempdata[0];
			
			if(tempdata[4].length > 0){
				parent_name.innerHTML = tempdata[4];
			}else if(tempdata[2].length > 0){
				parent_name.innerHTML = tempdata[2];
			}else if(tempdata[3].length > 0){
				parent_name.innerHTML = tempdata[3];
			}
		}		
		
		
		function insertRowRef(c1, c2, c3){
			var  medTableRef = document.getElementById('med-table');
			var row = medTableRef.insertRow(-1);
			
			var cell1 = row.insertCell(0);
			var cell2 = row.insertCell(1);
			var cell3 = row.insertCell(2);

			// Add some text to the new cells:
			cell1.innerHTML = "<div contenteditable>"+c1+"</div>";
			cell2.innerHTML = "<div contenteditable>"+c2+"</div>";	
			cell3.innerHTML = "<div contenteditable>"+c3+"</div>";	
		}
		
		function getSkin(){
			var finalSkin1 = "";
			var finalSkin2 = "";
			dataReceived = "";
			getData("skin.php", sid);
			var skinData = JSON.parse(dataReceived);
			//console.log(skinData);
			if(skinData['ref'] != null){
				finalSkin1 = "<u><b>Skin</b></u><br>";
				for(var i = 0; i < skinData['colNames'].length; i++){
					finalSkin1 += skinData['colNames'][i]+"<br>";
				}
				for(var i = 0; i < skinData['advice'].length; i++){
					if(skinData['advice'][i].localeCompare("Nil") != 0){
						finalSkin2 += skinData['advice'][i]+"<br>";
					}
				}
				var referal = "Referal Not Required";
				if(skinData['ref'] != 0){
					referal = "Referal Required";
				}
				if( skinData['colNames'].length != 0 ||  finalSkin2.length != 0 ){
					insertRowRef(finalSkin1, finalSkin2,referal);
				}
			}
		}
		
		function getENT(){
			var finalENT1 = "";
			var finalENT2 = "";
			dataReceived = "";
			getData("ent.php", sid);
			var entData = JSON.parse(dataReceived);
			//console.log(entData);
			if(entData['ref']!= null){
				finalENT1 = "<u><b>ENT</b></u><br>";
				for(var i = 0; i < entData['colNames'].length; i++){
					finalENT1 += entData['colNames'][i]+"<br>";
				}
				for(var i = 0; i < entData['advice'].length; i++){
					if(entData['advice'][i].localeCompare("Nil") != 0){
						finalENT2 += entData['advice'][i]+"<br>";
					}
				}
				var referal = "Referal Not Required";
				if(entData['ref'] != 0){
					referal = "Referal Required";
				}
				if( entData['colNames'].length != 0 ||  finalENT2.length != 0 ){
					insertRowRef(finalENT1, finalENT2,referal);
				}
			}
		}
		
		function getGeneral(){
			var finalGen1 = "";
			var finalGen2 = "";
			dataReceived = "";
			getData("general.php", sid);
			var genData = JSON.parse(dataReceived);
			//console.log(genData);
			if(genData['ref'] != null){
				finalGen1 = "<u><b>General</b></u><br>";
				for(var i = 0; i < genData['colNames'].length; i++){
					finalGen1 += genData['colNames'][i]+"<br>";
				}
				for(var i = 0; i < genData['advice'].length; i++){
					if(genData['advice'][i].localeCompare("Nil") != 0){
						finalGen2 += genData['advice'][i]+"<br>";
					}
				}
				var referal = "Referal Not Required";
				if(genData['ref'] != 0){
					referal = "Referal Required";
				}
				if( genData['colNames'].length != 0 ||  finalGen2.length != 0 ){
					insertRowRef(finalGen1, finalGen2,referal);
				}
			}
		}
		
		function getOral(){
			var finalOral1 = "";
			dataReceived = "";
			getData("oral.php", sid);
			var oralData = JSON.parse(dataReceived);
			//console.log(oralData);
			if(oralData['ref'] != null){
				finalOral1 = "<u><b>Oral</b></u><br>";
				for(var i = 0; i < oralData['colNames'].length; i++){
					finalOral1 += oralData['colNames'][i]+"<br>";
				}
				var referal = "Referal Not Required";
				if(oralData['ref'] != 0){
					referal = "Referal Required";
				}
				if( oralData['colNames'].length != 0){
					insertRowRef(finalOral1, " --- ", referal);
				}
			}
		}
		
		function getEye(){
			var finalEye1 = "";
			var finalEye2 = "";
			dataReceived = "";
			getData("eye.php", sid);
			var eyeData = JSON.parse(dataReceived);
			//console.log(eyeData);
			if(eyeData['ref'] != null){
				finalEye1 = "<u><b>Eye</b></u><br>";
				for(var i = 0; i < eyeData['colNames'].length; i++){
					finalEye1 += eyeData['colNames'][i]+"<br>";
				}
				for(var i = 0; i < eyeData['advice'].length; i++){
					if(eyeData['advice'][i].localeCompare("Nil") != 0){
						finalEye2 += eyeData['advice'][i]+"<br>";
					}
				}
				var referal = "Referal Not Required";
				if(eyeData['ref'] != 0){
					referal = "Referal Required";
				}
				if( eyeData['colNames'].length != 0 ||  finalEye2.length != 0 ){
					insertRowRef(finalEye1, finalEye2,referal);
				}
			}
		}

		var sl = 1;
		function getTreat(){
			dataReceived = "";
			getData("treat.php", sid);
			var treatData = dataReceived.split('$');
			console.log(treatData);
			for(var i = 0; i < 4; i++){
				if(treatData[i] != 0){
					var medData = treatData[i].split('@');
					var checkBox = "<input type='checkbox' class='treatBox' id='treat"+sl+"' style='width:50px;'> ";
					insertRowTreat(medData[1],medData[2],medData[3],checkBox);
				}
			}
		}
		
		function addTreat(){
			var checkBox = "<input type='checkbox' class='treatBox' id='treat"+sl+"' style='width:50px;' > ";
			insertRowTreat("","","",checkBox);
		}
		
		function insertRowTreat( c1, c2, c3, c4){
			
			var  treatTableRef = document.getElementById('treat-table');
			var row = treatTableRef.insertRow(-1);
			
			var cell1 = row.insertCell(0);
			var cell2 = row.insertCell(1);
			var cell3 = row.insertCell(2);
			var cell4 = row.insertCell(3);

			// Add some text to the new cells:
			cell1.innerHTML = "<input type='text' id='treat-med-"+sl+"' value='"+c1+"'>";	
			cell2.innerHTML = "<input type='number' id='treat-dur-"+sl+"' value='"+c2+"' style='width:100px'>";
			cell3.innerHTML = "<input type='text' id='treat-per-"+sl+"' value='"+c3+"' style='width:100px'>";
			cell4.innerHTML = c4;
			sl++;
		}
		
		function deleteTreat(){
			var  treatTableRef = document.getElementById('treat-table');
			var x = document.getElementsByClassName("treatBox");
			//console.log("checked box: "+x);
			for(var i = 0; i < x.length; i++){
				var temp = x[i].id;
				//console.log("checked box ID: "+temp);
				if(document.getElementById(temp).checked){
					for (var j = 1; j < treatTableRef.rows.length ; j++) {								
						//console.log("Row cells:"+treatTableRef.rows[j].cells[4].children[0].id);
						if(temp.localeCompare(treatTableRef.rows[j].cells[3].children[0].id) == 0){
							//console.log("Row cells selected:"+treatTableRef.rows[j].cells[4].children[0].id);
							treatTableRef.deleteRow(j);
						}  
					}	
				}
			}

		}
		
		function saveStudent(){
			//console.log("Save Student");
			dataReceived = '';
			getData("saveStudent.php",sid);
			if(dataReceived.localeCompare('sucessfull') == 0){
				cleanTreat();
				window.print();
				var tempSID = parseInt(sid) + 1 ;
				//console.log(tempSID);
				sid = tempSID;
				var studentID = prompt("Please enter next student ID", sid);
				dataReceived = '';
				getData("checkStudent.php",studentID);
				if (studentID != null && dataReceived.localeCompare('sucessfull') == 0) {
					sid = studentID;
					deleteRows();
					begin();
				}else{
					alert("Invalid Student ID..Please try again");
					sid = parseInt(sid) - 1;
				}				
			}else{
				alert("Error Saving..Please try again");
			}
			//console.log(dataReceived);
		}
		
		function deleteRows(){
			var tab1 = document.getElementById('med-table');
			var tab2 = document.getElementById('treat-table');
			for(var i = tab1.rows.length - 1; i > 0; i-- ){
				tab1.deleteRow(i);
			}
			for(var i = tab2.rows.length - 1; i > 0; i-- ){
				tab2.deleteRow(i);
			}
		}
		
		function cleanTreat(){
			var table = document.getElementById("treat-table");
			var row;
			for (var i = table.rows.length - 1; i > 0; i--) {
				row = table.rows[i];
			   for (var j = 0, col; col = row.cells[j]; j++) {
				console.log(col.children[0].value);
				   if(col.children[0].value.length > 0){
					   //break;
					}else{
					    //console.log("del: "+col.children[0].value.length);
					   table.deleteRow(i);
					   break;
				   }
			   }  
			}
		}
		
		
		// Function to get Data from DB
		function getData(phpName, stud_id) {
			var xhttp,data;
			if (window.XMLHttpRequest){
				xhttp = new XMLHttpRequest();
			}
			else{
				xhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xhttp.onreadystatechange = function ()
			{
				if(xhttp.readyState==4 && xhttp.status==200)
				{
					data = xhttp.responseText;
					if(!data.includes("Unsuccessful")){
						dataReceived = data;
						//console.log(data);
					}
					else{
						console.error("Unsuccessful retrieval");
					}
				}
			};
			xhttp.open("POST","http://"+ip_address+"/report/"+phpName,false);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("s="+stud_id);
		}
		
	</script>
</html>