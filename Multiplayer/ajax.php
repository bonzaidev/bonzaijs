<?php
$dbhost = "localhost";
$dbuser = "683241";
$dbpass = "qwerty";
$dbname = "683241";

$conn=mysql_connect($dbhost, $dbuser, $dbpass);

mysql_select_db($dbname) or die(mysql_error());

$query = "SELECT total FROM people WHERE id=1";
$qry_result = mysql_query($query) or die(mysql_error());
//$total=array("tot" => "0");

while($row = mysql_fetch_array($qry_result))
{
$totals=intval($row['total']);
}

//$totals = intval($qry_result);
$resp='';

if($totals == 0)
{
	list($msec,$sec)=explode(" ",microtime());
	//$millis = round(float($sec)*1000)+round(float($msec)*1000);
	$query = "UPDATE people SET total=1,ms=$msec,sec=$sec WHERE id=1";
	$qry_result = mysql_query($query) or die(mysql_error());
	$resp.='1,0,0,0,0';
}
else if($totals > 0)
{
	$query = "SELECT ms,sec FROM people Where id=1";
	$qry_result = mysql_query($query) or die(mysql_error());

	while($row = mysql_fetch_array($qry_result))
	{
		$msec=$row['ms'];
		$sec=$row['sec'];
	}

//$timing=intval($qry_result);

	list($msecn,$secn)=explode(" ",microtime());
	//$millis = round(float($sec)*1000)+round(float($msec)*1000);
	//$times=($totals*15)-($millis-$timing);
	$totals+=1;
	$query = "UPDATE people SET total=$totals WHERE id=1";
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

echo $resp;

mysql_close($conn);
?>
