<?php require_once('../connections/con_gl.php'); ?>
<?php
$act = $_GET[act];
$url = "index.php?component=kontak&cr_klas=".$_POST['type'];
$akt = intval($_POST['aktif']);
$inp = $_POST['tglinput'];

/* Validasi */
if ((trim($_POST['type']) == 'Karyawan') AND (trim($_POST['lkantor']) == '')) {
	$error[] = '- Lokasi Kantor harus diisi !!!';
}
if ((trim($_POST['type']) == 'Customer') AND (trim($_POST['tcus']) == '')) {
	$error[] = '- Tipe Customer harus diisi !!!';
}
if (trim($_POST['nama']) == '') {
	$error[] = '- Nama harus diisi !!!';
}
if (trim($_POST['alamat']) == '') {
	$error[] = '- Alamat harus diisi !!!';
}
if (trim($_POST['email']) <> '' AND !eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $_POST[email])){ 
	$error[] = '- Format Email abcde@xxxx.com  !!!';
}

/*End validasi */
if (isset($error)) {
	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);
}else{
	if($act =='add') {
	$query = "INSERT INTO gl_kontak (id, nama, type, gudang, alamat, tlp, email, npwp, keterangan, tcustomer, tkaryawan, tgl_daftar, aktif) VALUES (NULL, '$_POST[nama]', '$_POST[type]', '$_POST[lkantor]', '$_POST[alamat]', '$_POST[tlp]', '$_POST[email]', '$_POST[npwp]', '$_POST[keterangan]', '$_POST[tcus]', '$_POST[jkar]', '$inp', '$akt')";
	}else if($act=='edit'){
	$query ="UPDATE gl_kontak SET nama='$_POST[nama]', type='$_POST[type]', gudang='$_POST[lkantor]', alamat='$_POST[alamat]', tlp='$_POST[tlp]', email='$_POST[email]', npwp='$_POST[npwp]', keterangan='$_POST[keterangan]', tcustomer='$_POST[tcus]', tkaryawan='$_POST[jkar]', tgl_daftar='$inp', aktif='$akt' WHERE id='$_POST[id]'";
	}else{
	$query = "delete from gl_kontak where id='$_POST[id]'";
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