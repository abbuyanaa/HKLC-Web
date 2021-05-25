<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/config/Database.php');

$db = new Database();

$query = "
SELECT b.id, b.kr_name, b.mn_name, b.image, bl.kr_name AS blkr_name FROM books AS b 
INNER JOIN booklevel AS bl ON bl.id = b.level_id
-- WHERE b.status = '0'
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
?>
