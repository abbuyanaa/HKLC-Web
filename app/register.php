<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/config/Database.php');
include_once($filepath.'/Format.php');
$db = new Database();
$fm = new Format();

$json = file_get_contents('php://input');
$obj = json_decode($json, true);

$email 		= $fm->validation($obj['email']);
$password 	= $fm->validation($obj['password']);

$email 		= mysqli_real_escape_string($db->con, $email);
$password 	= mysqli_real_escape_string($db->con, md5($password));

$check_query = "SELECT * FROM users WHERE email = '$email'";
$check = $db->select($check_query);
if ($check != false) {
	echo json_encode('Already exist email address!');
} else {
	$insert_query = "INSERT INTO users(email, password) VALUES ('$email', '$password')";
	$result = $db->insert($insert_query);
	if ($result != false) {
		echo json_encode('success');
	}
}
