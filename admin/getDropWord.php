<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/classes/Word.php');
$word = new Word();
if (!empty($_POST['wordid'])) {
	$getWord = $word->getTopicWord($_POST['wordid']);
	if ($getWord != false) {
		echo '<option value="0">Үг сонгох</option>';
		while ($row = $getWord->fetch_assoc()) {
			echo '<option value='.$row['id'].'>'.$row['kr_w'].'</option>';
		}
	} else {
		echo '<option value="0">Үг байхгүй байна!</option>';
	}
}
?>
