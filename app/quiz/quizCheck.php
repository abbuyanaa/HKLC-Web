<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../config/Database.php');
$db = new Database();

$json = file_get_contents('php://input');
$obj = json_decode($json, true);

$name = $obj['name'];
$email = $obj['email'];
$phone = $obj['phone'];
$query = "INSERT INTO `users`(`name`, `email`, `phone`) VALUES ('$name','$email','$phone')";
if (mysqli_query($con, $query)) {
	echo json_encode('Inserted successfully');
} else {
	echo json_encode('Insert field');
}

mysqli_close($con);
?>
