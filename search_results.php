<?php
require_once("includes/global.php");
require_once("includes/functions_class.php");
require_once("includes/functions_lib.php");

$filter = $_GET['filter'];
$group = $_GET['group'];
$author = $_GET['author'];
$sort = $_GET['sort'];
$limit = $_GET['limit'];
$limit = (int)$limit;
$view = $_GET['view'];
$issn = $_GET['issn'];

$searchterm = mysqli_real_escape_string($xrf_db, $_POST['searchterm']);
$searchwhat = mysqli_real_escape_string($xrf_db, $_POST['searchwhat']);
$searchfilter = mysqli_real_escape_string($xrf_db, $_POST['searchfilter']);
$searchgroup = mysqli_real_escape_string($xrf_db, $_POST['searchgroup']);
if ($searchfilter != "") $filter = $searchfilter;
if ($searchgroup != "") $group = $searchgroup;

$default = " WHERE status != 'wdraw' AND status != 'rstrc'";
if ($filter == "GG") { $cond1 = " AND tags LIKE '%game guide%'"; $xrf_page_subtitle = "Game Guides"; }
if ($filter == "GD") { $cond1 = " AND tags LIKE '%game development%'"; $xrf_page_subtitle = "Game Development Books"; }
if ($filter == "B") { $cond1 = " AND typecode = ''"; $xrf_page_subtitle = "Physical Books"; }
if ($filter == "EB") { $cond1 = " AND typecode = 'EB'"; $xrf_page_subtitle = "Electronic Books"; }
if ($filter == "book") { $cond1 = " AND typecode = '' OR typecode = 'EB'"; $xrf_page_subtitle = "Books"; }
if ($filter == "EVG") { $cond1 = " AND typecode = 'EVG'"; $xrf_page_subtitle = "Digitally Stored Games"; }
if ($filter == "ESD") { $cond1 = " AND typecode = 'ESD'"; $xrf_page_subtitle = "Digitally Stored Software"; }
if ($filter == "CDA") { $cond1 = " AND typecode = 'CDA'"; $xrf_page_subtitle = "Audio Discs"; }
if ($filter == "CDG") { $cond1 = " AND typecode = 'CDG'"; $xrf_page_subtitle = "Game Discs"; }
if ($filter == "CDS") { $cond1 = " AND typecode = 'CDS'"; $xrf_page_subtitle = "Software Discs"; }
if ($filter == "CDL") { $cond1 = " AND typecode = 'CDL'"; $xrf_page_subtitle = "Library Discs"; }
if ($filter == "DVD") { $cond1 = " AND typecode = 'DVD'"; $xrf_page_subtitle = "DVDs"; }
if ($filter == "BD") { $cond1 = " AND typecode = 'BD'"; $xrf_page_subtitle = "Blu-rays"; }
if ($filter == "video") { $cond1 = " AND typecode = 'DVD' OR typecode = 'BD'"; $xrf_page_subtitle = "Movies"; }
if ($filter == "3D") { $cond1 = " AND typecode = 'BD' AND tags LIKE '3d%'"; $xrf_page_subtitle = "3D Blu-rays"; }
if ($filter == "4K") { $cond1 = " AND typecode = 'BD' AND tags LIKE '4k%'"; $xrf_page_subtitle = "4K Blu-rays"; }
if ($filter == "VG") { $cond1 = " AND typecode = 'VG'"; $xrf_page_subtitle = "Video Games"; }
if ($filter == "PER") { $cond1 = " AND typecode = 'PER'"; $xrf_page_subtitle = "Physical Magazines"; }
if ($filter == "EPER") { $cond1 = " AND typecode = 'EPER'"; $xrf_page_subtitle = "Electronic Magazines"; }
if ($filter == "mag") { $cond1 = " AND typecode = 'PER' OR typecode = 'EPER'"; $xrf_page_subtitle = "Magazines"; }
if ($filter == "trace") { $cond1 = " AND status = 'trace'"; $xrf_page_subtitle = "Materials set to Trace"; }
if ($filter == "chked") { $cond1 = " AND status = 'chked'"; $xrf_page_subtitle = "Materials set to Checked Out"; }
if ($filter == "dmged") { $cond1 = " AND status = 'dmged'"; $xrf_page_subtitle = "Materials set to Damaged"; }
if ($filter == "wdraw") { $cond1 = " AND status = 'wdraw'"; $xrf_page_subtitle = "Materials set to Withdrawn"; }
if ($filter == "uncat") { $cond1 = " AND status = 'uncat'"; $xrf_page_subtitle = "Materials set to Uncategorized"; }
if ($filter == "lgdrv") { $cond1 = " AND location = 'lgdrv'"; $xrf_page_subtitle = "Materials Stored Digitally"; }
if ($filter == "GameCube") { $cond1 = " AND format LIKE '%GameCube%'"; $xrf_page_subtitle = "GameCube Games"; }
if ($filter == "Wii") { $cond1 = " AND format LIKE '%Wii Disc%'"; $xrf_page_subtitle = "Wii Games"; }
if ($filter == "WiiU") { $cond1 = " AND format LIKE '%Wii U Disc%'"; $xrf_page_subtitle = "Wii U Games"; }
if ($filter == "Switch") { $cond1 = " AND format LIKE '%Switch Cart%'"; $xrf_page_subtitle = "Switch Games"; }
if ($filter == "DS") { $cond1 = " AND format LIKE '%DS Cart%'"; $xrf_page_subtitle = "DS/3DS Games"; }
if ($filter == "2DS") { $cond1 = " AND format LIKE '% DS Cart%'"; $xrf_page_subtitle = "DS Games"; }
if ($filter == "3DS") { $cond1 = " AND format LIKE '%3DS Cart%'"; $xrf_page_subtitle = "3DS Games"; }
if ($filter == "PS1") { $cond1 = " AND format LIKE '%PS1 Disc%'"; $xrf_page_subtitle = "PlayStation 1 Games"; }
if ($filter == "PS2") { $cond1 = " AND format LIKE '%PS2 Disc%'"; $xrf_page_subtitle = "PlayStation 2 Games"; }
if ($filter == "PS3") { $cond1 = " AND format LIKE '%PS3 Disc%'"; $xrf_page_subtitle = "PlayStation 3 Games"; }
if ($filter == "PS4") { $cond1 = " AND format LIKE '%PS4 Disc%'"; $xrf_page_subtitle = "PlayStation 4 Games"; }
if ($filter == "") { $cond1 = ""; }

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
$xrf_page_subtitle = "By " . xrfl_getauthor($xrf_db, $author);
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

if ($issn != "")
$cond5 = " AND issn = '$issn'";

if ($sort == "" || $sort == "dewey")
$sort1 = "dewey, title ASC";
if ($sort == "loc")
$sort1 = "lccat, title ASC";
if ($sort == "recent")
$sort1 = "barcode DESC";

if ($limit != "") { $limit1 = " LIMIT $limit"; }

$query = "SELECT * FROM l_books$default$cond1$cond2$cond3$cond4$cond5 ORDER BY $sort1$limit1";
$result = mysqli_query($xrf_db, $query);
$num=mysqli_num_rows($result);

if ($xrf_page_subtitle == "") { $xrf_page_subtitle = "Search Results"; }
require_once("includes/header.php");

echo "Results Found: $num<br>&nbsp;<br><table width=\"100%\">";

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
$lccat = xrf_mysql_result($result,$qq,"lccat");
$barcode = $barcode + 448900000000;
if ($author <> "")
{
$aname = xrfl_getauthor($xrf_db, $author);
$aname = "<a href=\"search_results.php?author=$author\">$aname</a>";
}
else
{
$aname = "";
}

if ($sort == "" || $sort == "dewey" || $sort == "recent")
$cata = $dewey;
if ($sort == "loc")
$cata = $lccat;

if (($typecode != "EB" && $typecode != "EPER" && $typecode != "ESD" && $typecode != "EVG") || xrf_has_uclass($xrf_myuclass,"L")) {
if ($view == "shelf")
{
	if ($qq == 0 || $qq % 4 == 0) { echo "<tr>"; }
	echo "<td height=\"250\" width=\"250\" align=\"center\"><a href=\"viewrecord.php?barcode=$barcode\">";
	$filename = "covers/$barcode.png"; 
	if (file_exists($filename)) { 
	echo "<img src=\"$filename\" style=\"height:250px;max-width:250px;\" alt=\"$title\" title=\"$title\" border=1>"; 
	} else echo $title;
	echo "</a></td>";
	if ($qq % 4 == 3) { echo "</tr>"; }
} else {
echo "<tr><td>$typecode</td><td>$cata</td><td><a href=\"viewrecord.php?barcode=$barcode\">$title</a></td><td>$aname</td></tr>";
}
}

$qq++;
}

echo "</table>";

require_once("includes/footer.php");
?>
