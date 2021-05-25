<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../classes/Learning.php');
$learn = new Learning();

if (isset($_GET['bid']) && isset($_GET['tid'])) {
	$bid = $_GET['bid'];
	$tid = $_GET['tid'];
	$getLevel = $learn->getTopicLevel($bid, $tid);
	$json = array();
	if ($getLevel != false) {
		while ($row = $getLevel->fetch_assoc()) {
			$json[] = $row;
		}
		echo json_encode($json, JSON_UNESCAPED_UNICODE);
	} else {
		echo json_encode(['error'=>'not_available']);
	}
}
?>
