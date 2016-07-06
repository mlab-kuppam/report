<?php
include 'connect.php';
$conn = $bd;
$sid=$_POST['s'];

$query="Select * from skin where child_id=$sid  order by `timestamp` desc";

$res=mysqli_query($conn,$query);

$data=mysqli_fetch_assoc($res);

$output=array();
$output['ref']=$data['referal'];
if($data['referal'] != null)
{
    $colNames=array();
    foreach($data as $k => $value)
    {
	$key=getColumnName($k,"Skin");    
        if($value==1 && checkColumnName($k))
        {
            $colName=$key['m_name'];
            
            array_push($colNames,$colName);
        }
    }
    $output['colNames']=$colNames;
    
    //Advise checking
    $advice=array();
    //print_r("impression ".$data['impression']);
    $adv=array_unique(explode(",",$data['impression']),SORT_REGULAR);
    $ctr=0;
    if( count($adv)>1 && in_array(0,$adv))
    {
        $ctr=1;
    }
    
    foreach($adv as $k)
    {   
        if($k!=19 && $k!=0)
            array_push($advice,$impression[$k]);
        else if($ctr==0)
        {
            array_push($advice,$impression[0]);
        }
        else if(strpos($k, '19') !== false)
        {
            $other=explode(":",$k);
            array_push($advice,$other[1]);
        }
    }
    $output['advice']=$advice;
}

$output=json_encode($output);
print_r($output);


?>