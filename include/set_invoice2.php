<?php require_once('../connections/con_gl.php'); ?>
<?php
mysql_select_db($database_con_gl, $con_gl);
$query_invoi = "SELECT no_ref, keterangan FROM gl_rtrans WHERE jenis = 7  AND gl_rtrans.no_ref LIKE '%SJ%' AND gl_rtrans.kontak ='$_GET[kontak]' AND gl_rtrans.jatuhtempo <>'' ORDER BY gl_rtrans.no_ref";
$invoi = mysql_query($query_invoi, $con_gl) or die(mysql_error());
$row_invoi = mysql_fetch_assoc($invoi);
$totalRows_invoi = mysql_num_rows($invoi);
?><label>
<select name="invoice" id="invoice" style="width:400px;" onChange="hitungPiutang(this.value);setTransaksi(this.value)">
  <option value="" style="background:#EEEEEE;font-weight:bold;">Pilih Invoice</option>
  <?php if($totalRows_invoi > 0) { ?>
  <?php
do {  

mysql_select_db($database_con_gl, $con_gl);
$query_totalbyr = "SELECT sum(gl_trans.total) FROM gl_trans where x_ref='$row_invoi[no_ref]'";
$totalbyr = mysql_query($query_totalbyr, $con_gl) or die(mysql_error());
$row_totalbyr = mysql_fetch_assoc($totalbyr);
$totalRows_totalbyr = mysql_num_rows($totalbyr);

mysql_select_db($database_con_gl, $con_gl);
$query_totalhut = "SELECT gl_trans.total FROM gl_trans WHERE gl_trans.no_ref='$row_invoi[no_ref]' AND gl_trans.pos='D' AND gl_trans.transaksi LIKE '%Piutang%'";
$totalhut = mysql_query($query_totalhut, $con_gl) or die(mysql_error());
$row_totalhut = mysql_fetch_assoc($totalhut);
$totalRows_totalhut = mysql_num_rows($totalhut);

mysql_select_db($database_con_gl, $con_gl);
$query_bayar = "SELECT sum(gl_trans.total) FROM gl_trans WHERE gl_trans.x_ref='$row_invoi[no_ref]' AND gl_trans.pos='K'";
$bayar = mysql_query($query_bayar, $con_gl) or die(mysql_error());
$row_bayar = mysql_fetch_assoc($bayar);
$totalRows_bayar = mysql_num_rows($bayar);

mysql_select_db($database_con_gl, $con_gl);
$query_getbrg = "SELECT gl_trans.id, gl_barang.barang FROM gl_trans, gl_barang WHERE gl_trans.no_ref='$row_invoi[no_ref]' AND gl_barang.id=gl_trans.barang ORDER BY gl_trans.id";
$getbrg = mysql_query($query_getbrg, $con_gl) or die(mysql_error());
$row_getbrg = mysql_fetch_assoc($getbrg);
$totalRows_getbrg = mysql_num_rows($getbrg);
$listbrg ="";
	do {
		$listbrg .= $row_getbrg['barang'].",";
	} while ($row_getbrg = mysql_fetch_assoc($getbrg));
?>
<?php
$hutbal = $row_totalhut['total'] - $row_totalbyr['sum(gl_trans.total)'];
 if($hutbal > 0) { ?>
  <option value="<?php echo $row_invoi['no_ref']?>"><?php echo $row_invoi['no_ref']?> - <?php echo $listbrg;?></option>
<?php } ?>
  <?php
} while ($row_invoi = mysql_fetch_assoc($invoi));
  $rows = mysql_num_rows($invoi);
  if($rows > 0) {
      mysql_data_seek($invoi, 0);
	  $row_invoi = mysql_fetch_assoc($invoi);
  }
?>
<?php } ?>
</select>
</label>