<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../classes/Learning.php');
$learn = new Learning();

if (isset($_GET['tid'])) {
	$tid = $_GET['tid'];
	$getData = $learn->getWordView($tid);
	$json = array();
	if ($getData != false) {
		while ($row = $getData->fetch_assoc()) {
			$json['word'][] = $row;
		}
		echo json_encode($json, JSON_UNESCAPED_UNICODE);
	} else {
		echo json_encode(['msg'=>'not_available']);
	}
} else {
	echo json_encode(['msg'=>'no_address']);
}
?>
