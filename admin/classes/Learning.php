<?php
/**
 * Learning Class
 */
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../config/Database.php');
include_once($filepath.'/../config/Format.php');
class Learning {
	private $db;
	private $fm;
	public function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}

	// lesson.php
	public function getLessonBooks() {
		$query 	= "SELECT * FROM books";
		$result = $this->db->select($query);
		return $result;
	}
	// lessontopics.php
	public function getLessonTopics($bookid) {
		$query 	= "
		SELECT b.id AS bid, t.id AS tid, t.kr_name, t.mn_name,
		(
		SELECT COUNT(*) FROM kr_words AS kr
		WHERE kr.topic_id = t.id
		) AS word_count
		FROM books AS b 
		INNER JOIN topics AS t ON t.book_id = b.id
		WHERE b.id = $bookid
		";
		$result = $this->db->select($query);
		return $result;
	}


	// lessonlevel.php
	public function getLessonLevel() {
		$query 	= "SELECT * FROM word_level";
		$result = $this->db->select($query);
		return $result;
	}
	public function getLevelWordTotalRows($bid, $tid, $level) {
		$query 	= "
SELECT * FROM words AS w 
INNER JOIN kr_words AS kr ON kr.id = w.kr_id
WHERE kr.book_id = '$bid' AND kr.topic_id = '$tid' AND w.level_id = '$level'
		";
		$result = $this->db->select($query);
		if ($result != false) {
			$result = $result->num_rows;
		} else {
			$result = 0;
		}
		return $result;
	}

	// lessonwords.php
	public function getLearningWords($bid, $tid, $level) {
		$query = "
SELECT DISTINCT kr.id AS wordid, kr.kr_w,
(
SELECT GROUP_CONCAT(DISTINCT mn.mn_w SEPARATOR ', ') FROM words AS ws
INNER JOIN mn_words AS mn ON mn.id = ws.mn_id
WHERE ws.kr_id = kr.id
) AS mn_w
FROM words AS w 
INNER JOIN kr_words AS kr ON kr.id = w.kr_id
WHERE kr.book_id = '$bid' AND kr.topic_id = '$tid' AND w.level_id = '$level'
		";
		$result = $this->db->select($query);
		return $result;
	}

	public function getLearningWordView($bid, $tid, $level, $wordid) {
		$query = "
SELECT DISTINCT kr.id AS wordid, kr.book_id, kr.topic_id, kr.aimag_id, w.level_id, kr.kr_w,
(
SELECT GROUP_CONCAT(DISTINCT mn.mn_w SEPARATOR ', ') FROM words AS ws
INNER JOIN mn_words AS mn ON mn.id = ws.mn_id
WHERE ws.kr_id = kr.id
) AS mn_w
FROM words AS w 
INNER JOIN kr_words AS kr ON kr.id = w.kr_id
WHERE kr.book_id = '$bid' AND kr.topic_id = '$tid' AND w.level_id = '$level' AND w.kr_id = '$wordid'
		";
		$result = $this->db->select($query);
		return $result;
	}
}

?>
