<?php
	require_once('connect.php');
	
	//Sanitize the POST values
	$sid = $_POST['s'];
	//$sid = '20602021066';
	//$sid = '20102003001';
	
	$pdetails=mysqli_query($bd,"SELECT DISTINCT `name`,`father_name`, `mother_name`, `guardian_name` FROM `child` WHERE `child_id`='$sid'");
	$sdetails=mysqli_query($bd,"SELECT `name` FROM `school` WHERE `school_id`=(SELECT DISTINCT `school_id` FROM `child` WHERE `child_id`='$sid')");
	
	while ($row = mysqli_fetch_assoc($sdetails)) {
		$result1 = $row['name'] . "$";
	}
	
	//Output data of each row
	while ($row = mysqli_fetch_assoc($pdetails)) {
		$result2 = $row['name'] . "$" . $row['father_name'] . "$" . $row['mother_name'] . "$" . $row['guardian_name'].'$';
	}
	echo $result1.$result2;
	exit();
 ?>
