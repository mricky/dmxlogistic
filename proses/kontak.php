<?php require_once('../connections/con_gl.php'); ?>
<?php
$act = $_GET[act];
$url = "index.php?component=kontak";
//$nop = str_replace(" ","",strtoupper($_POST['nama']));
$nop = strtoupper($_POST['nama']);
$ope = $_POST['open'];

/* Validasi */

if (trim($_POST['nama']) == '') {
	$error[] = '- Nama harus diisi !!!';
}
/*
if (trim($_POST['alamat']) == '') {
	$error[] = '- Alamat harus diisi !!!';
}
*/
if (trim($_POST['email']) <> '' AND !eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $_POST[email])){ 
	$error[] = '- Format Email abcde@xxxx.com  !!!';
}
if($act=='add' AND (trim($_POST['nama']) <> '')) {
	// cek no polisi
	mysql_select_db($database_con_gl, $con_gl);
	$query_cekno = "select nama from gl_kontak where nama='$nop'";
	$cekno       = mysql_query($query_cekno, $con_gl);
	$row_cekno   = mysql_fetch_assoc($cekno);
	$total_cekno = mysql_num_rows($cekno);
	if($total_cekno > 0) { 
		$error[] = '- Nama '.$nop.' sudah terdaftar';
	}
}

/*End validasi */
if (isset($error)) {
	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);
}else{
	if($act =='add') {
	$query = "INSERT INTO gl_kontak (id, nama, type, unitkerja, gudang, alamat, tlp, email, npwp, keterangan, tkaryawan) VALUES (NULL, '$_POST[nama]', 'Karyawan', '$_POST[unitkerja]', '74', '$_POST[alamat]', '$_POST[tlp]', '$_POST[email]', '$_POST[npwp]', '$_POST[keterangan]', '$_POST[statkaryawan]')";
	}else if($act=='edit'){
	$query ="UPDATE gl_kontak SET nama='$_POST[nama]', unitkerja='$_POST[unitkerja]', gudang='74', alamat='$_POST[alamat]', tlp='$_POST[tlp]', email='$_POST[email]', npwp='$_POST[npwp]', keterangan='$_POST[keterangan]', tkaryawan='$_POST[statkaryawan]' WHERE id='$_POST[id]'";
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