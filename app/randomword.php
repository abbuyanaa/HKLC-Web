<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/classes/Word.php');
$word = new Word();

$getData = $word->RandomWord();
$json = array();
if ($getData != false) {
	while ($row = $getData->fetch_assoc()) {
		$json[] = $row;
	}
	echo json_encode($json, JSON_UNESCAPED_UNICODE);
} else {
	echo json_encode(['msg'=>'not_available'], JSON_UNESCAPED_UNICODE);
}

?>
