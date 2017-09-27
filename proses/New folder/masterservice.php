<?php require_once('../connections/con_gl.php'); ?>
<?php
$act = $_GET[act];
$url = "index.php?component=masterservice";
$nop = str_replace(" ","",strtoupper($_POST['nopol']));
$ada = intval($_POST['ada']);
/* Validasi */
if (trim($_POST['nopol']) == '') {
	$error[] = '- No. Polisi harus diisi';
}
if($act=='add' AND (trim($_POST['nopol']) <> '')) {
	// cek no polisi
	mysql_select_db($database_con_gl, $con_gl);
	$query_cekno = "select nopol from gl_kendaraan where nopol='$nop";
	$cekno       = mysql_query($query_cekno, $con_gl);
	$row_cekno   = mysql_fetch_assoc($cekno);
	$total_cekno = mysql_num_rows($cekno);
	if($total_cekno > 0) { 
		$error[] = '- No. Polisi '.$nop.' sudah digunakan';
	}
}
if (trim($_POST['jenis']) == '') {
	$error[] = '- Jenis Kendaraan harus diisi';
}
if (trim($_POST['tipe']) == '') {
	$error[] = '- Tipe harus diisi';
}
if (trim($_POST['rangka']) == '') {
	$error[] = '- No. Rangka harus diisi';
}
if (trim($_POST['mesin']) == '') {
	$error[] = '- No. Mesin harus diisi';
}
/*End validasi */
if (isset($error)) {
	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);
}else{
	if($act =='add') {
	$query = "INSERT INTO gl_kendaraan (nopol,jenis,tipe,rangka,mesin,keterangan,tersedia) VALUES ('$nop','$_POST[jenis]','$_POST[tipe]','$_POST[rangka]','$_POST[mesin]','$_POST[keterangan]','$ada')";
	}else if($act=='edit'){
	$query ="UPDATE gl_kendaraan SET jenis='$_POST[jenis]', tipe='$_POST[tipe]', rangka='$_POST[rangka]', mesin='$_POST[mesin]', keterangan='$_POST[keterangan]', tersedia='$ada' WHERE nopol='$_POST[nopol]'";
	}else{
	$query = "delete from gl_kendaraan where nopol='$_POST[nopol]'";
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