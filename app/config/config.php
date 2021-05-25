<?php
// Locatlhost
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_USER', 'root');
DEFINE('DB_PASS', '');
DEFINE('DB_NAME', 'inputword');

// Server
// DEFINE('DB_HOST', 'https://dict.huree.edu.mn/');
// DEFINE('DB_USER', 'inputword');
// DEFINE('DB_PASS', 'ether(93#!99)_NET');
// DEFINE('DB_NAME', 'inputword');

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
