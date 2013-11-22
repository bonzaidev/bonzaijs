<?php
$dbhost = "localhost";
$dbuser = "646115";
$dbpass = "ronaldo10";
$dbname = "646115";

$conn=mysql_connect($dbhost, $dbuser, $dbpass);

mysql_select_db($dbname) or die(mysql_error());

$vall = $_GET['value'];
$vall = mysql_real_escape_string($vall);

$query = "SELECT * FROM ajax WHERE id=$vall";

$qry_result = mysql_query($query) or die(mysql_error());




while($row = mysql_fetch_array($qry_result))
{
$some=$row[count];
}


$some+=1;


$query = "UPDATE ajax SET count=$some WHERE id=$vall";

$qry_result= mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($qry_result))
{
$display_string = $row[count];
$display_string .= ",";
}

echo $some." ".$vall;


mysql_close($conn);
?>
