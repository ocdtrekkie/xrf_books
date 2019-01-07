<?php
require("ismodule.php");
$zquery="SELECT * FROM l_circ WHERE uid = '$xrf_myid' AND returned = 0";
$zresult=mysql_query($zquery);
$znum=mysql_numrows($zresult);

if ($znum > 0)
{
echo" <tr>
<td>

<a href=\"module_page.php?modfolder=$modfolder&modpanel=checkedout\">Materials Checked Out:</a>

</td>
<td align=\"right\">

$znum

</td>
</tr>";
}

?>