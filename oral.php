<?php
include 'connect.php';
$conn = $bd;
$sid=$_POST['s'];

$query="Select * from health1 where child_id=$sid order by `timestamp` desc";

$res=mysqli_query($conn,$query);

$data=mysqli_fetch_assoc($res);

$followUpData = array();
$follow = mysqli_query($conn,"Select * from `follow_up_data` where `child_id`=$sid and `o_name`='oral'");
while($row=mysqli_fetch_assoc($follow))
{
    $followUpData[$row['disease_name']] = $row['observation']; 
}

$output=array();
$output['ref']=$data['oe_referal'];
if($data['oe_referal'] != null)
{
    $colNames=array();
    foreach($data as $k => $value)
    {
        $key=getColumnName($k,"Oral");
        if($value==1 && checkColumnName($k) && strcmp($k,"oe_referal") && strpos($k, 'oe') !== false)
        {
            $colName=$key['m_name'];            
            
            if(array_key_exists($colName,$followUpData) && $followUpData[$colName]==0)
            {}
            else
                array_push($colNames,$colName);
        }
    }
    $output['colNames']=$colNames;
}

if(sizeof($output['colNames']) == 0)
{
    $output['ref']=0;
}

$output=json_encode($output);
print_r($output);
?>