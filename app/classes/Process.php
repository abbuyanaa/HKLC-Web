<?php
/**
 * Process Class
 */
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../config/Database.php');
include_once($filepath.'/Format.php');
class Process {
	private $db;
	private $fm;
	public function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function getQuiz($number) {
		$query 	= "SELECT * FROM books ORDER BY id ASC";
		$result = $this->db->select($query);
		return $result;
	}

	public function getCorrectAnswer($number) {
		$query = "
		SELECT word.id, kr.name, mn.name FROM words AS word
		INNER JOIN kr_words AS kr ON kr.id = word.id
		INNER JOIN mn_words AS mn ON mn.id = word.id
		WHERE word.id NOT IN ($number) ORDER BY rand()
		LIMIT 1
		";
		$result = $this->db->select($query);
		return $result;
	}

	public function getRandomWrongAnswer($number) {
		$query = "
		SELECT word.id, kr.name, mn.name FROM words AS word
		INNER JOIN kr_words AS kr ON kr.id = word.id
		INNER JOIN mn_words AS mn ON mn.id = word.id
		WHERE word.id NOT IN ($number) ORDER BY rand()
		LIMIT 1
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
