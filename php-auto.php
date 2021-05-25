<?php


$mysqli = mysqli_connect("localhost","inputword","ether(93#!99)_NET","inputword");
$mysqli->set_charset("utf8");
$getData = $_GET['term'];
//$query = $mysqli -> query("select kr_w from kr_mn inner join korean on kr_mn.k_id=korean.id inner join mongol on kr_mn.m_id = mongol.id where kr_w like '%".$getData."%'");

$query = $mysqli -> query("select kr_mn.id,kr_w,mn_w from kr_mn inner join korean on kr_mn.k_id=korean.id inner join mongol on kr_mn.m_id=mongol.id where korean.kr_w like '%".$getData."%'");
$arrData = array();
if($query->num_rows > 0){
while($row = $query ->fetch_assoc()){
	$data[]= $row['id'].'-'.$row['kr_w']. '-' . $row['mn_w'];
	//array_push($arrData, $data[]);

	}

}

echo json_encode($data);

?>
