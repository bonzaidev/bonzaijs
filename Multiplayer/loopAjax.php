<?php
/*
include 'ChromePhp.php';
ChromePhp::log('Hello console!');
ChromePhp::log($_SERVER);
ChromePhp::warn('something went wrong!');
*/
$dbhost = "localhost";
$dbuser = "683241";
$dbpass = "qwerty";
$dbname = "683241";

$conn=mysql_connect($dbhost, $dbuser, $dbpass);

mysql_select_db($dbname) or die(mysql_error());

$phone=$_GET['number'];
$resp='';

$phone=mysql_real_escape_string($phone);

$query ="SELECT COUNT(1) rcount FROM `loop` WHERE `phoneNum` = '$phone'";
$result = mysql_query($query);

$tot=0;

while($row=mysql_fetch_array($result))
{
if($row['rcount'] == 1)
{
$tot=1;
}
}

if($tot==1)
{
	echo '-1,0,0,0,0';
}
else if($tot==0)
{
	list($msec,$sec)=explode(" ",microtime());
	$query = "INSERT INTO `loop`(`phoneNum`,`total`,`sec`,`ms`) VALUES('$phone',1,'$sec','$msec')";
	mysql_query($query) or die(mysql_error());
	echo '1,0,0,0,0';
}

mysql_close($conn);
?>
