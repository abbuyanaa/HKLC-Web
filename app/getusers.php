<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../classes/User.php');
$learn = new User();

$getBooks = $learn->getAllBooks();
if ($getBooks != false) {
	while ($row[] = $getBooks->fetch_assoc()) {
		$json = $row;
	}
}
echo json_encode($json, JSON_UNESCAPED_UNICODE);
?>
