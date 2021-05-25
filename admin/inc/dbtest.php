
<?
$mysql_host = 'localhost';
$mysql_user = 'online';
$mysql_password = 'Go876InFoSys!123';
$mysql_db = 'online';


$con = mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db);
     
if (mysqli_connect_errno($con)){
    echo "DB 연결 실패:" . mysqli_connect_error(); 
}else{
	echo "DB 연결 성공";
}
mysqli_set_charset($con, 'utf8');
?>