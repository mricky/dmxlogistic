<?php require_once('../connections/con_gl.php'); ?>
<?php
mysql_select_db($database_con_gl, $con_gl);
$query_cek_r = "SELECT gl_rtrans.no_ref, gl_gudang.gudang, gl_trans.transaksi, gl_barang.barang, gl_satuan.satuan, gl_kontak.nama FROM gl_rtrans, gl_gudang, gl_trans, gl_barang, gl_satuan, gl_kontak WHERE gl_gudang.id=gl_rtrans.gudang AND gl_trans.no_ref=gl_rtrans.no_ref AND gl_barang.id = gl_trans.barang AND gl_satuan.id =gl_trans.satuan AND gl_kontak.id=gl_rtrans.kontak AND gl_rtrans.jenis=7 AND gl_rtrans.gudang='$_GET[gudang]' AND gl_rtrans.kontak='$_GET[kontak]' AND gl_trans.barang='$_GET[barang]' AND gl_trans.satuan='$_GET[satuan]'";
$cek_r = mysql_query($query_cek_r, $con_gl) or die(mysql_error());
$row_cek_r = mysql_fetch_assoc($cek_r);
$totalRows_cek_r = mysql_num_rows($cek_r);

mysql_select_db($database_con_gl, $con_gl);
$query_cek_hut = "SELECT gl_trans.no_ref, gl_trans.total FROM gl_trans WHERE gl_trans.no_ref='$row_cek_r[no_ref]' AND gl_trans.transaksi LIKE '%Piutang%'";
$cek_hut = mysql_query($query_cek_hut, $con_gl) or die(mysql_error());
$row_cek_hut = mysql_fetch_assoc($cek_hut);
$totalRows_cek_hut = mysql_num_rows($cek_hut);
?>
<?php if($totalRows_cek_r > 0 AND $totalRows_cek_hut > 0) { ?>
<label><input name="add" type="button" id="add" value="&nbsp;" onclick="ajaxManageReturPenjualan('Tambah');" class="checkbutton" title="Tambah Transaksi"/></label><input name="xx_ref" type="hidden" id="xx_ref" value="<?php echo $row_cek_hut['no_ref']; ?>" />
<?php }else{ ?>
<img src="images/delete.png" border="0" title="Error Retur"/>
<?php } ?>
