<?php require_once('../connections/con_gl.php'); ?>
<?php
mysql_select_db($database_con_gl, $con_gl);
$query_cekpk = "SELECT gl_akun.akun FROM gl_akun WHERE gl_akun.id='$_POST[akunID]'";
$cekpk = mysql_query($query_cekpk, $con_gl) or die(mysql_error());
$row_cekpk = mysql_fetch_assoc($cekpk);
$totalRows_cekpk = mysql_num_rows($cekpk);

$act = $_GET[act];
$url = "index.php?component=akun";

/* Validasi */
if (trim($_POST['klasifikasi']) == '') {
	$error[] = '- Klasifikasi harus diisi !!!';
}
if (trim($_POST['akunID']) == '') {
	$error[] = '- Akun ID harus diisi !!!';
}
if($act=='add' AND $totalRows_cekpk > 0) {
	$error[] = '- Akun ID sudah digunakan !!!';
}
if(!is_numeric($_POST[akunID]) AND trim($_POST[akunID])<>'') {
	$error[] = '- Akun ID harus angka !!!';
}
if (trim($_POST['namaAkun']) == '') {
	$error[] = '- Nama Akun harus diisi !!!';
}
if (trim($_POST['saldo']) == '') {
	$error[] = '- Saldo Awal harus diisi !!!';
}
if (trim($_POST['saldo']) <> '' AND !is_numeric($_POST['saldo'])) {
	$error[] = '- Saldo Awal harus angka !!!';
}
/*End validasi */
if (isset($error)) {
	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);
}else{
	if($act =='add') {
	$query = "INSERT INTO gl_akun (id, klasifikasi, akun, aruskas, keterangan, saldoawal, pos) VALUES ('$_POST[akunID]', '$_POST[klasifikasi]', '$_POST[namaAkun]', '$_POST[aruskas]', '$_POST[keterangan]', '$_POST[saldo]', '$_POST[pos]')";
	}else if($act=='edit'){
	$query ="UPDATE gl_akun SET akun='$_POST[namaAkun]', klasifikasi='$_POST[klasifikasi]', keterangan='$_POST[keterangan]', aruskas='$_POST[aruskas]', saldoawal='$_POST[saldo]', pos='$_POST[pos]' WHERE id='$_POST[akunID]'";
	}else{
	$query = "delete from gl_akun where id='$_POST[akunID]'";
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