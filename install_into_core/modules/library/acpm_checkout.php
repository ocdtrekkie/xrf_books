<?php
require("ismodule.php");

if ($do == "check")
{
	$patron = xrf_mysql_sanitize_string($_POST['patron']);
	$barcode = xrf_mysql_sanitize_string($_POST['barcode']);
	$duedate = xrf_mysql_sanitize_string($_POST['duedate']);
	$bookid = $barcode - 448900000000;

	$query="SELECT * FROM g_users WHERE email='$patron' || id='$patron'";
	$result=mysql_query($query);
	@$custid=mysql_result($result,0,"id");
	
	$query="SELECT * FROM l_books WHERE barcode='$bookid'";
	$result=mysql_query($query);
	@$oldstatus=mysql_result($result,0,"status");
	if ($oldstatus == "chked")
		mysql_query("UPDATE l_circ SET returned = NOW() WHERE bookid = '$bookid'") or die(mysql_error());
	else
		mysql_query("UPDATE l_books SET status = 'chked' WHERE barcode = '$bookid'") or die(mysql_error()); 

	mysql_query("INSERT INTO l_circ (uid, bookid, date, due) VALUES('$custid', $bookid, NOW(), '$duedate')") or die(mysql_error()); 

	xrf_go_redir("acp.php","Checked out.",2);
}
else
{
	if ($passid != 0)
		$barcode=448900000000 + (int)$passid;
	else
		$barcode="44890000";

	echo "<b>Check Out Material</b><p>";

	echo "<form action=\"acp_module_panel.php?modfolder=library&modpanel=checkout&do=check\" method=\"POST\">
	<table><tr><td><b>Patron ID or Email:</b></td><td><input type=\"text\" name=\"patron\" size=\"50\"> <input type=\"submit\" value=\"Check Out\"></td></tr>
	<tr><td><b>Barcode:</b></td><td><input type=\"text\" name=\"barcode\" size=\"50\" value=\"$barcode\"></td></tr>
	<tr><td><b>Due Date:</b></td><td><input type=\"text\" name=\"duedate\" size=\"50\"></td></tr>
	</table></form>";
}
?>