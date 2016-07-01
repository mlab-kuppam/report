<?php
include 'connect.php';

$conn=$bd;
$sid=$_POST['s'];

$query="INSERT INTO `report_tracker`(`child_id`, `location`) VALUES ('".$sid."','')";


$result=mysqli_query($conn,$query);

echo "LOL";

?>