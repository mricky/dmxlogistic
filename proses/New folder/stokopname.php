<?php require_once('../connections/con_gl.php'); ?>
<?php
$act = $_GET[act];
$url = "index.php?component=stokopname";

/* Validasi */
if (trim($_POST['buku']) == '') {
	$error[] = '- Stok(Buku) harus diisi !!!';
}
if (trim($_POST['buku']) <> '' AND !is_numeric($_POST[buku])) {
	$error[] = '- Stok(Buku) harus angka !!!';
}
if (trim($_POST['fisik']) == '') {
	$error[] = '- Stok(Fisik) harus diisi !!!';
}
if (trim($_POST['fisik']) <> '' AND !is_numeric($_POST[fisik])) {
	$error[] = '- Stok(Fisik) harus angka !!!';
}
/*End validasi */
if (isset($error)) {
	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);
}else{
	if($act =='add') {
	//$query = "INSERT INTO gl_akun (id, klasifikasi, akun, aruskas, keterangan) VALUES ('$_POST[akunID]', '$_POST[klasifikasi]', '$_POST[namaAkun]', '$_POST[aruskas]', '$_POST[keterangan]')";
	}else if($act=='edit'){
	$query ="UPDATE gl_stok SET stok='$_POST[buku]', fisik='$_POST[fisik]' WHERE id='$_POST[id]'";
	}else{
	//$query = "delete from gl_akun where id='$_POST[akunID]'";
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