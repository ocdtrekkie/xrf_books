<?php
require_once("includes/global.php");
require_once("includes/functions_lib.php");

$letter = substr($_GET['letter'],0,1);
$xrf_page_subtitle = "Authors beginning with " . $letter;

require_once("includes/header.php");

if ($letter != "")
$ltrstr = " WHERE name LIKE '" . $letter . "%'";
else
$ltrstr = "";

$query = "SELECT * FROM l_authors$ltrstr ORDER BY name, years";
$result = mysql_query($query);
$num=mysql_numrows($result);

echo "<table width=\"100%\">";

$qq=0;
while ($qq < $num) {

$id = mysql_result($result,$qq,"id");
$name = mysql_result($result,$qq,"name");
$years = mysql_result($result,$qq,"years");

echo "<tr><td>$id</td><td><a href=\"search_results.php?author=$id\">$name $years</a></td></tr>";

$qq++;
}

echo "</table>";
require_once("includes/footer.php");
?>