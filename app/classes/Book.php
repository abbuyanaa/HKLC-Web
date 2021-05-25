<?php
/**
 * Book Class
 */
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../config/Database.php');
include_once($filepath.'/Format.php');
class Book {
	private $db;
	private $fm;
	public function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function getAllBooks() {
		$query 	= "
SELECT b.id, b.kr_name, b.mn_name, b.image, bl.kr_name AS blkr_name FROM books AS b 
INNER JOIN booklevel AS bl ON bl.id = b.level_id
		";
		$result = $this->db->select($query);
		return $result;
	}
}

?>
