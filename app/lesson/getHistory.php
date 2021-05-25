<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../classes/Word.php');
$word = new Word();

if (isset($_GET['tid']) && $_GET['tid'] == NULL) {
	echo json_encode(['error'=>'not_available']);
} else {
	$bookid = $_GET['tid'];
	$getData = $word->getTopicWordLevel($bookid);
	$json = array();
	if ($getData != false) {
		while ($row = $getData->fetch_assoc()) {
			$json[] = $row;
		}
	}
	echo json_encode($json, JSON_UNESCAPED_UNICODE);
}
?>
