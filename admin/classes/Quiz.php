<?php
/**
 * Quiz Class
 */
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../config/Database.php');
include_once($filepath.'/../config/Format.php');
class Quiz {
	private $db;
	private $fm;
	public function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function quizBook() {
		$query 	= "SELECT * FROM books ORDER BY kr_name ASC";
		$result = $this->db->select($query);
		return $result;
	}

	public function quizTopic($bookid) {
		$query 	= "
		SELECT t.* FROM books AS b 
		INNER JOIN krbook AS krb ON krb.book_id = b.id 
		INNER JOIN topics AS t ON krb.topic_id = t.id 
		WHERE b.id = '$bookid'
		";
		$result = $this->db->select($query);
		return $result;
	}

	public function quizProcess($bid, $tid, $quiz) {
		$query = "
SELECT kr.id AS krid, kr.kr_w AS kr_w, w.mn_word FROM books AS b 
INNER JOIN krbook AS krb ON krb.book_id = b.id 
INNER JOIN topics AS t ON krb.topic_id = t.id 
INNER JOIN kr_words AS kr ON kr.krbook_id = krb.id 
INNER JOIN words AS w ON w.kr_word = kr.id 
INNER JOIN mn_words AS mn ON mn.id = w.mn_word 
WHERE b.id = '$bid' AND t.id = '$tid' ORDER BY rand() LIMIT 1
		";
		$result = $this->db->select($query);
		return $result;
	}

	public function checkProcess($bid, $tid, $krid, $mnid, $quiz) {
		$query = "
SELECT kr.id AS krid, kr.kr_w AS kr_w, w.mn_word, mn.mn_w FROM books AS b 
INNER JOIN krbook AS krb ON krb.book_id = b.id 
INNER JOIN topics AS t ON krb.topic_id = t.id 
INNER JOIN kr_words AS kr ON kr.krbook_id = krb.id 
INNER JOIN words AS w ON w.kr_word = kr.id 
INNER JOIN mn_words AS mn ON mn.id = w.mn_word 
WHERE b.id = '$bid' AND t.id = '$tid' AND kr.id = '$krid' AND mn.id = '$mnid'
		";
		$result = $this->db->query($query);

		if ($result->num_rows > 0) {
			$_SESSION['score']++;
		}
		$quiz++;
		if ($quiz > 20) {
			header('Location: quiz-book.php');
			exit();
		} else {
			header('Location: quiz-process.php?bid='.$bid.'&tid='.$tid.'&q='.$quiz);
		}
	}

	public function getCorrectAnswer($number) {
		$query = "
SELECT mn.* FROM words AS word
INNER JOIN kr_words AS kr ON kr.id = word.id
INNER JOIN mn_words AS mn ON mn.id = word.id
WHERE kr.id IN ($number) ORDER BY rand() LIMIT 1
		";
		$result = $this->db->select($query);
		return $result;
	}

	public function getWrongAnswer($number) {
		$query = "
SELECT mn.* FROM words AS word
INNER JOIN kr_words AS kr ON kr.id = word.id
INNER JOIN mn_words AS mn ON mn.id = word.id
WHERE kr.id NOT IN ($number) ORDER BY rand() LIMIT 1
		";
		$result = $this->db->select($query);
		return $result;
	}

	public function checkQuiz($kr, $mn) {
		$query = "SELECT * FROM test WHERE kr_name = '$kr' AND mn_name = '$mn'";
		$result = $this->db->select($query);
		return $result;
	}

	public function getTotalRows() {
		$query 	= "SELECT * FROM books ORDER BY id DESC";
		$getData = $this->db->select($query);
		$result = $getData->num_rows;
		return $result;
	}

	public function getBookTopics($number) {
		$query 	= "SELECT * FROM topics WHERE book_id='$number'";
		$result = $this->db->select($query);
		return $result;
	}
}

?>
