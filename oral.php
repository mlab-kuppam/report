<?php
include 'connect.php';
$conn = $bd;
$sid=$_POST['s'];

$query="Select * from health1 where child_id=$sid order by `timestamp` desc";

$res=mysqli_query($conn,$query);

$data=mysqli_fetch_assoc($res);

$output=array();
$output['ref']=$data['oe_referal'];
if($data['oe_referal'] != null)
{
    $colNames=array();
    foreach($data as $k => $value)
    {
        if($value==1 && checkColumnName($k) && strcmp($k,"oe_referal") && strpos($k, 'oe') !== false)
        {
            $key=getColumnName($k);
            $colName=$key['m_name'];            
            array_push($colNames,$colName);
        }
    }
    $output['colNames']=$colNames;
}

$output=json_encode($output);
print_r($output);
?>