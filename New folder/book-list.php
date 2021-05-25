<?php

include 'config/database.php';
$db = new Database();

$result = $db->select("SELECT * FROM books ORDER BY id DESC");
if (!empty($result)) {
	while ($row[] = mysqli_fetch_assoc($result)) {
		$json = $row;
	}
}
echo json_encode($json, JSON_UNESCAPED_UNICODE);

?>