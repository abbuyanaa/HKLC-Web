<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/classes/Topic.php');
$topic = new Topic();
if (!empty($_POST['bookid'])) {
	$getTopic = $topic->getDropBookTopics($_POST['bookid']);
	if ($getTopic != false) {
		while ($row = $getTopic->fetch_assoc()) {
			echo '<option value='.$row['id'].'>'.$row['kr_name'].' - '.$row['mn_name'].'</option>';
		}
	} else {
		echo '<option value="0">Сэдэв байхгүй байна!</option>';
	}
}
?>
