<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../config/Database.php');
$db = new Database();

if (isset($_GET['bid']) && isset($_GET['tid']) && isset($_GET['q'])) {
	$bid = $_GET['bid'];
	$tid = $_GET['tid'];
	$q = $_GET['q'];
	$query = "
SELECT kr.id, kr.kr_w FROM books AS b 
INNER JOIN krbook AS krb ON krb.book_id = b.id 
INNER JOIN topics AS t ON krb.topic_id = t.id 
INNER JOIN kr_words AS kr ON kr.krbook_id = krb.id 
WHERE b.id = '$bid' AND t.id = '$tid' ORDER BY rand() LIMIT 1
	";
	$random = rand(1,4);
	$getData = $db->select($query);
	$json = array();
	if ($getData != false) {
		if ($row = $getData->fetch_assoc()) {
			$json[] = $row;
			for ($i = 1; $i < 5; $i++) {
				if ($random == $i) {
					$query = "
					SELECT mn.id, mn.mn_w FROM words AS w 
					INNER JOIN kr_words AS kr ON kr.id = w.kr_word 
					INNER JOIN mn_words AS mn ON mn.id = w.mn_word 
					WHERE kr.id = '".$row['id']."'
					";
					$result = $db->select($query);
					if ($result != false) {
						if ($crow = $result->fetch_assoc()) {
							$answer['id'] = $crow['id'];
							$answer['mn_w'] = $crow['mn_w'];
							$answer['answer'] = true;
							$json[]['mn_word'.$i] = $answer;
						}
					}
				} else {
					$query = "
					SELECT mn.id, mn.mn_w FROM words AS w 
					INNER JOIN kr_words AS kr ON kr.id = w.kr_word 
					INNER JOIN mn_words AS mn ON mn.id = w.mn_word 
					WHERE kr.id NOT IN ('".$row['id']."') ORDER BY rand() LIMIT 1
					";
					$result = $db->select($query);
					if ($result != false) {
						if ($crow = $result->fetch_assoc()) {
							$answer['id'] = $crow['id'];
							$answer['mn_w'] = $crow['mn_w'];
							$answer['answer'] = false;
							$json[]['mn_word'.$i] = $answer;
						}
					}
				}
			}
		}
		echo json_encode($json, JSON_UNESCAPED_UNICODE);
	} else {
		echo json_encode(["msg"=>"Not Available"]);
	}
}

?>
