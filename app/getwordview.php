<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../classes/Learning.php');
$learn = new Learning();

if (isset($_GET['wordid']) && $_GET['wordid'] == NULL) {
	echo json_encode(['error'=>'not_available']);
} else {
	$number = $_GET['wordid'];
	$getData = $learn->getWordView($number);
	$json = array();
	if ($getData != false) {
		if ($row = $getData->fetch_assoc()) {
			$json[] = $row;
		}
	}
	echo json_encode($json, JSON_UNESCAPED_UNICODE);
}
?>
