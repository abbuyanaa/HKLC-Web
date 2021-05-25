<?php
/**
 * Topic Class
 */
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../config/Database.php');
include_once($filepath.'/../config/Format.php');
class Topic {
	private $db;
	private $fm;
	public function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}

	// kr_words.php
	public function getDropBookTopics($bookid) {
		$query 	= "
SELECT t.id, t.kr_name, t.mn_name FROM krbook AS kb 
INNER JOIN books AS b ON b.id = kb.book_id
INNER JOIN topics AS t ON t.id = kb.topic_id
WHERE b.id='$bookid'";
		$result = $this->db->select($query);
		return $result;
	}

	// bookview.php
	public function getBookViewTopics($bookid) {
		$query 	= "
SELECT t.id, t.kr_name, t.mn_name,
(
SELECT COUNT(*) FROM kr_words AS kr 
WHERE kr.krbook_id = kb.id
) AS word_count
FROM krbook AS kb
INNER JOIN books AS b ON b.id = kb.book_id
INNER JOIN topics AS t ON t.id = kb.topic_id
WHERE kb.book_id = '$bookid' ORDER BY t.id DESC
		";
		$result = $this->db->select($query);
		return $result;
	}

	// bookview.php
	public function checkBookTopic($bid, $text) {
		$query = "
SELECT * FROM krbook AS kb 
INNER JOIN books AS b ON b.id = kb.book_id
INNER JOIN topics AS t ON t.id = kb.topic_id
WHERE b.id = '$bid' AND t.kr_name  = '$text'
		";
		$result = $this->db->select($query);
		return $result;
	}
	public function getLastId() {
		$query = "SELECT id FROM topics ORDER BY id DESC LIMIT 1";
		$result = $this->db->select($query);
		$result = $result->fetch_assoc();
		return $result['id'];
	}
	public function insertTopic($bookid, $data) {
		$kr_name = $this->fm->validation($data['kr_name']);
		$mn_name = $this->fm->validation($data['mn_name']);
		$kr_name = mysqli_real_escape_string($this->db->con, $kr_name);
		$mn_name = mysqli_real_escape_string($this->db->con, $mn_name);

		if (empty($kr_name)) {
			$result = '<div class="alert alert-danger">Та мэдээллээ оруулна уу!</div>';
		} else {
			$result = $this->checkBookTopic($bookid, $kr_name);
			if ($result != false) {
				$result = '<div class="alert alert-danger">Бүртгэлтэй сэдэв байна!</div>';
			} else {
				$query = "INSERT INTO topics(kr_name, mn_name) VALUES ('$kr_name', '$mn_name')";
				$insert = $this->db->insert($query);
				if ($insert != false) {
					$lastid = $this->getLastId();
					$query = "INSERT INTO krbook(book_id, topic_id) VALUES ('$bookid','$lastid')";
					$result = $this->db->insert($query);
					if ($result != false) {
						$result = '<div class="alert alert-success">Сэдэв амжилттай нэмэгдлээ!</div>';
					}
				}
			}
		}
		$msg['msg'] = $result;
		return $msg;
	}

	// bookview.php
	public function getBookTopicEdit($number) {
		$query = "SELECT * FROM topics WHERE id='$number'";
		$result = $this->db->select($query);
		return $result;
	}

	// bookview.php
	public function updateTopic($topicid, $data) {
		$kr_name = $this->fm->validation($data['ekr_name']);
		$mn_name = $this->fm->validation($data['emn_name']);
		$kr_name = mysqli_real_escape_string($this->db->con, $kr_name);
		$mn_name = mysqli_real_escape_string($this->db->con, $mn_name);

		if (empty($kr_name)) {
			$result = '<div class="alert alert-danger">Та мэдээллээ оруулна уу!</div>';
		} else {
			$query = "UPDATE topics SET kr_name='$kr_name', mn_name='$mn_name' WHERE id='$topicid'";
			$update = $this->db->update($query);
			if ($update != false) {
				$result = '<div class="alert alert-success">Сэдэв амжилттай шинэчилэгдлээ!</div>';
			}
		}
		$msg['msg'] = $result;
		return $msg;
	}

	// public function deleteTopic($bookid, $topicid) {
	// 	$query = "DELETE FROM topics WHERE id='$topicid'";
	// 	$delete = $this->db->delete($query);
	// 	if ($delete != false) {
	// 		$result = '<div class="alert alert-success">Сэдэв амжилттай устгагдлаа.</div>';
	// 	} else {
	// 		$result = '<div class="alert alert-danger">Сэдэв устгах боломжгүй!</div>';
	// 	}
	// 	return $result;
	// }
}

?>
