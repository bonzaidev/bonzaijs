<?php
$dbhost = "localhost";
$dbuser = "683241";
$dbpass = "qwerty";
$dbname = "683241";

$conn=mysql_connect($dbhost, $dbuser, $dbpass);

mysql_select_db($dbname) or die(mysql_error());

$phone=$_GET['number'];

$phone=mysql_real_escape_string($phone);

$query ="SELECT COUNT(1) rcount FROM `loop` WHERE `phoneNum` = '$phone'";
$result = mysql_query($query);

$tot=0;
$resp='';

while($row = mysql_fetch_array($result))
{
if($row['rcount']==1)
{
$tot=1;
}
}

if($tot == 0)
{
	$resp.='-1,0,0,0,0';
}
else if($tot == 1)
{
	$query = "SELECT `ms`,`sec`,`total` FROM `loop` Where `phoneNum` = '$phone'";
	$results = mysql_query($query) or die(mysql_error());

	while($rows = mysql_fetch_array($results))
	{
		$msec=$rows['ms'];
		$sec=$rows['sec'];
		$totals=$rows['total'];
	}

	if($totals<10)
	{
		list($msecn,$secn)=explode(" ",microtime());
		$totals+=1;
		$query = "UPDATE `loop` SET `total` = $totals WHERE `phoneNum` = '$phone'";
		$qry_result = mysql_query($query) or die(mysql_error());
		$resp.=$totals;
		$resp.=',';
		$resp.=$msec;
		$resp.=',';
		$resp.=$sec;
		$resp.=',';
		$resp.=$msecn;
		$resp.=',';
		$resp.=$secn;
	}
	else
	{
		$resp.='-2,0,0,0,0';
	}
}

echo $resp;

mysql_close($conn);
?>
