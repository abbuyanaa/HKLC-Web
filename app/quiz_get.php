<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/classes/Process.php');
$pro = new Process();

if (isset($_GET['quiz']) && $_GET['quiz'] == NULL) {
	echo json_encode(['error'=>'not_available']);
} else {
	$number = $_GET['quiz'];
	$correctAns = $pro->getCorrectAnswer($number);
	$wrongAns = $pro->getRandomWrongAnswer($number);
	$random = rand(1,4);
	$json = array();

	for ($i = 1; $i < 5; $i++) {
		if ($random == $i) {
			if ($correctAns != false) {
				if ($row = $correctAns->fetch_assoc()) {
					$json[$i] = $row;
				}
			}
		} else {
			if ($wrongAns != false) {
				if ($row = $wrongAns->fetch_assoc()) {
					$json[$i] = $row;
				}
			}
		}
	}
	echo json_encode($json, JSON_UNESCAPED_UNICODE);
}
?>
