<?php
include 'DBConfig.php';
 
// Create connection
$conn = new mysqli($HostName, $HostUser, $HostPass, $DatabaseName);
mysqli_set_charset($conn,"utf8");
if ($conn->connect_error) {
 
 die("Connection failed: " . $conn->connect_error);
} 
 
$sql = "SELECT kr_mn.id as id2,kr_w,mn_w
,(select GROUP_CONCAT(DISTINCT kr_sentence.sentence  SEPARATOR '|||')  from kr_sentence where kr_sentence.kr_mn_id = kr_mn.id ) as sent_w 
from kr_mn
inner join korean on korean.id = kr_mn.k_id 
inner join mongol on mongol.id = kr_mn.m_id where kr_mn.id< 5500 group by kr_mn.id";
 

$result = $conn->query($sql);
 

if($result->num_rows > 0) {
 
 
	 while($row[] = $result->fetch_assoc()) {
	 	foreach($row as $key=>$val){
			 
	 	if(empty($val["sent_w"]))
	 	{
	 		
	 		$row[$key]["sent_w"] = "No";
	 	}
	 	else if(!empty($val["sent_w"]))
	 	{

		 }
		
	}
	$tem = $row;
	 
	$json = json_encode($tem);
	 
	 }
	 
	 
 
} else {
	echo "no result";
}
echo $json;
$conn->close();

?>