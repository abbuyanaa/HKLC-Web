<?php 

$servername = "localhost";
$username = "inputword";
$password = "ether(93#!99)_NET";

try {
    $conn = new PDO("mysql:host=$servername;dbname=inputword", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
	$conn->exec('set names utf8');
?>