<?php
require_once("includes/global.php");
require_once("includes/functions_class.php");
require_once("includes/functions_lib.php");

$barcode = $_GET['barcode'];

$smallcode = $barcode - 448900000000;
$smallcode = (int)$smallcode;

$query = "SELECT * FROM l_books WHERE barcode = '$smallcode'";
$result = mysqli_query($xrf_db, $query);

$typecode = xrf_mysql_result($result,0,"typecode");
$dewey = xrf_mysql_result($result,0,"dewey");
$author = xrf_mysql_result($result,0,"author");
$title = xrf_mysql_result($result,0,"title");
$format = xrf_mysql_result($result,0,"format");
$year = xrf_mysql_result($result,0,"year");
$isbn10 = xrf_mysql_result($result,0,"isbn10");
$isbn13 = xrf_mysql_result($result,0,"isbn13");
$issn = xrf_mysql_result($result,0,"issn");
$lccn = xrf_mysql_result($result,0,"lccn");
$lccat = xrf_mysql_result($result,0,"lccat");
$status = xrf_mysql_result($result,0,"status");
$location = xrf_mysql_result($result,0,"location");
$tags = xrf_mysql_result($result,0,"tags");

if (($typecode == "EB" || $typecode == "EPER" || $typecode == "ESD" || $typecode == "EVG") && xrf_has_uclass($xrf_myuclass,"L") == false)
die("Not authorized!");

if ($status == "rstrc" && $xrf_myulevel < 4)
die("Not authorized!");

$xrf_page_subtitle = $title;
require_once("includes/header.php");

if ($isbn10 != "" && strlen(xrfl_isbn10hyp($isbn10)) > 10)
$isbn10 = xrfl_isbn10hyp($isbn10);
if ($isbn13 != "" && strlen(xrfl_isbn13hyp($isbn13)) > 13)
$isbn13 = xrfl_isbn13hyp($isbn13);
if ($issn != "")
$issnhyp = xrfl_issnhyp($issn);

$status = xrfl_getstatus($xrf_db, $status);
$location = xrfl_getlocation($xrf_db, $location);

echo "<font size=\"5\">$title</font>";

if ($author <> "")
{
$aname = xrfl_getauthor_years($xrf_db, $author);
echo "<br><a href=\"search_results.php?author=$author\">$aname</a>";
}

echo "<p><table width=\"100%\"><tr><td><p>Classification: ";

if ($typecode <> "")
echo "$typecode ";

echo "$dewey<br>Barcode: $barcode<br>Format: $format<br>Status: $status<br>Location: $location<p>";

if ($year != "")
echo "Year: $year<br>";
if ($isbn10 != "")
echo "ISBN-10: $isbn10<br>";
if ($isbn13 != "")
echo "ISBN-13: $isbn13<br>";
if ($issn != "")
echo "ISSN: <a href=\"search_results.php?issn=$issn\">$issnhyp</a><br>";
if ($lccn != "")
echo "LCCN: <a href=\"https://lccn.loc.gov/$lccn\" target=\"_blank\">$lccn</a><br>";
if ($lccat != "")
echo "LC Cat: $lccat<br>";

if ($xrf_myulevel > 3)
{
echo "<p>Tags: $tags</p>";

$query = "SELECT * FROM l_serials WHERE barcode = '$smallcode'";
$result = mysqli_query($xrf_db, $query);
if(mysqli_num_rows($result) != 0){
  $serial = xrf_mysql_result($result,0,"serial");
  echo "<p>Serial: $serial</p>";
}
}

if ($xrf_myulevel > 2) {

echo "<p align=\"left\"><b>Actions:</b> <font size=\"2\"><a href=\"add_to_reading_list.php?passid=$smallcode\">[Add to Reading List]</a> ";

if ($xrf_myulevel > 3) {
echo "<a href=\"$xrf_site_url/acp_module_panel.php?modfolder=library&modpanel=checkout&passid=$smallcode\">[Check Out]</a> ";

if ($format == "1 File (CHM)") {
	echo "<a href=\"file:///S:/Library/$barcode.chm\">[Open Locally]</a>";
}
if ($format == "1 File (EPUB)") {
	echo "<a href=\"file:///S:/Library/$barcode.epub\">[Open Locally]</a>";
}
if ($format == "1 File (LIT)") {
	echo "<a href=\"file:///S:/Library/$barcode.lit\">[Open Locally]</a>";
}
if ($format == "1 File (MOBI)") {
	echo "<a href=\"file:///S:/Library/$barcode.mobi\">[Open Locally]</a>";
}
if ($format == "1 File (PDF)") {
	echo "<a href=\"file:///S:/Library/$barcode.pdf\">[Open Locally]</a>";
}
if (strpos($format, "Files") !== FALSE) {
	echo "<a href=\"file:///S:/Library/$barcode\">[Open Locally]</a>";
}
}

echo "</font></p>";
}

echo "</td><td width=\"305\" align=\"center\">";

$filename = "covers/$barcode.png"; 
if (file_exists($filename)) { 
echo "<img src=\"$filename\" border=1>"; 
}

echo "</td></tr></table>";

require_once("includes/footer.php");
?>
