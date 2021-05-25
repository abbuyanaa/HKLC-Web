<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/Session.php');
include_once($filepath . '/../config/Database.php');
include_once($filepath . '/../config/Format.php');

/**
 * User Class
 */
class User {
	private $db;
	private $fm;
	public function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}

	// stats.php
	public function getTotalRow() {
		$query = "SELECT * FROM users WHERE type = 'user'";
		$result = $this->db->select($query);
		$result = $result->num_rows;
		return $result;
	}

	public function getAllUsers() {
		$query = "SELECT * FROM users WHERE type='user' ORDER BY id DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function getLogin($data) {
		$email 		= $this->fm->validation($data['email']);
		$password 	= $this->fm->validation($data['password']);
		$email 		= mysqli_real_escape_string($this->db->con, $email);
		$password 	= mysqli_real_escape_string($this->db->con, md5($password));

		$query = "SELECT * FROM users WHERE email = '$email' AND password='$password'";
		$result = $this->db->select($query);
		if ($result != false) {
			$value = $result->fetch_assoc();
			if ($value['verified'] == 1) {
				Session::init();
				Session::set("login", true);
				Session::set("userId", $value['id']);
				Session::set("userType", $value['type']);
				Session::set("userImage", $value['profile']);
				header("Location:index.php");
			} else {
				$message = '<div class="alert alert-danger">Та хаягаа идэвхижүүлнэ үү!</div>';
				return $message;
			}
		} else {
			$message = '<div class="alert alert-danger">Цахим хаяг эсвэл Нууц үг буруу байна!</div>';
			return $message;
		}
	}

	public function checkUser($userid) {
		$query = "SELECT * FROM users WHERE id = '$userid'";
		$result = $this->db->select($query);
		return $result;
	}

	public function userStatus($userid, $status) {
		$data = $this->checkUser($userid);
		if ($data == false) {
			$result = header('Location: users.php');
		} else {
			$update_query = "UPDATE users SET status='$status' WHERE id='$userid'";
			$update_result = $this->db->update($update_query);
			if ($update_result != false) {
				$result = '<div class="alert alert-success">Мэдээлэл амжилттай шинэчилэгдлээ!</div>';
			}
		}
		return $result;
	}
}
?>
