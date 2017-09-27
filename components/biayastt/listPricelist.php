<?php /*Added by suwondo*/ ?>
<?php require('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"JS-6");
$currentPage = $_SERVER["PHP_SELF"];

mysql_select_db($database_con_gl, $con_gl);
$query_customer = "SELECT * from customer where IDCUSTOMER = '$_GET[customer]'";
$customer = mysql_query($query_customer, $con_gl) or die(mysql_error());
$row_customer = mysql_fetch_assoc($customer);
$totalRows_customer = mysql_num_rows($customer);


$idcustomer = $_GET['customer'];

//printf($idcustomer);

?>
<script type="text/javascript" src="js/jquery-1.4.js"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
<h1>Pilih Pricelist Customer</h1>
<p><?php echo $row_customer['NAMACUSTOMER'];?></p>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">
  <tr valign="top" bgcolor="#FFFFFF" class="hide">	</tr>
	<tr>
		
   		<th width="100"><strong>Layanan</strong></th>
        <th width="100"><strong>Armada</strong></th>
        <th width="100"><strong>Kota Asal</strong></th>
        <th width="100"><strong>Kota Tujuan</strong></th>
        <th width="100">Terusan</th>
        <th width="100">Rate</th>
        <th width="100">Durasi</th>

		<th width="132" align="center" class="hide"><strong>Action</strong></th>
	</tr>
	<?php
	$key = trim($_REQUEST['cr_txt']);
	$query = mysql_query("select IDLAYANAN,NAMALAYANAN,IDKOTAASAL,KOTAASAL,IDKOTATUJUAN,KOTATUJUAN,IDTERUSAN,NAMATERUSAN,IDHANDLING,NAMAJNSKIRIM,CHARGE,WEIGHT,DURASIWAKTU from v_pricelist_customer where IDCUSTOMER = $_GET[customer]") or die (mysql_error());
	while(list($IDLAYANAN,$NAMALAYANAN,$IDKOTAASAL,$KOTAASAL,$IDKOTATUJUAN,$KOTATUJUAN,$IDTERUSAN,$NAMATERUSAN,$IDHANDLING,$NAMAJNSKIRIM,$CHARGE,$WEIGHT,$DURASIWAKTU) = mysql_fetch_row($query)){
		echo "<tr>";
		echo "<td>$NAMALAYANAN</td><td>$NAMAJNSKIRIM</td><td>$KOTAASAL</td><td>$KOTATUJUAN</td><td>$NAMATERUSAN</td><td>$CHARGE</td><td>$DURASIWAKTU</td><td align='center'><input type='button' value='pilih' onclick=\"javascript: window.opener.document.getElementById('rate').value='$CHARGE'; 
window.opener.document.getElementById('idorigin').value='$IDKOTAASAL'; 
window.opener.document.getElementById('origin').value='$KOTAASAL';
window.opener.document.getElementById('iddestination').value='$IDKOTATUJUAN';
window.opener.document.getElementById('destination').value='$KOTATUJUAN';
window.opener.document.getElementById('idnextdest').value='$IDTERUSAN';
window.opener.document.getElementById('nextdest').value='$NAMATERUSAN';
window.opener.document.getElementById('idservice').value='$IDLAYANAN';
window.opener.document.getElementById('service').value='$NAMALAYANAN';
window.opener.document.getElementById('idhandling').value='$IDHANDLING';
window.opener.document.getElementById('handling').value='$NAMAJNSKIRIM';
window.close(1000);\" /></td>";
		echo "</tr>";
	}
	?>
 </table>
