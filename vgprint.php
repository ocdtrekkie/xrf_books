<?php
require_once("includes/global.php");
require_once("includes/functions_lib.php");

$query = "SELECT * FROM l_books WHERE location = 'vgcab' ORDER BY title";
$result = mysql_query($query);
$num=mysql_num_rows($result);

$qq=0;
while ($qq < $num) {

$barcode = mysql_result($result,$qq,"barcode");
$typecode = mysql_result($result,$qq,"typecode");
$dewey = mysql_result($result,$qq,"dewey");
$author = mysql_result($result,$qq,"author");
$title = mysql_result($result,$qq,"title");
$format = mysql_result($result,$qq,"format");
$isbn10 = mysql_result($result,$qq,"isbn10");
$isbn13 = mysql_result($result,$qq,"isbn13");
$speccode = mysql_result($result,$qq,"speccode");
$barcode = $barcode + 448900000000;

echo "<b>$title</b> - $format<br>";

$qq++;
}

mysql_close();
?>