<?php

//Function xrfl_getauthor
//Use: Returns the full name of an author.
function xrfl_getauthor($id)
{
$query="SELECT name FROM l_authors WHERE id='$id'";
$result=mysql_query($query);
$name=mysql_result($result,$mm,"name");
return ($name);
}

//Function xrfl_getstatus
//Use: Returns the full name of a status.
function xrfl_getstatus($code)
{
$query="SELECT descr FROM l_statuses WHERE code='$code'";
$result=mysql_query($query);
$descr=mysql_result($result,$mm,"descr");
return ($descr);
}

//Function xrfl_getlocation
//Use: Returns the full name of a location.
function xrfl_getlocation($code)
{
$query="SELECT descr FROM l_locations WHERE code='$code'";
$result=mysql_query($query);
$descr=mysql_result($result,$mm,"descr");
return ($descr);
}

//Function xrfl_isbn10hyp
//Use: Hyphenates a 10-digit ISBN.
function xrfl_isbn10hyp($isbn)
{
$isbna = substr($isbn,0,1) . "-";

if (substr($isbn,0,1) == 0)
{
if (substr($isbn,1,2) <= 19)
$isbna = $isbna . substr($isbn,1,2) . "-" . substr($isbn,3,6);

if (substr($isbn,1,3) >= 200 && substr($isbn,1,3) <= 699)
$isbna = $isbna . substr($isbn,1,3) . "-" . substr($isbn,4,5);

if (substr($isbn,1,4) >= 7000 && substr($isbn,1,4) <= 8499)
$isbna = $isbna . substr($isbn,1,4) . "-" . substr($isbn,5,4);

if (substr($isbn,1,5) >= 85000 && substr($isbn,1,5) <= 89999)
$isbna = $isbna . substr($isbn,1,5) . "-" . substr($isbn,6,3);

if (substr($isbn,1,6) >= 900000 && substr($isbn,1,6) <= 949999)
$isbna = $isbna . substr($isbn,1,6) . "-" . substr($isbn,7,2);

if (substr($isbn,1,6) >= 9500000 && substr($isbn,1,6) <= 9999999)
$isbna = $isbna . substr($isbn,1,7) . "-" . substr($isbn,8,1);
}

if (substr($isbn,0,1) == 1)
{
if (substr($isbn,1,2) <= 09)
$isbna = $isbna . substr($isbn,1,2) . "-" . substr($isbn,3,6);

if (substr($isbn,1,3) >= 100 && substr($isbn,1,3) <= 399)
$isbna = $isbna . substr($isbn,1,3) . "-" . substr($isbn,4,5);

if (substr($isbn,1,4) >= 4000 && substr($isbn,1,4) <= 5499)
$isbna = $isbna . substr($isbn,1,4) . "-" . substr($isbn,5,4);

if (substr($isbn,1,5) >= 55000 && substr($isbn,1,5) <= 86979)
$isbna = $isbna . substr($isbn,1,5) . "-" . substr($isbn,6,3);

if (substr($isbn,1,6) >= 869800 && substr($isbn,1,6) <= 998999)
$isbna = $isbna . substr($isbn,1,6) . "-" . substr($isbn,7,2);

if (substr($isbn,1,7) >= 9990000 && substr($isbn,1,7) <= 9999999)
$isbna = $isbna . substr($isbn,1,7) . "-" . substr($isbn,7,2);
}

if (substr($isbn,0,1) == 2)
{
if (substr($isbn,1,2) <= 19)
$isbna = $isbna . substr($isbn,1,2) . "-" . substr($isbn,3,6);

if (substr($isbn,1,3) >= 200 && substr($isbn,1,3) <= 349)
$isbna = $isbna . substr($isbn,1,3) . "-" . substr($isbn,4,5);

if (substr($isbn,1,5) >= 35000 && substr($isbn,1,5) <= 39999)
$isbna = $isbna . substr($isbn,1,5) . "-" . substr($isbn,6,3);

if (substr($isbn,1,3) >= 400 && substr($isbn,1,3) <= 699)
$isbna = $isbna . substr($isbn,1,3) . "-" . substr($isbn,4,5);

if (substr($isbn,1,4) >= 7000 && substr($isbn,1,4) <= 8399)
$isbna = $isbna . substr($isbn,1,4) . "-" . substr($isbn,5,4);

if (substr($isbn,1,5) >= 84000 && substr($isbn,1,5) <= 89999)
$isbna = $isbna . substr($isbn,1,5) . "-" . substr($isbn,6,3);

if (substr($isbn,1,6) >= 900000 && substr($isbn,1,6) <= 949999)
$isbna = $isbna . substr($isbn,1,6) . "-" . substr($isbn,7,2);

if (substr($isbn,1,6) >= 9500000 && substr($isbn,1,6) <= 9999999)
$isbna = $isbna . substr($isbn,1,7) . "-" . substr($isbn,8,1);
}

if (substr($isbn,0,1) == 3)
{
if (substr($isbn,1,2) <= 02)
$isbna = $isbna . substr($isbn,1,2) . "-" . substr($isbn,3,6);

if (substr($isbn,1,3) >= 030 && substr($isbn,1,3) <= 033)
$isbna = $isbna . substr($isbn,1,3) . "-" . substr($isbn,4,5);

if (substr($isbn,1,4) >= 0340 && substr($isbn,1,4) <= 0369)
$isbna = $isbna . substr($isbn,1,4) . "-" . substr($isbn,5,4);

if (substr($isbn,1,5) >= 03700 && substr($isbn,1,5) <= 03999)
$isbna = $isbna . substr($isbn,1,5) . "-" . substr($isbn,6,3);

if (substr($isbn,1,2) >= 04 && substr($isbn,1,2) <= 19)
$isbna = $isbna . substr($isbn,1,2) . "-" . substr($isbn,3,6);

if (substr($isbn,1,3) >= 200 && substr($isbn,1,3) <= 699)
$isbna = $isbna . substr($isbn,1,3) . "-" . substr($isbn,4,5);

if (substr($isbn,1,4) >= 7000 && substr($isbn,1,4) <= 8499)
$isbna = $isbna . substr($isbn,1,4) . "-" . substr($isbn,5,4);

if (substr($isbn,1,5) >= 85000 && substr($isbn,1,5) <= 89999)
$isbna = $isbna . substr($isbn,1,5) . "-" . substr($isbn,6,3);

if (substr($isbn,1,6) >= 900000 && substr($isbn,1,6) <= 949999)
$isbna = $isbna . substr($isbn,1,6) . "-" . substr($isbn,7,2);

if (substr($isbn,1,6) >= 9500000 && substr($isbn,1,6) <= 9539999)
$isbna = $isbna . substr($isbn,1,7) . "-" . substr($isbn,8,1);

if (substr($isbn,1,5) >= 95400 && substr($isbn,1,5) <= 96999)
$isbna = $isbna . substr($isbn,1,5) . "-" . substr($isbn,6,3);

if (substr($isbn,1,6) >= 9700000 && substr($isbn,1,6) <= 9899999)
$isbna = $isbna . substr($isbn,1,7) . "-" . substr($isbn,8,1);

if (substr($isbn,1,5) >= 99000 && substr($isbn,1,5) <= 99999)
$isbna = $isbna . substr($isbn,1,5) . "-" . substr($isbn,6,3);
}


$isbna = $isbna . "-" . substr($isbn,9,1);
return ($isbna);
}

//Function xrfl_isbn13hyp
//Use: Hyphenates a 13-digit ISBN.
function xrfl_isbn13hyp($isbn)
{
$isbna = xrfl_isbn10hyp(substr($isbn,3,10));
$isbnb = substr($isbn,0,3) . "-" . $isbna;
return ($isbnb);
}

//Function xrfl_issnhyp
//Use: Hyphenates an ISSN.
function xrfl_issnhyp($issn)
{
$issnb = substr($issn,0,4) . "-" . substr($issn,4,4);
return ($issnb);
}

?>