<?php
/**
 * Topic Class
 */
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../config/Database.php');
include_once($filepath.'/Format.php');
class Topic {
	private $db;
	private $fm;
	public function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function getBookTopics($bookid) {
		$query 	= "SELECT * FROM topics WHERE book_id='$bookid'";
		$result = $this->db->select($query);
		return $result;
	}
}

?>
