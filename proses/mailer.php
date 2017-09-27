<?php

//session_start(); 
require_once('../connections/con_gl.php');

mysql_select_db($database_con_gl, $con_gl);





$string= $_GET['asd'];



list($noref) = mysql_fetch_row(mysql_query("select no_ref from gl_retailtrans where md5_no_ref = '$string' "));



//rearrange index  no_book auto number in gl_book

$queryBook2 ="DELETE FROM gl_book WHERE no_ref='$noref'";

$runquery2 = mysql_query($queryBook2, $con_gl) or die (mysql_error());

$queryBook3 ="ALTER TABLE gl_book DROP no_book";

$runquery3 = mysql_query($queryBook3, $con_gl) or die (mysql_error());

$queryBook4 ="ALTER TABLE gl_book ADD no_book BIGINT(99) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST";

$runquery4 = mysql_query($queryBook4, $con_gl) or die (mysql_error());



$query ="UPDATE gl_retailtrans SET status='1' WHERE md5_no_ref = '$string' ";

$runquery = mysql_query($query, $con_gl) or die (mysql_error());



$query2 = "SELECT * FROM gl_retailtrans as a inner join gl_detailtrans as b on (a.no_ref = b.no_ref) inner join gl_kontak as c on (a.kontak = c.id) where a.md5_no_ref = '$string' ";	

$runquery2 = mysql_query($query2, $con_gl) or die (mysql_error());

$row = mysql_fetch_assoc($runquery2);



$query3 = "SELECT barang FROM gl_barang WHERE id = '$row[barang]' ";

$runquery3 = mysql_query($query3, $con_gl) or die (mysql_error());

$row2 = mysql_fetch_assoc($runquery3);



$query4 = "SELECT gudang FROM gl_gudang WHERE id = '$row[gudang]' ";

$runquery4 = mysql_query($query4, $con_gl) or die (mysql_error());

$row3 = mysql_fetch_assoc($runquery4);

?>



<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<title>TICKETING CONFIRMATION</title>

</head>

<body>

<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">

<tr>

<td align="center" valign="middle" bgcolor="#000000" style="background-color:#000000; padding:20px; color:#ffffff;">

<div style="font-size:24px;"><font face ="Arial">BIMEX TOUR &amp; TICKETING</font></div></td>

</tr>

</table>

<table width="600" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#971800" style="background-color:#971800;">

<tr>

<td align="center" valign="middle" bgcolor="#971800" style="background-color:#971800; padding:4px; color:#fc9600;">

<div style="font-size:14px;"><font face ="Arial"><b>CAR BOOKING CONFIRMATION<b></font></div>

</td>

</tr>

</table>

<table width="600" border="0" align="center" cellspacing="0" cellpadding="10" style="margin-bottom:10px;">

<tr>



<td align="left" valign="top" bgcolor="#e7e0b7" style="background-color:#e7e0b7; padding:20px;">

<div style="font-size:18px; color:#000000;" align="center"><font face ="Arial"><b>This Booking is Confirmed!</b></font></div><br>

<div style="font-size:14px; color:#000000;"><font face ="Arial">Thank you for your acknowledgement of this customer booking, please find the details as follow:</font></div><br>

<hr align="center">

<div style="font-size:14px;  color:#000000">

<pre><font face ="Arial"><b>Guest Name</b>		: <?php echo $row['nama']; ?> </font></pre>

<!--

<pre><font face ="Arial"><b>Phone</b> 			: <?php echo $row['tlp']; ?> </font></pre> 

<pre><font face ="Arial"><b>Car Name</b> 		: <?php echo $row['kendaraan']; ?> </font></pre>

<pre><font face ="Arial"><b>Service Type</b>		: <?php echo $row2['barang']; ?> </font></pre>

<pre><font face ="Arial"><b>Pick Up</b>			: <?php echo $row['checkin']; ?> </font></pre>

<pre><font face ="Arial"><b>Drop Off</b> 			: <?php echo $row['checkout']; ?> </font></pre>

<pre><font face ="Arial"><b>Regional Area </b>	: <?php echo $row3['gudang']; ?> </font></pre>

<pre><font face ="Arial"><b>Pick Up Detail</b>	 	: <?php echo $row['transaksi']; ?> </font></pre></div>

-->

<hr align="center">

<div align="center" style="font-size:14px; color:#000000;"><font face ="Arial">Your Car Rental Reservation Number already save in our database</font></div>

</td>

</tr>

<tr>

<td align="center" valign="middle" bgcolor="#000000" style="background-color:#000000; padding:20px; color:#ffffff;">

<div style="font-size:14px;"><font face="Arial">PT. BIRAMA IDAMAN EXPRESS</font></div>

</td>

</tr>

</table>

</body>

</html>

