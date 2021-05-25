<?php

include 'config/database.php';
$db = new Database();

$json = file_get_contents('php://input');
$obj = json_decode($json, true);

$kr_name = $obj['kr_name'];
$mn_name = $obj['mn_name'];

$result = $db->select("SELECT * FROM `books` WHERE `kr_name`='$kr_name' AND `mn_name` = '$mn_name'");
if (!empty($result)) {
	echo json_encode('exists');
} else {
	$data = array(
		'kr_name' => $kr_name,
		'mn_name' => $mn_name
	);
	if ($db->insert('books', $data)) {
		echo json_encode('success');
	} else {
		echo json_encode('error');
	}
}

?>