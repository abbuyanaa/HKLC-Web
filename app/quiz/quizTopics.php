<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../config/Database.php');
$db = new Database();

if (isset($_GET['bid'])) {
	$bookid = $_GET['bid'];

	$query = "
SELECT t.* FROM books AS b 
INNER JOIN krbook AS krb ON krb.book_id = b.id 
INNER JOIN topics AS t ON t.id = krb.topic_id 
WHERE b.id = '$bookid'
	";
	$getData = $db->select($query);
	$json = array();
	if ($getData != false) {
		while ($row = $getData->fetch_assoc()) {
			$json[] = $row;
		}
		echo json_encode($json, JSON_UNESCAPED_UNICODE);
	} else {
		echo json_encode(['msg'=>'Not Available']);
	}
}
?>
