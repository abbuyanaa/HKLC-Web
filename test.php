<?php
$old_con = mysqli_connect('localhost','root','','hureelearning');
$new_con = mysqli_connect('localhost','root','','learning');

mysqli_set_charset($old_con, 'utf8');
mysqli_set_charset($new_con, 'utf8');

$query = "SELECT * FROM kr_words limit 0, 300";
$result = mysqli_query($old_con, $query);
while ($row = mysqli_fetch_assoc($result)) {
	$bid = $row['book_id'];
	$tid = $row['topic_id'];
	$kr_w = $row['kr_w'];

	// $check_query = "SELECT * FROM krbook WHERE book_id='$bid' AND topic_id='$tid'";
	// $check = mysqli_query($new_con, $check_query);
	// if ($crow = mysqli_fetch_assoc($check)) {
	// 	$bookid = $crow['id'];
	// 	$result_query = "SELECT * FROM kr_words WHERE name='$kr_w'";
	// 	$result = mysqli_query($new_con, $result_query);
	// 	if (mysqli_num_rows($result) > 0) {
	// 		echo 'exist';
	// 	} else {
	// 		$insert_query = "INSERT INTO kr_words(name, krbook_id, aimag_id) VALUES ('$kr_w','$bookid', '1')";
	// 		if (mysqli_query($new_con, $insert_query)) {
	// 			echo 'Okey<br/>';
	// 		} else {
	// 			echo 'null<br/>';
	// 		}
	// 	}
	// }
}

?>
