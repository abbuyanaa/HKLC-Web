<?php

include 'config/database.php';
$db = new Database();

$query = "SELECT * FROM users";
$result = $db->select($query);
if (empty($result)) {
	echo json_encode("not_available");
} else {
	while ($row[] = mysqli_fetch_assoc($result)) {
		$json = json_encode($row);
	}
}
print_r($json);

?>