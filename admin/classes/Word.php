<?php
/**
 * Word Class
 */
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../config/Database.php');
include_once($filepath.'/../config/Format.php');
class Word {
	private $db;
	private $fm;

	public function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}

	// stats.php
	public function getTotalRow() {
		$query = "SELECT * FROM words";
		$result = $this->db->select($query);
		$result = $result->num_rows;
		return $result;
	}

	// wordlist.php
	public function getSelectWord($search) {
		$query = "
SELECT w.id AS wordid,
b.kr_name AS bkr_name, t.kr_name AS tkr_name,
bl.kr_name AS blkr_name, ai.kr_name AS ai_name,
kr.kr_w AS kr_w, mn.mn_w AS mn_w
FROM krbook AS kb 
INNER JOIN books AS b ON b.id = kb.book_id
INNER JOIN topics AS t ON t.id = kb.topic_id
INNER JOIN booklevel AS bl ON bl.id = b.level_id
INNER JOIN kr_words AS kr ON kr.krbook_id = kb.id
INNER JOIN words AS w ON w.kr_word = kr.id
INNER JOIN mn_words AS mn ON mn.id = w.mn_word
LEFT JOIN aimag AS ai ON ai.id = kr.aimag_id
WHERE CONCAT(b.kr_name, b.mn_name, t.kr_name, t.mn_name, kr.kr_w, mn.mn_w) LIKE '%$search%'
AND b.status = '0'
		";
		if ($search != '') {
			$query .= "ORDER BY kr.kr_w ASC LIMIT 50";
		} else {
			$query .= "ORDER BY w.id DESC LIMIT 20";
		}
		$result = $this->db->select($query);
		return $result;
	}

	// wordnemeh.php
	public function getBooks() {
		$query = "
		SELECT b.id, b.kr_name, b.mn_name, bl.kr_name AS blkr_name FROM books AS b 
		INNER JOIN booklevel AS bl ON bl.id = b.level_id
		-- ORDER BY b.kr_name ASC
		";
		$result = $this->db->select($query);
		return $result;
	}
	public function getLastId($table) {
		$query = "SELECT id FROM $table ORDER BY id DESC LIMIT 1";
		$result = $this->db->select($query);
		$result = $result->fetch_assoc();
		return $result['id'];
	}
	public function checkBook($bid, $tid) {
		$query = "SELECT id FROM krbook WHERE book_id='$bid' AND topic_id='$tid'";
		$result = $this->db->select($query);
		$result = $result->fetch_assoc();
		return $result['id'];
	}
	// New Korean Word Check get Insert or Last Id
	public function checkKrWord($bid, $text, $aimagid) {
		if ($bid == 0 && $aimagid == 0) {
			$check_query = "SELECT id FROM kr_words WHERE kr_w='$text' AND krbook_id IS NULL AND aimag_id IS NULL";
			$check = $this->db->select($check_query);
			if ($check != false) {
				$row = $check->fetch_assoc();
				$result = $row['id'];
			} else {
				$query = "INSERT INTO kr_words(kr_w) VALUES ('$text')";
				$check_query = $this->db->insert($query);
				if ($check_query != false) {
					$result = $this->getLastId("kr_words");
				}
			}
		} else if ($bid == 0) {
			$check_query = "SELECT id FROM kr_words WHERE kr_w='$text' AND krbook_id IS NULL AND aimag_id='$aimagid'";
			$check = $this->db->select($check_query);
			if ($check != false) {
				$row = $check->fetch_assoc();
				$result = $row['id'];
			} else {
				$query = "INSERT INTO kr_words(kr_w, aimag_id) VALUES ('$text','$aimagid')";
				$check_query = $this->db->insert($query);
				if ($check_query != false) {
					$result = $this->getLastId("kr_words");
				}
			}
		} else if ($aimagid == 0) {
			$check_query = "SELECT id FROM kr_words WHERE kr_w='$text' AND krbook_id='$bid' AND aimag_id IS NULL";
			$check = $this->db->select($check_query);
			if ($check != false) {
				$row = $check->fetch_assoc();
				$result = $row['id'];
			} else {
				$query = "INSERT INTO kr_words(kr_w, krbook_id) VALUES ('$text','$bid')";
				$check_query = $this->db->insert($query);
				if ($check_query != false) {
					$result = $this->getLastId("kr_words");
				}
			}
		} else {
			$check_query = "SELECT id FROM kr_words WHERE kr_w='$text' AND krbook_id='$bid' AND aimag_id='$aimagid'";
			$check = $this->db->select($check_query);
			if ($check != false) {
				$row = $check->fetch_assoc();
				$result = $row['id'];
			} else {
				$query = "INSERT INTO kr_words(kr_w, krbook_id, aimag_id) VALUES ('$text','$bid','$aimagid')";
				$check_query = $this->db->insert($query);
				if ($check_query != false) {
					$result = $this->getLastId("kr_words");
				}
			}
		}
		return $result;
	}
	public function checkMnWord($text) {
		$check_query = "SELECT * FROM mn_words WHERE mn_w='$text'";
		$check = $this->db->select($check_query);
		if ($check != false) {
			$row = $check->fetch_assoc();
			$result = $row['id'];
		} else {
			$mninsert_query = "INSERT INTO mn_words(mn_w) VALUES ('$text')";
			$mninsert = $this->db->insert($mninsert_query);
			if ($mninsert != false) {
				$result = $this->getLastId('mn_words');
			}
		}
		return $result;
	}
	public function checkWord($krid, $mnid) {
		$check_query = "SELECT id FROM words WHERE kr_word='$krid' AND mn_word='$mnid'";
		$check = $this->db->select($check_query);
		if ($check != false) {
			$row = $check->fetch_assoc();
			$result = $row['id'];
		} else {
			$insert_query = "INSERT INTO words(kr_word, mn_word) VALUES ('$krid','$mnid')";
			$result = $this->db->insert($insert_query);
			if ($result != false) {
				$result = $this->getWordId('words');
			}
		}
		return $result;
	}

	public function insertWord($data) {
		$bookid = $data['book'];
		$topicid = $data['topic'];
		$aimagid = $data['aimag'];
		$kr_name = $this->fm->validation($data['kr_w']);
		$kr_name = mysqli_real_escape_string($this->db->con, $kr_name);
		$mn_name = $this->fm->validation($data['mn_w']);
		$mn_name = mysqli_real_escape_string($this->db->con, mb_strtolower($mn_name));

		if ($kr_name == '' || $mn_name == '') {
			$result = '<div class="alert alert-danger">Та мэдээллээ гүйцэт оруулна уу!</div>';
		} else {
			if ($bookid != 0) {
				$book_id = $this->checkBook($bookid, $topicid);
				if ($bookid) {
					$getKrId = $this->checkKrWord($book_id, $kr_name, $aimagid);
				}
			} else {
				$getKrId = $this->checkKrWord(0, $kr_name, $aimagid);
			}
			$getMnId = $this->checkMnWord($mn_name);

			$check_query = "SELECT * FROM words WHERE kr_word='$getKrId' AND mn_word='$getMnId'";
			$check = $this->db->select($check_query);
			if ($check != false) {
				$result = '<div class="alert alert-danger">Бүртгэлтэй үг байна!</div>';
			} else {
				$insert_query = "INSERT INTO words(kr_word, mn_word) VALUES ('$getKrId','$getMnId')";
				$insert_data = $this->db->insert($insert_query);
				if ($insert_data != false) {
					$getWordId = $this->getLastId('words');
					foreach ($data['sentences'] as $key => $value) {
						$sentences = $this->fm->validation($value);
						$sentences = mysqli_real_escape_string($this->db->con, $sentences);
						if (trim($sentences != '')) {
							$query = "SELECT * FROM sentences WHERE word_id = '$getWordId' AND sentences = '$sentences'";
							$check = $this->db->select($query);
							if ($check == false) {
								$query = "INSERT INTO sentences(sentences, word_id) VALUES ('$sentences', '$getWordId')";
								$this->db->insert($query);
							}
						}
					}
					$result = '<div class="alert alert-success">Шинэ үг амжилттай нэмэгдлээ.</div>';
				}
			}
		}
		$msg['msg'] = $result;
		$msg['kr_name'] = $kr_name;
		$msg['mn_name'] = $mn_name;
		return $msg;
	}


	// wordzasah.php
	public function getWordData($wordid) {
		$query 	= "
SELECT w.id AS wordid, kr.kr_w, mn.mn_w, kb.book_id, kb.topic_id, kr.aimag_id
FROM krbook AS kb 
INNER JOIN kr_words AS kr ON kr.krbook_id = kb.id
INNER JOIN words AS w ON w.kr_word = kr.id
INNER JOIN mn_words AS mn ON mn.id = w.mn_word
WHERE w.id = '$wordid'
		";
		$result = $this->db->select($query);
		return $result;
	}

	public function updateWord($data, $word_id) {
		$bookid = $data['ebook'];
		$topicid = $data['etopic'];
		$aimagid = $data['eaimag'];
		$kr_name = $this->fm->validation($data['ekr_w']);
		$kr_name = mysqli_real_escape_string($this->db->con, $kr_name);
		$mn_name = $this->fm->validation($data['emn_w']);
		$mn_name = mysqli_real_escape_string($this->db->con, $mn_name);

		if ($kr_name == '' || $mn_name == '') {
			$result = '<div class="alert alert-danger">Та мэдээллээ гүйцэт оруулна уу!</div>';
		} else {
			if ($bookid != 0) {
				$book_id = $this->checkBook($bookid, $topicid);
				if ($bookid) {
					$getKrId = $this->checkKrWord($book_id, $kr_name, $aimagid);
				}
			} else {
				$getKrId = $this->checkKrWord(0, $kr_name, $aimagid);
			}
			$getMnId = $this->checkMnWord($mn_name);

			$update_query = "UPDATE words SET kr_word='$getKrId', mn_word='$getMnId' WHERE id='$word_id'";
			$data = $this->db->insert($update_query);
			if ($data != false) {
				$result = '<div class="alert alert-success">Шинэ үг амжилттай шинэчилэгдлээ.</div>';
			}
		}
		$message['msg'] = $result;
		return $message;
	}

	// wordzasah.php
	public function getWordSentences($wordid) {
		$query 	= "SELECT * FROM sentences WHERE word_id = '$wordid'";
		$result = $this->db->select($query);
		return $result;
	}
	public function checkSen($wordid) {
		$query 	= "SELECT * FROM sentences WHERE id = '$wordid'";
		$result = $this->db->select($query);
		return $result;
	}
	public function deleteSen($wordid) {
		$query = "DELETE FROM sentences WHERE id = '$wordid'";
		$result = $this->db->delete($query);
		return $result;
	}

	public function insertSen($data, $wordid) {
		if ($data['sentences'][0] != '') {
			foreach ($data['sentences'] as $key => $value) {
				$sentences = $this->fm->validation($value);
				$sentences = mysqli_real_escape_string($this->db->con, $sentences);
				if (trim($sentences != '')) {
					$query = "SELECT * FROM sentences WHERE word_id = '$wordid' AND sentences = '$sentences'";
					$check = $this->db->select($query);
					if ($check == false) {
						$query = "INSERT INTO sentences(word_id, sentences) VALUES ('$wordid', '$sentences')";
						$insert = $this->db->insert($query);
					}
				}
			}
			$result = '<div class="alert alert-success">Жишээ өгүүлбэр амжилттай нэмэгдлээ.</div>';
		}
		return $result;
	}

	// public function deleteWord($wordid) {
	// 	$query = "SELECT * FROM words WHERE id = ".$wordid;
	// 	$result = $this->db->select($query);
	// 	if ($result == false) {
	// 		$message['msg'] = 'false';
	// 	} else {
	// 		$row = $result->fetch_assoc();
	// 		$query = "DELETE FROM sentences WHERE word_id = ".$row['id'];
	// 		$result = $this->db->delete($query);
	// 		if ($result != false) {
	// 			$query = "DELETE FROM words WHERE id = ".$wordid;
	// 			$result = $this->db->delete($query);
	// 			if ($result != false) {
	// 				$query = "DELETE FROM mn_words WHERE id = ".$row['mn_id'];
	// 				$result = $this->db->delete($query);
	// 				if ($result != false) {
	// 					$query = "DELETE FROM kr_words WHERE id = ".$row['kr_id'];
	// 					$result = $this->db->delete($query);
	// 					if ($result != false) {
	// 						$message['msg'] = '<div class="alert alert-success">Мэдээлэл амжилттай устгагдлаа.</div>';
	// 					}
	// 				}
	// 			}
	// 		}
	// 	}
	// 	return $message;
	// }
}

?>
