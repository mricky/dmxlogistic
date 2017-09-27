<?php require_once('../connections/con_gl.php'); ?>
<?php
$act = $_GET[act];
$url = "index.php?component=errorreport";

/* Validasi */
if (trim($_POST['nama']) == '') {
	$error[] = '- Nama Pelapor harus diisi';
}
if (trim($_POST['departemen']) == '') {
	$error[] = '- Unit Kerja / Departemen Pelapor harus diisi';
}
if (trim($_POST['modul']) == '') {
	$error[] = '- Modul harus diisi';
}
if (trim($_POST['submodul']) == '') {
	$error[] = '- Submdul harus diisi';
}
if (trim($_POST['keterangan']) == '') {
	$error[] = '- Mohon dijelaskan error & saran anda';
}

/*End validasi */
if (isset($error)) {
	echo "<b>Error</b>: <br />".implode("<br />", $error);
}else{
	if($act =='add') {
	$query = "INSERT INTO gl_errorreport (id, tanggal, nama, departemen, modul, submodul, keterangan) VALUES (NULL, '$_POST[tanggal]', '$_POST[nama]', '$_POST[departemen]', '$_POST[modul]', '$_POST[submodul]', '$_POST[keterangan]')";
	}else if($act=='edit'){
	$query ="UPDATE gl_errorreport SET tanggal='$_POST[tanggal]', nama='$_POST[nama]', departemen='$_POST[departemen]', modul='$_POST[modul]', submodul='$_POST[submodul]', keterangan='$_POST[keterangan]' WHERE id='$_POST[id]'";
	}else{
	$query = "delete from gl_errorreport where id='$_POST[id]'";
	}
	mysql_select_db($database_con_gl, $con_gl);
	$runquery = mysql_query($query, $con_gl);
	if($runquery) {
		echo "<img src=\"images/ok.png\" align=\"middle\"> Data berhasil disimpan ...";
	}else{
		echo "<img src=\"images/alert.png\" align=\"middle\"> Data gagal disimpan !!!";
	}
}
?>
<?php if($runquery) { ?><script type="text/javascript">setTimeout("location.href='<?php echo $url;?>'", 2000);</script><?php } ?>