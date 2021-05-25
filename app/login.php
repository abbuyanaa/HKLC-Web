<?php
// $filepath = realpath(dirname(__FILE__));
// include_once($filepath.'/config/Database.php');
// include_once($filepath.'/Format.php');
// $db = new Database();
// $fm = new Format();

// $json = file_get_contents('php://input');
// $obj = json_decode($json, true);

// $email 		= $fm->validation($obj['email']);
// $password 	= $fm->validation($obj['password']);
// $email 		= mysqli_real_escape_string($db->con, $email);
// $password 	= mysqli_real_escape_string($db->con, md5($password));

// $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
// $result = $db->select($query);
include 'config/config.php';
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$json = file_get_contents('php://input');
$obj = json_decode($json, true);

$email 		= $obj['email'];
$password 	= md5($obj['password']);

$query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
	$value = mysqli_fetch_array($result);
	if ($value['verified'] == 1) {
		echo json_encode(['userid'=>$value['id'],'name'=>$value['email']]);
	} else {
		echo json_encode('Админ таны бүртгэлийг баталгаажуулах хүртэл хүлээнэ үү!', JSON_UNESCAPED_UNICODE);
	}
} else {
	echo json_encode('Цахим хаяг эсвэл нууц үг буруу байна', JSON_UNESCAPED_UNICODE);
}
