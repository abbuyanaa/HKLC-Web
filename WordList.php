<?php
include 'DBConfig.php';

// Create connection
$conn = new mysqli($HostName, $HostUser, $HostPass, $DatabaseName);
mysqli_set_charset($conn,"utf8");
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

// $sql = "  select kr_w,mn_w, COALESCE(sentence, 0)as sent from kr_mn left join kr_sentence on kr_sentence.kr_mn_id = kr_mn.id inner join korean on korean.id = kr_mn.k_id
//  INNER join mongol on mongol.id = kr_mn.m_id";

// $sql = "SELECT kr_w,mn_w FROM kr_mn 
// inner join korean on korean.id=kr_mn.k_id 
// inner join mongol on mongol.id = kr_mn.m_id";
// output join  kr_sentence on kr_sentence.kr_mn_id = kr_mn.id";
$sql = "
SELECT w.id as id2, kr.kr_w, mn.mn_w
FROM words AS w
INNER JOIN kr_words AS kr ON kr.id = w.kr_id 
INNER JOIN mn_words AS mn ON mn.id = w.mn_id
WHERE w.id < 10 group by w.id order by kr.kr_w asc
";

 // $sql = "select kr_w,mn_w, IF(ISNULL(sentence), 0, sentence)as sent from kr_mn left join kr_sentence on kr_sentence.kr_mn_id = kr_mn.id inner join korean on korean.id = kr_mn.k_id
 // INNER join mongol on mongol.id = kr_mn.m_id";

$result = $conn->query($sql);

if($result->num_rows > 0) {


	while($row[] = $result->fetch_assoc()) {

	 //	echo "utga-:".$row['id2']."\n\n";

	 // if(empty($row['sent_w']))
	 // {
	 // 	$row["sent_w"]=0;
	 // 	//echo "hooson-:".$row["sent_w"];

	 // }	
	 // else  if(!empty($row['sent_w']))
	 // {
	 // 	//echo "utga-:".$row["sent_w"];
	 // }
		foreach($row as $key=>$val){
			if(empty($val["sent_w"]))
			{

				$row[$key]["sent_w"] = "No";


	 		//echo "utga:".$row["sent_w"]."<br />";
	 		//echo "null utga:".$val["sent_w"]."<br />";
			}
			else if(!empty($val["sent_w"]))
			{
	 		//echo "id:".$val["id2"]."<br />";
	 		//echo "sent utga: ".$val["sent_w"]."<br />";
	 		//echo "id:".$row["kr_w"]."<br />";
			}
		}
		$tem = $row;

	// $json = json_encode($tem);
		$json = json_encode($tem, JSON_UNESCAPED_UNICODE);

	}



} else {
	echo "no result";
// $json = array(
//  	'data' => null,
//  	'status' => 0,
//  	'message' => ''
//  );
}
echo $json;
$conn->close();

?>