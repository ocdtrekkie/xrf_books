<?php
require_once("includes/global.php");
require_once("includes/functions_lib.php");

$query = "SELECT * FROM l_books WHERE location = 'vgcab' ORDER BY title";
$result = mysqli_query($xrf_db, $query);
$num=mysqli_num_rows($result);

$qq=0;
while ($qq < $num) {

$barcode = xrf_mysql_result($result,$qq,"barcode");
$typecode = xrf_mysql_result($result,$qq,"typecode");
$dewey = xrf_mysql_result($result,$qq,"dewey");
$author = xrf_mysql_result($result,$qq,"author");
$title = xrf_mysql_result($result,$qq,"title");
$format = xrf_mysql_result($result,$qq,"format");
$isbn10 = xrf_mysql_result($result,$qq,"isbn10");
$isbn13 = xrf_mysql_result($result,$qq,"isbn13");
$speccode = xrf_mysql_result($result,$qq,"speccode");
$barcode = $barcode + 448900000000;

echo "<b>$title</b> - $format<br>";

$qq++;
}

mysqli_close($xrf_db);
?>