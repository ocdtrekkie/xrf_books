<?php
require_once("includes/global.php");
require_once("includes/functions_class.php");
require_once("includes/functions_lib.php");
require_once("includes/header.php");

$filter = $_GET['filter'];
$group = $_GET['group'];
$author = $_GET['author'];
$sort = $_GET['sort'];

$searchterm = xrf_mysql_sanitize_string($_POST['searchterm']);
$searchwhat = xrf_mysql_sanitize_string($_POST['searchwhat']);
$searchfilter = xrf_mysql_sanitize_string($_POST['searchfilter']);
$searchgroup = xrf_mysql_sanitize_string($_POST['searchgroup']);
if ($searchfilter != "") $filter = $searchfilter;
if ($searchgroup != "") $group = $searchgroup;

$default = " WHERE status != 'wdraw' AND speccode != 'AO'";
if ($filter == "GG")
$cond1 = " AND speccode = 'GG'";
if ($filter == "GD")
$cond1 = " AND speccode = 'GD'";
if ($filter == "B")
$cond1 = " AND typecode = ''";
if ($filter == "EB")
$cond1 = " AND typecode = 'EB'";
if ($filter == "book")
$cond1 = " AND typecode = '' OR typecode = 'EB'";
if ($filter == "CDA")
$cond1 = " AND typecode = 'CDA'";
if ($filter == "CDG")
$cond1 = " AND typecode = 'CDG'";
if ($filter == "CDS")
$cond1 = " AND typecode = 'CDS'";
if ($filter == "CDL")
$cond1 = " AND typecode = 'CDL'";
if ($filter == "DVD")
$cond1 = " AND typecode = 'DVD'";
if ($filter == "BD")
$cond1 = " AND typecode = 'BD'";
if ($filter == "video")
$cond1 = " AND typecode = 'DVD' OR typecode = 'BD'";
if ($filter == "VG")
$cond1 = " AND typecode = 'VG'";
if ($filter == "PER")
$cond1 = " AND typecode = 'PER'";
if ($filter == "EPER")
$cond1 = " AND typecode = 'EPER'";
if ($filter == "mag")
$cond1 = " AND typecode = 'PER' OR typecode = 'EPER'";
if ($filter == "trace")
$cond1 = " AND status = 'trace'";
if ($filter == "chked")
$cond1 = " AND status = 'chked'";
if ($filter == "dmged")
$cond1 = " AND status = 'dmged'";
if ($filter == "wdraw")
$cond1 = " AND status = 'wdraw'";
if ($filter == "uncat")
$cond1 = " AND status = 'uncat'";
if ($filter == "lgdrv")
$cond1 = " AND location = 'lgdrv'";
if ($filter == "vgcab")
$cond1 = " AND location = 'vgcab'";
if ($filter == "Wii")
$cond1 = " AND format LIKE '%Wii Disc%'";
if ($filter == "GameCube")
$cond1 = " AND format LIKE '%GameCube%'";
if ($filter == "DS")
$cond1 = " AND format LIKE '%DS Cart%'";
if ($filter == "")
$cond1 = "";

if ($group == "000")
$cond2 = " AND dewey LIKE '0__%'";
if ($group == "100")
$cond2 = " AND dewey LIKE '1__%'";
if ($group == "200")
$cond2 = " AND dewey LIKE '2__%'";
if ($group == "300")
$cond2 = " AND dewey LIKE '3__%'";
if ($group == "400")
$cond2 = " AND dewey LIKE '4__%'";
if ($group == "500")
$cond2 = " AND dewey LIKE '5__%'";
if ($group == "600")
$cond2 = " AND dewey LIKE '6__%'";
if ($group == "700")
$cond2 = " AND dewey LIKE '7__%'";
if ($group == "800")
$cond2 = " AND dewey LIKE '8__%'";
if ($group == "900")
$cond2 = " AND dewey LIKE '9__%'";
if ($group == "E")
$cond2 = " AND dewey LIKE 'E %'";
if ($group == "F")
$cond2 = " AND dewey LIKE 'F %'";
if ($group == "J")
$cond2 = " AND dewey LIKE 'J %'";
if ($group == "PB")
$cond2 = " AND dewey LIKE 'PB %'";
if ($group == "")
$cond2 = "";

if ($author != "" && $author != 0)
{
$author = (int)$author;
$cond3 = " AND author='$author'";
}

if ($searchwhat == "keyword")
{
$cond4 = " AND (tags LIKE '%$searchterm%' OR title LIKE '%$searchterm%')";
}
if ($searchwhat == "title")
{
$cond4 = " AND title LIKE '%$searchterm%'";
}
if ($searchwhat == "numbers")
{
$cond4 = " AND (isbn10 = '$searchterm' OR isbn13 = '$searchterm' OR issn = '$searchterm' OR lccn = '$searchterm')";
}

if ($sort == "" || $sort == "dewey")
$sort1 = "dewey, title ASC";
if ($sort == "loc")
$sort1 = "lccat, title ASC";

$query = "SELECT * FROM l_books$default$cond1$cond2$cond3$cond4 ORDER BY $sort1";
$result = mysql_query($query);
$num=mysql_numrows($result);

echo "Results Found: $num<br>&nbsp;<br><table width=\"100%\">";

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
$lccat = mysql_result($result,$qq,"lccat");
$speccode = mysql_result($result,$qq,"speccode");
$barcode = $barcode + 448900000000;
if ($author <> "")
{
$aname = xrfl_getauthor($author);
$aname = "<a href=\"search_results.php?author=$author\">$aname</a>";
}
else
{
$aname = "";
}

if ($sort == "" || $sort == "dewey")
$cata = $dewey;
if ($sort == "loc")
$cata = $lccat;

if (($typecode != "EB" && $typecode != "EPER") || xrf_has_uclass($xrf_myuclass,"L"))
echo "<tr><td>$typecode</td><td>$cata</td><td><a href=\"viewrecord.php?barcode=$barcode\">$title</a></td><td>$aname</td></tr>";

$qq++;
}

echo "</table>";

require_once("includes/footer.php");
?>