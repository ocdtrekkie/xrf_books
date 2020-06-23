<?php
header('Content-Type: text/html; charset=iso-8859-15');
if ($xrf_mystylepref == "") {$xrf_style = $xrf_style_default;}
else {$xrf_style = $xrf_mystylepref;}
if ($xrf_page_subtitle != "") { $xrf_title_nugget = " - "; }
echo "<html><head><title>$xrf_site_name Library$xrf_title_nugget$xrf_page_subtitle</title>
<link rel=\"stylesheet\" type=\"text/css\" href=\"styles/$xrf_style/style.css\" />
</head><body>";

if ($xrf_myid != 0)
{
$navbox = "<a href=\"index.php\"><font color=\"white\">Home</font></a> - <a href=\"search.php\"><font color=\"white\">Search</font></a> - <a href=\"logout.php\"><font color=\"white\">Log out</font></a><br>";
if ($xrf_myulevel == 0)
$sstatus = "<font color=\"red\"><b>Banned</b></font>";
if ($xrf_myulevel == 1)
$sstatus = "<font color=\"red\"><b>Not Activated</b></font>";
}
else
{
$navbox = "<a href=\"index.php\"><font color=\"white\">Home</font></a> - <a href=\"search.php\"><font color=\"white\">Search</font></a> - <a href=\"login.php\"><font color=\"white\">Log in</font></a>";
}

echo "<div class=\"header\" align=\"center\">
<table width=\"100%\"><tr><td>
<p align=\"left\">
<font size=\"6\" color=\"white\">$xrf_site_name Library</font><br>
<font color=\"white\"><a href=\"$xrf_site_url\"><font color=\"white\">$xrf_myusername</font></a></font>
</p>
</td><td>
<p align=\"right\">
<font color=\"white\">$navbox$sstatus</font>
</p>
</td></tr></table>
</div>

<div class=\"container\" align=\"left\">";
?>
