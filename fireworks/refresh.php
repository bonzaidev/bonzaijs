<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "fireworks";

$conn=mysql_connect($dbhost, $dbuser, $dbpass);

mysql_select_db($dbname) or die(mysql_error());

$query = "SELECT * FROM people";

$qry_result = mysql_query($query) or die(mysql_error());

$display_string="";

while($row = mysql_fetch_array($qry_result))
{
$display_string .= $row[count];
$display_string .= ",";
}

echo $display_string;

mysql_close($conn);
?>
