<?php
require("ismodule.php");
require("modules/$modfolder/functions_lib.php");
$do = $_GET['do'];
if ($do == "add")
{
	$title = $_POST['title'];
	$author_id = mysqli_real_escape_string($xrf_db, $_POST['author_id']);
	$author_name = $_POST['author_name'];
	$author_years = mysqli_real_escape_string($xrf_db, $_POST['author_years']);
	$typecode = mysqli_real_escape_string($xrf_db, $_POST['typecode']);
	$dewey = mysqli_real_escape_string($xrf_db, $_POST['dewey']);
	$format = mysqli_real_escape_string($xrf_db, $_POST['format']);
	$copyright = mysqli_real_escape_string($xrf_db, $_POST['copyright']);
	$isbn10 = mysqli_real_escape_string($xrf_db, $_POST['isbn10']);
	$isbn13 = mysqli_real_escape_string($xrf_db, $_POST['isbn13']);
	$issn = mysqli_real_escape_string($xrf_db, $_POST['issn']);
	$lccn = mysqli_real_escape_string($xrf_db, $_POST['lccn']);
	$lccat = mysqli_real_escape_string($xrf_db, $_POST['lccat']);
	$tags = mysqli_real_escape_string($xrf_db, $_POST['tags']);
	$serial = mysqli_real_escape_string($xrf_db, $_POST['serial']);
	
	if ($typecode == "EB" || $typecode == "EPER") { $location = "lgdrv"; }
	elseif ($typecode == "ESD" || $typecode == "EVG") { $location = "gmdrv"; }
	else { $location = "oakwd"; }
	
	if ($dewey == "") { $status = "uncat"; }
	else { $status = "avail"; $dewey = str_replace("/","",trim($dewey)); }
	
	$isbn10 = str_replace("-","",trim($isbn10));
	$isbn13 = str_replace("-","",trim($isbn13));
	$issn = str_replace("-","",trim($issn));
	$lccn = trim($lccn);
	$lccat = trim($lccat);
	
	if ($isbn13 == "" && $isbn10 != "") { $isbn13 = xrfl_isbn10to13($isbn10); }
	
	if ($author_id == "" && $author_name != "") {
		$addauthor = mysqli_prepare($xrf_db, "INSERT INTO l_authors (name, years) VALUES(?, ?)") or die(mysqli_error($xrf_db));
		mysqli_stmt_bind_param($addauthor,"ss", $author_name, $author_years);
		mysqli_stmt_execute($addauthor) or die(mysqli_error($xrf_db));
		$author_id = mysqli_insert_id($xrf_db);
		echo $author_name . " added with author ID " . $author_id . ".<br>";
	}
	
	$addbook = mysqli_prepare($xrf_db, "INSERT INTO l_books (typecode, dewey, author, title, format, year, isbn10, isbn13, issn, lccn, lccat, status, location, tags) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)") or die(mysqli_error($xrf_db));
	mysqli_stmt_bind_param($addbook,"sssssissssssss", $typecode, $dewey, $author_id, $title, $format, $copyright, $isbn10, $isbn13, $issn, $lccn, $lccat, $status, $location, $tags);
	mysqli_stmt_execute($addbook) or die(mysqli_error($xrf_db));
	$book_id = mysqli_insert_id($xrf_db);
	echo "Book added with barcode 44890000<b>" . $book_id . "</b>.";
	
	if ($serial != "") {
		$addserial = mysqli_prepare($xrf_db, "INSERT INTO l_serials (barcode, serial) VALUES(?,?)") or die(mysqli_error($xrf_db));
		mysqli_stmt_bind_param($addserial,"is", $book_id, $serial);
		mysqli_stmt_execute($addserial) or die(mysqli_error($xrf_db));
		echo "<br>Serial added to database.";
	}
	
	echo "<p><a href=\"acp_module_panel.php?modfolder=$modfolder&modpanel=addbook\">Add another book?</a></p>";
}
else
{
echo "<b>Add Library Media</b><p>";

echo "<form action=\"acp_module_panel.php?modfolder=$modfolder&modpanel=addbook&do=add\" method=\"POST\">
<table><tr><td><b>Title:</b></td><td><textarea name=\"title\" rows=\"3\" cols=\"34\"></textarea></td></tr>
<tr><td><b>Author:</b></td><td><input type=\"text\" name=\"author_id\" size=\"3\"> <input type=\"text\" name=\"author_name\" size=\"22\"> <input type=\"text\" name=\"author_years\" size=\"8\"></td></tr>
<tr><td><b>Type/Dewey:</b></td><td><input type=\"text\" name=\"typecode\" size=\"3\"> <input type=\"text\" name=\"dewey\" size=\"36\"></td></tr>
<tr><td><b>Format/Year:</b></td><td><input type=\"text\" name=\"format\" size=\"33\"> <input type=\"text\" name=\"copyright\" size=\"6\"></td></tr>
<tr><td><b>ISBN10/13/ISSN:</b></td><td><input type=\"text\" name=\"isbn10\" size=\"10\"> <input type=\"text\" name=\"isbn13\" size=\"16\"> <input type=\"text\" name=\"issn\" size=\"7\"></td></tr>
<tr><td><b>LCCN/Cat:</b></td><td><input type=\"text\" name=\"lccn\" size=\"14\"> <input type=\"text\" name=\"lccat\" size=\"25\"></td></tr>
<tr><td><b>Tags:</b></td><td><textarea name=\"tags\" rows=\"3\" cols=\"34\"></textarea></tr>
<tr><td><b>Serial #:</b></td><td><input type=\"text\" name=\"serial\" size=\"44\"></td></tr>
<tr><td></td><td><input type=\"submit\" value=\"Add\"></td></tr></table></form>";
}
?>