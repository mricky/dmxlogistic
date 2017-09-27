<?php require_once('../connections/con_gl.php'); ?>
<?php
mysql_select_db($database_con_gl, $con_gl);
$query_cekpk = "SELECT gl_rtrans.no_ref FROM gl_rtrans WHERE gl_rtrans.no_ref='$_POST[noreferensi]'";
$cekpk = mysql_query($query_cekpk, $con_gl) or die(mysql_error());
$row_cekpk = mysql_fetch_assoc($cekpk);
$totalRows_cekpk = mysql_num_rows($cekpk);

$act = $_GET[act];
$url = "index.php?component=transaksiharian";

/* Validasi */
if (trim($_POST['noreferensi']) == '') {
	$error[] = '- No Referensi harus diisi !!!';
}
if (trim($_POST['gudang']) == '') {
	$error[] = '- Lokasi Kantor harus diisi !!!';
}
if (trim($_POST['tanggal']) == '') {
	$error[] = '- Tanggal harus diisi !!!';
}
if($act=='add' AND $totalRows_cekpk > 0) {
	$error[] = '- No Referensi sudah digunakan !!!';
}

/*End validasi */
if (isset($error)) {
	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);
}else{
	if($act =='add') {
	$query = "INSERT INTO gl_rtrans (no_ref, gudang, tgl, keterangan, jenis) VALUES ('$_POST[noreferensi]', '$_POST[gudang]', '$_POST[tanggal]', '$_POST[keterangan]', '$_POST[jenis]')";
	}else if($act=='edit'){
	$query ="UPDATE gl_rtrans SET gudang='$_POST[gudang]', tgl='$_POST[tanggal]', keterangan='$_POST[keterangan]' WHERE no_ref='$_POST[noreferensi]'";
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