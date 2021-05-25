<?php
/**
 * Dictionary Class
 */
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../config/Database.php');
include_once($filepath.'/Format.php');
class Dictionary {
	private $db;
	private $fm;
	public function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function getDictionary($text) {
		$query 	= "
		SELECT kr.id, kr.kr_w,
		(
		SELECT SUBSTR(GROUP_CONCAT(DISTINCT mn.mn_w SEPARATOR ', '), 1, 20) 
		FROM mn_words AS mn
		INNER JOIN words AS word ON word.mn_id = mn.id
		WHERE word.kr_id = kr.id
		) AS mn_w
		FROM kr_words AS kr
		ORDER BY kr.kr_w ASC LIMIT 100
		";
		$result = $this->db->select($query);
		return $result;
	}
}

// SELECT kr.id AS word_id, kr.kr_w, mn.mn_w
// FROM kr_words AS kr
// INNER JOIN words AS w ON w.kr_id = kr.id
// INNER JOIN mn_words AS mn ON mn.id = w.mn_id
// ORDER BY kr.kr_w ASC LIMIT 10

// SELECT kr.id, kr.kr_w,
// (
// SELECT GROUP_CONCAT(DISTINCT mn.mn_w SEPARATOR ', ') 
// FROM mn_words AS mn
// INNER JOIN words AS word ON word.mn_id = mn.id
// WHERE word.kr_id = kr.id
// ) AS mn_w
// FROM kr_words AS kr
// ORDER BY kr.kr_w ASC LIMIT 100

?>
