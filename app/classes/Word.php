<?php
/**
 * Word Class
 */
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../config/Database.php');
include_once($filepath.'/Format.php');
class Word {
	private $db;
	private $fm;

	public function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function RandomWord() {
		$query = "
		SELECT w.id, kr.kr_w, mn.mn_w FROM words AS w 
		INNER JOIN kr_words AS kr ON kr.id = w.kr_id
		INNER JOIN mn_words AS mn ON mn.id = w.mn_id
		ORDER BY rand() LIMIT 5
		";
		$result = $this->db->select($query);
		return $result;
	}
}

?>
