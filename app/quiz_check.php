<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../classes/Process.php');
$pro = new Process();

$json = file_get_contents('php://input');
$obj = json_decode($json, true);

$kr_w = $obj['kr_w'];
$mn_w = $obj['mn_w'];

$check = $pro->checkQuiz($kr_w, $mn_w);
if ($check != false) {
	echo json_encode('Yes');
} else {
	echo json_encode('No');
}
?>
