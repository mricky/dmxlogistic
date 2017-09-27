<?php require_once('../connections/con_gl.php'); ?>
<?php
mysql_select_db($database_con_gl, $con_gl);
$query_cekpk = "SELECT gl_rtrans.no_ref FROM gl_rtrans WHERE gl_rtrans.no_ref='$_POST[noreferensi]'";
$cekpk = mysql_query($query_cekpk, $con_gl) or die(mysql_error());
$row_cekpk = mysql_fetch_assoc($cekpk);
$totalRows_cekpk = mysql_num_rows($cekpk);

$act = $_GET[act];
$url = "index.php?component=returpembelian";

/* Validasi */
if (trim($_POST['akun']) == '') {
	$error[] = '- Akun harus dipilih !!!';
}
if (trim($_POST['akunhutang']) == '') {
	$error[] = '- Akun Hutang harus dipilih !!!';
}
if (trim($_POST['dari']) == '') {
	$error[] = '- Kontak harus dipilih !!!';
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
if ($_POST['totalretur']==0) {
	$error[] = '- Isi Transaksi dahulu !!!';
}
/*End validasi */
if (isset($error)) {
	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);
}else{
	if($act =='add') {
	mysql_select_db($database_con_gl, $con_gl);
	$query_getkpd = "SELECT gl_kontak.nama FROM gl_kontak WHERE gl_kontak.id='$_POST[dari]'";
	$getkpd = mysql_query($query_getkpd, $con_gl) or die(mysql_error());
	$row_getkpd = mysql_fetch_assoc($getkpd);

	$query = "INSERT INTO gl_rtrans (no_ref, tgl, keterangan, gudang, kontak, jenis) VALUES ('$_POST[noreferensi]', '$_POST[tanggal]', '$_POST[keterangan]', '$_POST[gudang]', '$_POST[dari]', '$_POST[jenis]')";
	$query_add = "INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun) VALUES (NULL, '$_POST[noreferensi]', '$_POST[keterangan]', '$_POST[totalretur]', 'D', '$_POST[akunhutang]')";
  mysql_query($query_add, $con_gl);
	}else if($act=='edit'){
	$query ="UPDATE gl_rtrans SET tgl='$_POST[tanggal]', keterangan='$_POST[keterangan]', jenis='$_POST[jenis]', gudang='$_POST[gudang]', kontak='$_POST[dari]' WHERE no_ref='$_POST[noreferensi]'";
	$query_edit = "update gl_trans set transaksi='$_POST[keterangan]', total='$_POST[totalretur]', akun='$_POST[akunhutang]' where id='$_POST[idhutang]'";
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