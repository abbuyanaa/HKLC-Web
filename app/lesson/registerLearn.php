<?php
$con = mysqli_connect('localhost','root','','hureelearning');

$json = file_get_contents('php://input');
$obj = json_decode($json, true);

$email 		= mysqli_real_escape_string($con, $obj['email']);
$password 	= mysqli_real_escape_string($con, md5($obj['password']));

$query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
	$value = $result->fetch_assoc();
	if ($value['verified'] == 1) {
		echo json_encode('success');
	} else {
		echo json_encode('inactive');
	}
} else {
	echo json_encode('Wrong Email or Password!');
}
?>
