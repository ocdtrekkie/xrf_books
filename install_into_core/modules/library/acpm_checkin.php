<?php
require("ismodule.php");

if ($do == "check")
{
	$barcode = xrf_mysql_sanitize_string($_POST['barcode']);
	$waive = xrf_mysql_sanitize_string($_POST['waive']);
	if ($waive == 'N')
		$waive = "";
	$bookid = $barcode - 448900000000;
	
	$query="SELECT * FROM l_circ WHERE bookid='$bookid' AND returned = 0";
	$result=mysql_query($query);
	$uid=mysql_result($result,0,"uid");
	$duedate=mysql_result($result,0,"due");
	
	mysql_query("UPDATE l_circ SET returned = NOW() WHERE bookid = '$bookid'") or die(mysql_error());
	mysql_query("UPDATE l_books SET status = 'avail' WHERE barcode = '$bookid'") or die(mysql_error()); 
	
	// Levy fines if billing system exists.
	$billingquery = "SELECT folder FROM g_modules WHERE name = 'Billing'";
	$billingresult = mysql_query($billingquery) or die(mysql_error());
	@$billingfolder = mysql_result($billingresult,0,"folder");
	if ($billingfolder != "")
	{
		$chkdate = strtotime($duedate);

		$diff = time() - $chkdate;
		$dayslate = floor($diff / 60 / 60 / 24);
		if ($dayslate > 1)
		{
			if ($waive != "W")
			{
				include("modules/$billingfolder/functions_billing.php");

				$fine = $dayslate * 10; // 10 cents per day
				$notes = "Late fine for $barcode, $dayslate days late.";
				mysql_query("INSERT INTO b_orders (uid, date, aid, notes) VALUES('$uid', NOW(), 1, '$notes')") or die(mysql_error()); 
				$oidres = mysql_query("SELECT id FROM b_orders WHERE uid = '$uid' AND aid = 1 AND notes = '$notes' ORDER BY id DESC LIMIT 1") or die(mysql_error());
				$oid = mysql_result($oidres,0,"id");
				mysql_query("INSERT INTO b_charges (uid, oid, iid, amt, quantity, status) VALUES('$uid', '$oid', 9, '$fine', 1, '$waive')") or die(mysql_error());
				xrfb_update_order($oid); 
				$finedetail = xrfb_disp_cash($fine);
				$finedetail = " Late fee $finedetail, $dayslate days late.";
			}
			else
			{
				$finedetail = " Late fee waived. $dayslate days late.";
			}
		}
	}

	xrf_go_redir("acp.php","Checked in.$finedetail",2);
}
else
{
	if ($passid != 0)
		$barcode=448900000000 + (int)$passid;
	else
		$barcode="44890000";

	echo "<b>Return Material</b><p>";

	echo "<form action=\"acp_module_panel.php?modfolder=library&modpanel=checkin&do=check\" method=\"POST\">
	<table><tr><td><b>Barcode:</b></td><td><input type=\"text\" name=\"barcode\" size=\"50\" value=\"$barcode\"> <input type=\"submit\" value=\"Check In\"></td></tr>
	<tr><td><b>Waive Late Fees?</b></td><td><select name=\"waive\"><option value=\"N\">No</option><option value=\"W\">Yes</option></select></td></tr>
	</table></form>";
}
?>