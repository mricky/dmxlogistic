<?php require_once('../connections/con_gl.php'); ?>
<?php
mysql_select_db($database_con_gl, $con_gl);
$query_cekpk = "SELECT gl_rtrans.no_ref FROM gl_rtrans WHERE gl_rtrans.no_ref='$_POST[noreferensi]'";
$cekpk = mysql_query($query_cekpk, $con_gl) or die(mysql_error());
$row_cekpk = mysql_fetch_assoc($cekpk);
$totalRows_cekpk = mysql_num_rows($cekpk);

$act = $_GET[act];
$url = "index.php?component=pembayaranpiutang";

/* Validasi */
if (trim($_POST['akunkas']) == '') {
	$error[] = '- Akun Kas harus dipilih !!!';
}
if (trim($_POST['kepada']) == '') {
	$error[] = '- Agen harus dipilih !!!';
}
if (trim($_POST['noreferensi']) == '') {
	$error[] = '- No Referensi harus diisi !!!';
}
if (trim($_POST['tanggal']) == '') {
	$error[] = '- Tanggal harus diisi !!!';
}
if($act=='add' AND $totalRows_cekpk > 0) {
	$error[] = '- No Referensi sudah digunakan !!!';
}
if ($_POST['total']==0) {
	$error[] = '- Isi Transaksi dahulu !!!';
}
/*End validasi */
if (isset($error)) {
	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);
}else{
	if($act =='add') {
	$query = "INSERT INTO gl_rtrans (no_ref, tgl, keterangan, kontak, jenis, gudang) VALUES ('$_POST[noreferensi]', '$_POST[tanggal]', '$_POST[keterangan]', '$_POST[kepada]', '$_POST[jenis]','$_POST[gudang]')";
	$query_add = "INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun) VALUES (NULL, '$_POST[noreferensi]', '$_POST[keterangan]', '$_POST[total]', 'D', '$_POST[akunkas]')";
  mysql_query($query_add, $con_gl);
	}else if($act=='edit'){
	$query ="UPDATE gl_rtrans SET tgl='$_POST[tanggal]', kontak='$_POST[kepada]', keterangan='$_POST[keterangan]' WHERE no_ref='$_POST[noreferensi]'";
	$query_edit = "update gl_trans set akun='$_POST[akunkas]', transaksi='$_POST[keterangan]', total='$_POST[total]' where id='$_POST[id_k]'";
  mysql_query($query_edit, $con_gl);
	}else{
	$query = "delete from gl_rtrans where no_ref='$_POST[noreferensi]'";
	$query2 = "delete from gl_trans where no_ref='$_POST[noreferensi]'";
	}
	mysql_select_db($database_con_gl, $con_gl);
	$runquery = mysql_query($query, $con_gl);
	if($query2 <>'') {
		mysql_query($query2, $con_gl);
	}
	if($runquery) {
		echo "<img src=\"images/ok.png\" align=\"left\" width=\"16\">&nbsp;&nbsp;Data berhasil ";if($act=='add' OR $act=='edit') { echo "disimpan";}else{ echo "dihapus"; } echo " ...";
	}else{
		echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal disimpan !!!";
	}
}
?>
<?php if($runquery) { ?><script type="text/javascript">setTimeout("location.href='<?php echo $url;?>'", 2000);</script><?php } ?>