<?php
/**
 * Exam Class
 */
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../config/Database.php');
include_once($filepath.'/../config/Format.php');
class Exam {
	private $db;
	private $fm;
	public function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function getQuiz($number) {
		$query 	= "SELECT * FROM `test` WHERE `id`='$number'";
		$result = $this->db->select($query);
		return $result;
	}

	public function getTotal($number) {
		$query 	= "SELECT * FROM `test` WHERE `id`='$number'";
		$result = $this->db->select($query);
		$total = $result->num_rows;
		return $total;
	}

	public function correctWord($number) {
		$query = "";
		$result = $this->db->update($query);
		return $result;
	}

	public function setQuiz($number) {
		$query 	= "SELECT * FROM `test` WHERE `id`='$number'";
		$result = $this->db->select($query);
		// if ($number < 10) {
		// 	header("Location: login.php");
		// } else {
		// 	$next = $number + 1;
		// 	header("Location: test.php?quiz=".$next);
		// }
		return $result;
	}
}

?>
