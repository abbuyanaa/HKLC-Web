<?php
/**
 * Book Class
 */
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../config/Database.php');
include_once($filepath.'/../config/Format.php');
class Book {
	private $db;
	private $fm;
	public function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}

	// books.php
	public function getAllBooks($search) {
		$query 	= "
		SELECT * FROM books 
		WHERE CONCAT(kr_name, mn_name) LIKE '%$search%'
		ORDER BY id DESC LIMIT 10
		";
		$result = $this->db->select($query);
		return $result;
	}
	// index.php
	public function getBookTotalRow() {
		$query = "SELECT * FROM books";
		$result = $this->db->select($query);
		$result = $result->num_rows;
		return $result;
	}
	// bookadd.php
	public function getLevel() {
		$query = "SELECT * FROM booklevel";
		$result = $this->db->select($query);
		return $result;
	}

	// bookadd.php
	public function insertBook($data, $file) {
		$path = 'images/files/';
		$kr_name = $this->fm->validation($data['kr_name']);
		$mn_name = $this->fm->validation($data['mn_name']);
		$kr_name = mysqli_real_escape_string($this->db->con, $kr_name);
		$mn_name = mysqli_real_escape_string($this->db->con, $mn_name);
		$levelid = $data['levelid'];

		$permited 		= array('jpg', 'jpeg', 'png', 'gif');
		$file_name 		= $file['image']['name'];
		$file_size 		= $file['image']['size'];
		$file_temp 		= $file['image']['tmp_name'];
		$div 			= explode('.', $file_name);
		$file_ext 		= strtolower(end($div));
		$unique_image 	= $path.date('Y_m_d').'_'.substr(md5(time()), 0, 10).'.'.$file_ext;

		if ($kr_name == '' || $mn_name == '' || $file_name == '') {
			$result = '<div class="alert alert-danger">Та мэдээллээ оруулна уу!</div>';
		} else if ($file_ext > 1048576) {
			$result = '<div class="alert alert-danger">Таны сонгосон файлын хэмжээ 1MB-ээс их байна!</div>';
		} else if (in_array($file_ext, $permited) === false) {
			$result = '<div class="alert alert-danger">Таны сонгосон файлын өргөтгөл таарахгүй байна:- '.implode(', ', $permited).'</div>';
		} else {
			$query = "SELECT * FROM books WHERE kr_name = '$kr_name'";
			$check = $this->db->select($query);
			if ($check != false) {
				$result = '<div class="alert alert-danger">Бүртгэлтэй ном байна!</div>';
			} else {
				$query = "INSERT INTO books(kr_name, mn_name, image) VALUES ('$kr_name','$mn_name','$unique_image')";
				$result = $this->db->insert($query);
				if ($result != false) {
					if (move_uploaded_file($file_temp, '../'.$unique_image)) {
						$result = '<div class="alert alert-success">Амжилттай ном нэмэгдлээ.</div>';
					} else {
						$result = '<div class="alert alert-danger">Зураг байршуулахад алдаа гарлаа!</div>';
					}
				}
			}
		}
		$msg['msg'] = $result;
		$msg['image'] = $unique_image;
		$msg['kr_name'] = $kr_name;
		$msg['mn_name'] = $mn_name;
		$msg['levelid'] = $levelid;
		return $msg;
	}

	// bookview.php
	public function getBookView($bookid) {
		$query = "
SELECT b.*, bl.kr_name AS lkr_name, bl.mn_name AS lmn_name FROM books AS b 
INNER JOIN booklevel AS bl ON bl.id = b.level_id WHERE b.id = '$bookid'
		";
		$result = $this->db->select($query);
		return $result;
	}

	// bookedit.php
	public function updateBook($data, $file, $delimage, $bookid) {
		$path = 'images/files/';
		$kr_name = $this->fm->validation($data['ekr_name']);
		$mn_name = $this->fm->validation($data['emn_name']);
		$kr_name = mysqli_real_escape_string($this->db->con, $kr_name);
		$mn_name = mysqli_real_escape_string($this->db->con, $mn_name);
		$file_name = $file['eimage']['name'];
		$levelid = $data['elevelid'];

		if (empty($kr_name) or empty($mn_name)) {
			$result = 'Fields Empty';
		} else {
			if (!empty($file_name)) {
				$permited 		= array('jpg', 'jpeg', 'png', 'gif');
				$file_size 		= $file['eimage']['size'];
				$file_temp 		= $file['eimage']['tmp_name'];
				$div 			= explode('.', $file_name);
				$file_ext 		= strtolower(end($div));
				$unique_image 	= $path.date('Y_m_d').'_'.substr(md5(time()), 0, 10).'.'.$file_ext;

				if ($file_ext > 1048576) {
					$result = '<div class="alert alert-danger">Таны сонгосон файлын хэмжээ 1MB-ээс их байна!</div>';
				} else if (in_array($file_ext, $permited) === false) {
					$result = '<div class="alert alert-danger">Таны сонгосон файлын өргөтгөл таарахгүй байна:- '.implode(', ', $permited).'</div>';
				} else {
					$query = "UPDATE books SET kr_name = '$kr_name', mn_name = '$mn_name', level_id='$levelid', image = '$unique_image' WHERE id = '$bookid'";
					$update = $this->db->update($query);
					if ($update != false) {
						if (move_uploaded_file($file_temp, '../'.$unique_image)) {
							$message['image'] = $unique_image;
							if ($delimage != '') {
								if (file_exists('../'.$delimage)) {
									unlink('../'.$delimage);
								}
							}
							$result = '<div class="alert alert-success">Амжилттай ном шинэчилэгдлээ.</div>';
						} else {
							$result = '<div class="alert alert-danger">Зураг хуулахад алдаа гарлаа.</div>';
						}
					}
				}
			} else {
				$query = "UPDATE books SET kr_name='$kr_name',mn_name='$mn_name',level_id='$levelid' WHERE id='$bookid'";
				$update = $this->db->update($query);
				if ($update != false) {
					$result = '<div class="alert alert-success">Амжилттай ном шинэчилэгдлээ.</div>';
					$message['image'] = $file_name;
				} else {
					$result = '<div class="alert alert-danger">Ном шинэчилэхэд алдаа гарлаа.</div>';
				}
			}
			$message['msg'] = $result;
			$message['kr_name'] = $kr_name;
			$message['mn_name'] = $mn_name;
			$message['levelid'] = $levelid;
		}
		return $message;
	}

	public function statusBook($bid, $status) {
		$query = "UPDATE books SET status='$status' WHERE id='$bid'";
		$result = $this->db->update($query);
		if ($result != false) {
			$msg = header('Location: book-list.php');
			// $msg = '<div class="alert alert-success">Амжилттай ном шинэчилэгдлээ.</div>';
		} else {
			$msg = '<div class="alert alert-danger">Ном шинэчилэхэд алдаа гарлаа.</div>';
		}
		return $msg;
	}
}

?>
