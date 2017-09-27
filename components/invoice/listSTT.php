<?php /*Added by suwondo*/ ?>

<?php require('connections/con_gl.php'); ?>

<?php

cekAkses($_SESSION[akses],"JS-6");

$currentPage = $_SERVER["PHP_SELF"];
$customer_id = $_GET['customer'];
;
mysql_select_db($database_con_gl, $con_gl);

if ($customer_id == '') {

	//$error[] = '- Customer harus diisi';
	echo "Customer harus dipilih";
	die($customer);
}
$query_klas = "SELECT IDSTT,NOCONNOTE, NAMAPENERIMA,IDSERVICE,NAMALAYANAN,IDHANDLING,NAMAJNSKIRIM,IDORIGIN,KOTAASAL,IDDESC,KOTATUJUAN,WEIGHT,TOTAL_CHARGE  from v_detailstt WHERE IDSTT NOT IN (Select IDSTT from v_invoice_detail) AND IDCUSTOMER = $customer_id ORDER BY NOCONNOTE ASC";

$klas = mysql_query($query_klas, $con_gl) or die(mysql_error());

$row_klas = mysql_fetch_assoc($klas);

$totalRows_klas = mysql_num_rows($klas);



?>

<script type="text/javascript" src="js/jquery-1.4.js"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" /><h1>Data Surat Tanda Terima Barang</h1>

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">

	<tr valign="top" bgcolor="#FFFFFF" class="hide">

        <td colspan="11" align="right" style="border-bottom:solid 1px #E2EAC1;border-right:solid 1px #E2EAC1;">

			<form id="search" name="search" method="post" action="">

			<!-- Edit by suwondo -->

			  Pencarian data : 

				<label>

					<input name="cr_txt" type="text" id="cr_txt" placeholder="Find by: merk kendaraan" onClick="this.select(); $(this).autocomplete('components/stt/searchCustomer.autocomplete.php', { width: 330 });" size="45" maxlength="100" onKeyUp="javascript: $(this).autocomplete('components/stt/searchCustomer.autocomplete.php', { width: 330 }); $(this).result(function(event, data, formatted){ idx = formatted.split(' - '); window.location.href='index.php?component=stt&task=listCustomer&open=window&cr_kel=ALL&cr_txt='+idx[0]; });" <?php echo $_REQUEST['cr_txt'];?> />
				</label>

				<label><input name="Search" type="submit" id="Search" value="Search" /></label>
			</form>

		<?php

		if(isset($_POST['Search'])) {

			echo "<script>window.location=\"index.php?component=stt&task=listCustomer&open=window&cr_kel=ALL&cr_txt=".str_replace(" ","+",$_POST[cr_txt])."\";</script>";

		}

		?>		</td>
	</tr>

	<tr>

		<th width="65"><strong>No STT</strong></th>
    	<th width="67">Penerima</th>
    	<th width="80"><strong>Layanan</strong></th>
        <th width="74"><strong>Armada</strong></th>
        <th width="96"><strong>Kota Asal</strong></th>
		<th width="116"><strong>Kota Tujuan</strong></th>
    	<th width="116"><strong>Kota Terusan</strong></th>
		<th width="98">Total Charge</th>
		<th width="52" align="center" class="hide"><strong>Aksi</strong></th>
	</tr>

	<?php

	$key = trim($_REQUEST['cr_txt']);

	$query = mysql_query("SELECT IDSTT,NOCONNOTE, NAMAPENERIMA,IDSERVICE,NAMALAYANAN,IDHANDLING,NAMAJNSKIRIM,IDORIGIN,KOTAASAL,IDDESC,KOTATUJUAN,NAMATERUSAN,WEIGHT,TOTAL_CHARGE from v_detailstt WHERE IDCUSTOMER = $customer_id AND IDSTT NOT IN (Select IDSTT from v_invoice_detail) AND NAMAPENERIMA like '%$key%' ORDER BY NOCONNOTE ASC") or die (mysql_error());

	while(list($idstt, $noconnote, $penerima,$idlayanan,$layanan,$idhandling,$jnskirim,$idasal,$asal,$idtujuan,$tujuan,$terusan,$weight,$tcharge) = mysql_fetch_row($query)){

		echo "<tr>";

		echo "<td>$noconnote</td><td>$penerima</td><td>$layanan</td><td>$jnskirim</td><td>$asal</td><td>$tujuan</td><td>$terusan</td><td>$tcharge</td><td align='center'><input type='button' value='pilih' onclick=\"javascript: 
window.opener.document.getElementById('stt').value='$idstt'; 
window.opener.document.getElementById('idservice').value='$idlayanan';
window.opener.document.getElementById('service').value='$layanan';
window.opener.document.getElementById('idtransport').value='$idhandling';
window.opener.document.getElementById('transport').value='$jnskirim';
window.opener.document.getElementById('idorigin').value='$idasal';
window.opener.document.getElementById('origin').value='$asal';
window.opener.document.getElementById('iddestination').value='$idtujuan';
window.opener.document.getElementById('destination').value='$tujuan';
window.opener.document.getElementById('nextdest').value='$terusan';
window.opener.document.getElementById('weight').value='$weight';
window.opener.document.getElementById('tcharge').value='$tcharge';
window.close(1000);\" /></td>";

		echo "</tr>";

	}

	?>
 </table>
