<?php

include 'config/database.php';
$db = new Database();

$json = file_get_contents('php://input');
$obj = json_decode($json, true);

$email = mysqli_real_escape_string($db->con, strtolower($obj['email']));
$password = $obj['password'];

$check = $db->select("SELECT * FROM users WHERE email='$email'");
if (!empty($check)) {
	echo json_encode('Email already exists!');
} else {
	$data = array(
		'email' => $email,
		'password' => $password
	);
	if ($db->insert('users', $data)) {
		echo json_encode('Success');
	} else {
		echo json_encode('failed');
	}
}

?>
