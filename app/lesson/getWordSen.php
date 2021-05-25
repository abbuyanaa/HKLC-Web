<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../classes/Learning.php');
$learn = new Learning();

if (isset($_GET['wordid'])) {
	$number = $_GET['wordid'];
	$getSen = $learn->getWordSen($number);
	$json = array();
	if ($getSen != false) {
		while ($sen_row = $getSen->fetch_assoc()) {
			$json[] = $sen_row;
		}
		echo json_encode($json, JSON_UNESCAPED_UNICODE);
	} else {
		echo json_encode(['msg'=>'not_available']);
	}
}
?>
