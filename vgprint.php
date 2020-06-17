<?php
require_once("includes/global.php");
require_once("includes/functions_lib.php");

$query = "SELECT * FROM l_books WHERE location = 'vgcab' ORDER BY title";
$result = mysqli_query($xrf_db, $query);
$num=mysqli_num_rows($result);

$qq=0;
while ($qq < $num) {

$title = xrf_mysql_result($result,$qq,"title");
$format = xrf_mysql_result($result,$qq,"format");

echo "<b>$title</b> - $format<br>";

$qq++;
}

mysqli_close($xrf_db);
?>