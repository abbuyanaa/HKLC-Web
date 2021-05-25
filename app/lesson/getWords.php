<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../config/Database.php');

$db = new Database();

if (isset($_GET['tid'])) {
	$tid = $_GET['tid'];

	$query = "
SELECT kr.id AS word_id, kr.kr_w,
(
SELECT GROUP_CONCAT(DISTINCT mn.mn_w SEPARATOR ', ') FROM mn_words AS mn 
INNER JOIN words AS wd ON wd.mn_word = mn.id
WHERE wd.kr_word = kr.id
) AS mn_w, ai.kr_name AS aikr_name, ai.mn_name AS aimn_name
FROM kr_words AS kr
INNER JOIN words AS w ON w.kr_word = kr.id 
INNER JOIN krbook AS krb ON krb.id = kr.krbook_id 
INNER JOIN topics AS t ON t.id = krb.topic_id 
INNER JOIN aimag AS ai ON ai.id = kr.aimag_id 
WHERE t.id = '$tid' 
ORDER BY kr.kr_w ASC 
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
