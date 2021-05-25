<?php
/**
 * Learning Class
 */
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../config/Database.php');
include_once($filepath.'/Format.php');
class Learning {
	private $db;
	private $fm;
	public function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}

	// getBooks.php
	public function getAllBooks() {
		$query 	= "SELECT * FROM books ORDER BY id DESC";
		$result = $this->db->select($query);
		return $result;
	}
	// getTopics.php
	public function getBookTopics($bookid) {
		$query 	= "SELECT * FROM topics WHERE book_id='$bookid'";
		$result = $this->db->select($query);
		return $result;
	}

	// getWordView.php
	public function getWordView($tid) {
		$query = "
SELECT kr.id AS word_id, kr.kr_w,
(
SELECT GROUP_CONCAT(DISTINCT mn.mn_w SEPARATOR ', ') FROM words AS wd 
INNER JOIN mn_words AS mn ON mn.id = wd.mn_word 
WHERE wd.kr_word = kr.id
) AS mn_w, ai.kr_name AS aikr_name
FROM kr_words AS kr
INNER JOIN krbook AS krb ON krb.id = kr.krbook_id 
INNER JOIN topics AS t ON t.id = krb.topic_id 
INNER JOIN aimag AS ai ON ai.id = kr.aimag_id 
WHERE t.id = '$tid' 
ORDER BY kr.kr_w ASC 
		";
		$result = $this->db->select($query);
		return $result;
	}

	public function getWordSen($wordid) {
		$query = "
SELECT sen.sentences FROM words AS w 
INNER JOIN mn_words AS mn ON mn.id = w.mn_id
INNER JOIN sentences AS sen ON sen.word_id = w.id
WHERE w.id = '$wordid'
		";
		$result = $this->db->select($query);
		return $result;
	}
}

?>
