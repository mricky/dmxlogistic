<?php require_once('../connections/con_gl.php'); ?>
<?php
$act = $_GET[act];
$url = "index.php?component=kelompokbarang";

/* Validasi */
if (trim($_POST['kelompok']) == '') {
	$error[] = '- Kelompok Barang harus diisi';
}

/*End validasi */
if (isset($error)) {
	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);
}else{
	if($act =='add') {
	$query = "INSERT INTO gl_kelompok (id, kelompok, keterangan, ak_sedia, ak_beli, ak_jual, jual, jenis, metode) VALUES (NULL, '$_POST[kelompok]', '$_POST[keterangan]', '$_POST[persediaan]', '$_POST[pembelian]', '$_POST[penjualan]', '$_POST[RadioGroup1]', '$_POST[RadioGroup2]','$_POST[metode]')";
	}else if($act=='edit'){
	$query ="UPDATE gl_kelompok SET kelompok='$_POST[kelompok]', keterangan='$_POST[keterangan]', ak_sedia='$_POST[persediaan]', ak_beli='$_POST[pembelian]', ak_jual='$_POST[penjualan]', jual='$_POST[RadioGroup1]', jenis='$_POST[RadioGroup2]', metode='$_POST[metode]' WHERE id='$_POST[id]'";
	}else{
	$query = "delete from gl_kelompok where id='$_POST[id]'";
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