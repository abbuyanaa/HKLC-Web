<?php

include 'config/database.php';
$db = new Database();

if (isset($_GET['bid'])) {
	$result = $db->select("SELECT * FROM books WHERE id = ".$_GET['bid']);
	if (empty($result)) {
		echo json_encode('not_available');
	} else {
		if ($row = mysqli_fetch_assoc($result)) {
			echo json_encode($row, JSON_UNESCAPED_UNICODE);
		}
	}
}

?>