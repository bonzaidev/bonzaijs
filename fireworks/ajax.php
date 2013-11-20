<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "fireworks";

$conn=mysql_connect($dbhost, $dbuser, $dbpass);

mysql_select_db($dbname) or die(mysql_error());

$query = "SELECT * FROM people WHERE id=1";
$qry_result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($qry_result))
{
$total=intval($row[total]);
}

$total = intval($qry_result);
$resp='';

if($total == 0)
{
	list($msec,$sec)=explode(" ",microtime());
	$millis = round(float($sec)*1000)+round(float($msec)*1000);
	$query = "UPDATE people SET total=1,time=$millis WHERE id=1";
	$qry_result = mysql_query($query) or die(mysql_error());
	$resp.='1,0';
}
else if($total > 0)
{
	$query = "SELECT * FROM people WHERE id=1";
	$qry_result = mysql_query($query) or die(mysql_error());

	while($row = mysql_fetch_array($qry_result))
	{
		$timing=intval($row[time]);
	}

	list($msec,$sec)=explode(" ",microtime());
	$millis = round(float($sec)*1000)+round(float($msec)*1000);
	$times=($total*15)-($millis-$timing);
	$total+=1;
	$query = "UPDATE people SET total=$total WHERE id=1";
	$qry_result = mysql_query($query) or die(mysql_error());
	$resp.=$total;
	$resp.=',';
	$resp.=$times;
}

/*
$display_string="";

while($row = mysql_fetch_array($qry_result))
{
$display_string .= $row[count];
$display_string .= ",";
}
*/
echo $resp;

mysql_close($conn);
?>
