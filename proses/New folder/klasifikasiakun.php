<?php require_once('../connections/con_gl.php'); ?>
<?php
mysql_select_db($database_con_gl, $con_gl);
$query_cekpk = "SELECT gl_klas.kd FROM gl_klas WHERE gl_klas.kd='$_POST[kode]'";
$cekpk = mysql_query($query_cekpk, $con_gl) or die(mysql_error());
$row_cekpk = mysql_fetch_assoc($cekpk);
$totalRows_cekpk = mysql_num_rows($cekpk);

$act = $_GET[act];
$url = "index.php?component=klasifikasiakun";

/* Validasi */
if (trim($_POST['kode']) == '') {
	$error[] = '- Kode harus diisi !!!';
}
if($act=='add' AND $totalRows_cekpk > 0) {
	$error[] = '- Kode sudah digunakan !!!';
}
if(!is_numeric($_POST[kode])) {
	$error[] = '- Kode harus angka !!!';
}
if (trim($_POST['klasifikasi']) == '') {
	$error[] = '- Klasifikasi harus diisi !!!';
}

/*End validasi */
if (isset($error)) {
	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);
}else{
	if($act =='add') {
	$query = "INSERT INTO gl_klas (kd, klasifikasi, neraca, ruglab, tipe, keterangan) VALUES ('$_POST[kode]', '$_POST[klasifikasi]', '$_POST[neraca]', '$_POST[rugilaba]', '$_POST[tipe]', '$_POST[keterangan]')";
	}else if($act=='edit'){
	$query ="UPDATE gl_klas SET klasifikasi='$_POST[klasifikasi]', neraca='$_POST[neraca]', ruglab='$_POST[rugilaba]', tipe='$_POST[tipe]', keterangan='$_POST[keterangan]' WHERE kd='$_POST[kode]'";
	}else{
	$query = "delete from gl_klas where kd='$_POST[kode]'";
	}
	mysql_select_db($database_con_gl, $con_gl);
	$runquery = mysql_query($query, $con_gl);
	if($runquery) {
		echo "<img src=\"images/ok.png\" align=\"left\" width=\"16\">&nbsp;&nbsp;Data berhasil ";if($act=='add' OR $act=='edit') { echo "disimpan";}else{ echo "dihapus"; } echo " ...";
	}else{
		echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal disimpan !!!";
	}
}
?>
<?php if($runquery) { ?><script type="text/javascript">setTimeout("location.href='<?php echo $url;?>'", 2000);</script><?php } ?>