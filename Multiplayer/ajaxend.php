<?php
$dbhost = "localhost";
$dbuser = "683241";
$dbpass = "qwerty";
$dbname = "683241";

$conn=mysql_connect($dbhost, $dbuser, $dbpass);

mysql_select_db($dbname) or die(mysql_error());

$query = "SELECT total FROM people WHERE id=1";
$qry_result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($qry_result))
{
$totals=intval($row['total']);
}

$total=$_GET['total'];
if($total==$totals)
{
$query = "UPDATE people SET total=0,ms=0,sec=0 WHERE id=1";
$qry_result = mysql_query($query) or die(mysql_error());
}


mysql_close($conn);
?>