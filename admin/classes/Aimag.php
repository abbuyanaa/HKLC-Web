<?php
/**
 * Aimag Class
 */
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../config/Database.php');
include_once($filepath.'/../config/Format.php');
class Aimag {
	private $db;
	private $fm;
	public function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}

	// aimag.php
	public function getAllAimag() {
		$query = "
		SELECT ai.*,
		(
		SELECT COUNT(*)
		FROM kr_words AS kr
		WHERE kr.aimag_id = ai.id
		) AS word_count
		FROM aimag AS ai
		ORDER BY ai.id DESC
		";
		$result = $this->db->select($query);
		return $result;
	}

	// aimag.php
	public function getAimag($aimagid) {
		$query = "SELECT * FROM aimag WHERE id = '$aimagid'";
		$result = $this->db->select($query);
		return $result;
	}

	public function insertAimag($data) {
		$kr_name = $this->fm->validation($data['kr_name']);
		$mn_name = $this->fm->validation($data['mn_name']);
		$kr_name = mysqli_real_escape_string($this->db->con, $kr_name);
		$mn_name = mysqli_real_escape_string($this->db->con, $mn_name);
		if (empty($kr_name)) {
			$result = '<div class="alert alert-danger">Та мэдээллээ оруулна уу!</div>';
		} else {
			$query = "SELECT * FROM aimag WHERE kr_name = '$kr_name'";
			$check = $this->db->select($query);
			if ($check != false) {
				$result = '<div class="alert alert-danger">Мэдээлэл давхцаж байна!</div>';
			} else {
				$query = "INSERT INTO aimag(kr_name, mn_name) VALUES ('$kr_name', '$mn_name')";
				$result = $this->db->insert($query);
				if ($result != false) {
					$result = '<div class="alert alert-success">Мэдээлэл амжилттай нэмэгдлээ.</div>';
				}
			}
		}
		return $result;
	}

	public function updateAimag($aimagid, $data) {
		$kr_name = $this->fm->validation($data['ekr_name']);
		$mn_name = $this->fm->validation($data['emn_name']);
		$kr_name = mysqli_real_escape_string($this->db->con, $kr_name);
		$mn_name = mysqli_real_escape_string($this->db->con, $mn_name);
		if (empty($kr_name)) {
			$result = '<div class="alert alert-danger">Та мэдээллээ оруулна уу!</div>';
		} else {
			$query = "UPDATE aimag SET kr_name = '$kr_name', mn_name = '$mn_name' WHERE id = '$aimagid'";
			$result = $this->db->update($query);
			if ($result != false) {
				$result = '<div class="alert alert-success">Мэдээлэл амжилттай шинэчилэгдлээ.</div>';
			}
		}
		return $result;
	}

	public function deleteAimag($aimagid) {
		$query = "DELETE FROM aimag WHERE id = '$aimagid'";
		$result = $this->db->delete($query);
		if ($result != false) {
			$result = '<div class="alert alert-success">Мэдээлэл амжилттай устгагдлаа.</div>';
		} else {
			$result = '<div class="alert alert-danger">Мэдээлэл устгах боломжгүй!</div>';
		}
		return $result;
	}
}
?>
