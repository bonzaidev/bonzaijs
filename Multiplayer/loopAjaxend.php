<?php
$dbhost = "localhost";
$dbuser = "683241";
$dbpass = "qwerty";
$dbname = "683241";

$conn=mysql_connect($dbhost, $dbuser, $dbpass);

mysql_select_db($dbname) or die(mysql_error());

$phone=$_GET['number'];
$total=$_GET['total'];

$query = "SELECT `total` FROM `loop` WHERE `phoneNum`="+$phone;
$qry_result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($qry_result))
{
$totals=intval($row['total']);
}


if($total==$totals)
{
//$query = "UPDATE `loop` SET `total`=0,`ms`=0,`sec`=0 WHERE phoneNum="+$phone;
//$qry_result = mysql_query($query) or die(mysql_error());
}
//$resp

//$echo
mysql_close($conn);
?>