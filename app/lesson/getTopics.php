<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../config/Database.php');

$db = new Database();

if (isset($_GET['bid'])) {
	$bid = $_GET['bid'];

	$query = "
SELECT t.id, t.kr_name, t.mn_name FROM topics AS t 
INNER JOIN krbook AS kr ON kr.topic_id = t.id
INNER JOIN books AS b ON b.id = kr.book_id
WHERE b.id = '$bid'
	";
	$result = $db->select($query);

	$json = array();
	if ($result != false) {
		while ($row = $result->fetch_assoc()) {
			$json[] = $row;
		}
		echo json_encode($json, JSON_UNESCAPED_UNICODE);
	} else {
		echo json_encode(['msg'=>'not_available'], JSON_UNESCAPED_UNICODE);
	}
}
?>
