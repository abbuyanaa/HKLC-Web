<?php
$random = rand(1,4);

$json = array();
for ($i = 1; $i < 5; $i++) {
	if ($random == $i) {
		$json[$i] = 'Yes';
	} else {
		$json[$i] = 'No';
	}
}
echo json_encode($json);
?>
