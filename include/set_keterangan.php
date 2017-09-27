<?php require_once('../connections/con_gl.php'); ?>
<?php
if($_GET[kontak]<>'') {
$colname_getkontak = "-1";
if (isset($_GET['kontak'])) {
  $colname_getkontak = (get_magic_quotes_gpc()) ? $_GET['kontak'] : addslashes($_GET['kontak']);
}
mysql_select_db($database_con_gl, $con_gl);
$query_getkontak = sprintf("SELECT id, nama FROM gl_kontak WHERE id = %s", $colname_getkontak);
$getkontak = mysql_query($query_getkontak, $con_gl) or die(mysql_error());
$row_getkontak = mysql_fetch_assoc($getkontak);
$totalRows_getkontak = mysql_num_rows($getkontak);
}
?>
<textarea name="keterangan" cols="40" rows="2" id="keterangan">Daftar Transaksi Jurnal <?php echo $row_getkontak['nama']; ?></textarea>
<input name="cid" type="hidden" id="cid" value="<?php echo $row_getkontak['id']; ?>"/>
