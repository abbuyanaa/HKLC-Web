<?php
include 'DBConfig.php';
 
// Create connection
$conn = new mysqli($HostName, $HostUser, $HostPass, $DatabaseName);
mysqli_set_charset($conn,"utf8");
if ($conn->connect_error) {
 
 die("Connection failed: " . $conn->connect_error);
} 
 
/*$sql = "SELECT kr_w,mn_w FROM kr_mn 
inner join korean on korean.id=kr_mn.k_id 
inner join mongol on mongol.id = kr_mn.m_id";
//output join  kr_sentence on kr_sentence.kr_mn_id = kr_mn.id";*/
$sql = "SELECT kr_w
,(select GROUP_CONCAT(DISTINCT kr_sentence.sentence  SEPARATOR '|||')  from kr_sentence where kr_sentence.kr_mn_id = kr_mn.id ) as sent_w 
from kr_mn 
inner join kr_sentence on kr_sentence.kr_mn_id = kr_mn.id 
inner join korean on korean.id = kr_mn.k_id 
 group by kr_mn.id";
 
$result = $conn->query($sql);
 
if($result->num_rows > 0) {
 
 
	 while($row[] = $result->fetch_assoc()) {
	 
	 $tem = $row;
	 
	 $json = json_encode($tem);
	 
	 
	 }
 
} else {
 echo "No Results Found.";
}
echo $json;
$conn->close();

?>