<?php
include 'connect.php';

$conn=$bd;
$sid=$_POST['s'];
//$sid ='20102003001';

$query="INSERT INTO `report_tracker`(`child_id`) VALUES ('".$sid."')";

$result=mysqli_query($conn,$query);
echo 'sucessfull';
?>