<?php $xrf_page_subtitle = "Home";
require_once("includes/global.php");
require_once("includes/functions_class.php");
require_once("includes/functions_lib.php");
require_once("includes/header.php");
?>

<form action="search_results.php" method="POST"><p align="center"><b>Search:</b> 
<input type="text" name="searchterm" maxlength="128"><select name="searchwhat">
<option value="keyword">Keyword</option>
<option value="title">Title</option>
<option value="numbers">ISBN/ISSN/LCCN</option>
</select><input type="submit" value="Search"> <a href="search.php">Advanced Search</a></p></form>

<div align="center"><table>
<tr><td width=400><a href="search_results.php?group=000">000s - General, Computer Science</a></td><td width=400><a href="search_results.php?group=500">500s - Math, Science</a></td></tr>
<tr><td><a href="search_results.php?group=100">100s - Philosophy, Psychology</a></td><td><a href="search_results.php?group=600">600s - Technology</a></td></tr>
<tr><td><a href="search_results.php?group=200">200s - Religion</a></td><td><a href="search_results.php?group=700">700s - Arts, Recreation</a></td></tr>
<tr><td><a href="search_results.php?group=300">300s - Social Sciences</a></td><td><a href="search_results.php?group=800">800s - Literature</a></td></tr>
<tr><td><a href="search_results.php?group=400">400s - Language</a></td><td><a href="search_results.php?group=900">900s - History, Geography</a></td></tr>
<tr><td><a href="search_results.php?group=F">Fiction - Adult/Young Adult</a></td><td><a href="search_results.php?group=J">Fiction - Juvenile</a></td></tr>
<tr><td><a href="search_results.php?group=E">Fiction - Early Reader</a></td><td></td></tr>
<tr><td><a href="search_results.php">View All Materials</a> (Please Use Sparingly)</td><td></td></tr>
</table></div>
<br>
<div align="center"><table><tr><td align="center">Authors starting with:</td></tr>
<tr><td>
<a href="authors.php?letter=A">A</a> 
<a href="authors.php?letter=B">B</a> 
<a href="authors.php?letter=C">C</a> 
<a href="authors.php?letter=D">D</a> 
<a href="authors.php?letter=E">E</a> 
<a href="authors.php?letter=F">F</a> 
<a href="authors.php?letter=G">G</a> 
<a href="authors.php?letter=H">H</a> 
<a href="authors.php?letter=I">I</a> 
<a href="authors.php?letter=J">J</a> 
<a href="authors.php?letter=K">K</a> 
<a href="authors.php?letter=L">L</a> 
<a href="authors.php?letter=M">M</a> 
<a href="authors.php?letter=N">N</a> 
<a href="authors.php?letter=O">O</a> 
<a href="authors.php?letter=P">P</a> 
<a href="authors.php?letter=Q">Q</a> 
<a href="authors.php?letter=R">R</a> 
<a href="authors.php?letter=S">S</a> 
<a href="authors.php?letter=T">T</a> 
<a href="authors.php?letter=U">U</a> 
<a href="authors.php?letter=V">V</a> 
<a href="authors.php?letter=W">W</a> 
<a href="authors.php?letter=X">X</a> 
<a href="authors.php?letter=Y">Y</a> 
<a href="authors.php?letter=Z">Z</a> 
</td></tr>
<tr><td align="center"><a href="authors.php">View All Authors</a> (Please Use Sparingly)</td></tr></table>
</div>
<br>
<div align="center"><table><tr><td width=400>

<?php if (xrf_has_uclass($xrf_myuclass,"L"))
{
echo "<a href=\"search_results.php?sort=recent&limit=100&view=shelf\">Recently Added</a><p>";
} ?>

<a href="search_results.php?filter=B">Books</a><br>
<a href="search_results.php?filter=PER">Magazines</a><p>

<?php if (xrf_has_uclass($xrf_myuclass,"L"))
{
echo "<a href=\"search_results.php?filter=EB\">Electronic Books</a><br>
<a href=\"search_results.php?filter=EPER\">Electronic Magazines</a><br>
<a href=\"search_results.php?filter=EVG&view=shelf\">Electronic Games</a><br>
<a href=\"search_results.php?filter=ESD\">Electronic Software</a><p>";
} ?>

<a href="search_results.php?filter=CDS">Computer - Software Discs</a><br>
<a href="search_results.php?filter=CDG">Computer - Game Discs</a><br>
<a href="search_results.php?filter=CDL">Computer - Library Discs</a></td>

<td width=400>
<a href="search_results.php?filter=VG">Video Games</a> (<a href="search_results.php?filter=GameCube">GC</a>|<a href="search_results.php?filter=Wii">Wii</a>|<a href="search_results.php?filter=WiiU">WiiU</a>|<a href="search_results.php?filter=Switch">Switch</a>|<a href="search_results.php?filter=DS">DS</a>)<br>
<a href="search_results.php?filter=video">Movies</a> (<a href="search_results.php?filter=4K">4K</a>|<a href="search_results.php?filter=3D">3D</a>|<a href="search_results.php?filter=BD">Blu-ray Discs</a>|<a href="search_results.php?filter=DVD">DVDs</a>)<br>
<a href="search_results.php?filter=CDA">Audio CDs</a><p>

<a href="search_results.php?filter=GG">Game Guides</a><br>
<a href="search_results.php?filter=GD">Game Development Books</a><p>

<a href="search_results.php?filter=manga&view=shelf">Manga</a>

<?php if ($xrf_myulevel >= 3)
{
echo "<p><a href=\"search_results.php?filter=uncat\">Materials set to Uncategorized</a><br>
<a href=\"search_results.php?filter=trace\">Materials set to Trace</a><br>
<a href=\"search_results.php?filter=chked\">Materials set to Checked Out</a><br>
<a href=\"search_results.php?filter=dmged\">Materials set to Damaged</a>";
} ?>

</td></tr></table></div>

<?php
require_once("includes/footer.php");
?>
