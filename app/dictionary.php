<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/classes/Dictionary.php');
$dict = new Dictionary();

$getWord = $dict->getDictionary("");
$json = array();
if ($getWord != false) {
	while ($row = $getWord->fetch_assoc()) {
		$json[] = $row;
	}
}
echo json_encode($json, JSON_UNESCAPED_UNICODE);
?>
