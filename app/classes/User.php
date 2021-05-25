<?php
/**
 * User Class
 */
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../config/Database.php');
include_once($filepath.'/Format.php');
class User {
	private $db;
	private $fm;
	public function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function getLogin($email, $pass) {
		$email 		= $this->fm->validation($email);
		$password 	= $this->fm->validation($pass);
		$email 		= mysqli_real_escape_string($this->db->con, $email);
		$password 	= mysqli_real_escape_string($this->db->con, md5($password));

		$query = "SELECT * FROM users WHERE email = '$email' AND password='$password'";
		$result = $this->db->select($query);
		if ($result != false) {
			$value = $result->fetch_assoc();
			if ($value['verified'] == 1) {
				$msg = 'success';
			} else {
				$msg = 'inactive';
			}
		} else {
			$msg = 'Цахим хаяг эсвэл Нууц үг буруу байна!';
		}
		return $msg;
	}

	public function getRegister($email, $password) {
		$email 		= $this->fm->validation($email);
		$password 	= $this->fm->validation($password);
		$email 		= mysqli_real_escape_string($this->db->con, $email);
		$password 	= mysqli_real_escape_string($this->db->con, md5($password));

		if ($email == '' || $password == '') {
			$msg = 'null';
		} else {
			$check_query = "SELECT * FROM users WHERE email = '$email'";
			$check = $this->db->select($check_query);
			if ($check != false) {
				$msg = 'exist';
			} else {
				$insert_query = "INSERT INTO users(email, password) VALUES ($email, $password)";
				$result = $this->db->insert($insert_query);
				if ($result =! false) {
					$msg = 'success';
				}
			}
			return $msg;
		}
	}
}

?>
