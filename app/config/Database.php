<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/config.php');
class Database {
	public $host   = DB_HOST;
	public $user   = DB_USER;
	public $pass   = DB_PASS;
	public $dbname = DB_NAME;
	
	public $con;
	public $error;
	
	public function __construct(){
		$this->connectDB();
	}
	
	private function connectDB(){
		$this->con = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
		mysqli_set_charset($this->con, 'utf8');
		if(!$this->con){
			$this->error ="Connection fail".$this->con->connect_error;
			return false;
		}
	}
	
	// Select data
	public function select($query){
		$result = $this->con->query($query) or die($this->con->error.__LINE__);
		if($result->num_rows > 0){
			return $result;
		} else {
			return false;
		}
	}
	
	// Insert data
	public function insert($query){
		$insert_row = $this->con->query($query) or die($this->con->error.__LINE__);
		if($insert_row){
			return $insert_row;
		} else {
			return false;
		}
	}

	// Update data
	public function update($query){
		$update_row = $this->con->query($query) or die($this->con->error.__LINE__);
		if($update_row){
			return $update_row;
		} else {
			return false;
		}
	}

	// Delete data
	public function delete($query){
		$delete_row = $this->con->query($query) or die($this->con->error.__LINE__);
		if($delete_row){
			return $delete_row;
		} else {
			return false;
		}
	}
}

