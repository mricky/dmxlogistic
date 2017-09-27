<?php require_once('../connections/con_gl.php'); ?>
<?php
mysql_select_db($database_con_gl, $con_gl);
$query_cekpk = "SELECT gl_rtrans.no_ref FROM gl_rtrans WHERE gl_rtrans.no_ref='$_POST[noreferensi]'";
$cekpk = mysql_query($query_cekpk, $con_gl) or die(mysql_error());
$row_cekpk = mysql_fetch_assoc($cekpk);
$totalRows_cekpk = mysql_num_rows($cekpk);

$act = $_GET[act];
$url = "index.php?component=transferkas";

$total = $_POST[total];
$exp_dr = explode("-",$_POST[dari]);
$exp_ke = explode("-",$_POST[ke]);
$trans_dr = "Transfer kas dari ".$exp_dr[1];
$trans_ke = "Transfer kas ke ".$exp_ke[1];
	
/* Validasi */
if (trim($_POST['noreferensi']) == '') {
	$error[] = '- No Referensi harus diisi !!!';
}
if (trim($_POST['tanggal']) == '') {
	$error[] = '- Tanggal harus diisi !!!';
}
if($act=='add' AND $totalRows_cekpk > 0) {
	$error[] = '- No Referensi sudah digunakan !!!';
}
if (trim($_POST['ke']) == '') {
	$error[] = '- Ke (Debet) harus dipilih!!';
}
if (trim($_POST['dari']) == '') {
	$error[] = '- Dari (Kredit) harus dipilih !!!';
}
if (trim($_POST['gudang']) == '') {
	$error[] = '- Lokasi Kantor harus dipilih !!!';
}
if (trim($_POST['total']) == '') {
	$error[] = '- Total harus diisi !!!';
}
if (trim($_POST['total']) <> '' AND !is_numeric($_POST['total'])) {
	$error[] = '- Total harus angka !!!';
}
/*End validasi */
if (isset($error)) {
	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);
}else{
	if($act =='add') {
	$query = "INSERT INTO gl_rtrans (no_ref, tgl, gudang, keterangan, jenis) VALUES ('$_POST[noreferensi]', '$_POST[tanggal]', '$_POST[gudang]', '$_POST[keterangan]', '$_POST[jenis]')";
  	mysql_query("INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun) VALUES (NULL, '$_POST[noreferensi]', '$trans_dr', '$total', 'K', '$exp_dr[0]')", $con_gl);
  	mysql_query("INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun) VALUES (NULL, '$_POST[noreferensi]', '$trans_ke', '$total', 'D', '$exp_ke[0]')", $con_gl);
	}else if($act=='edit'){
	$query ="UPDATE gl_rtrans SET tgl='$_POST[tanggal]', gudang='$_POST[gudang]', keterangan='$_POST[keterangan]' WHERE no_ref='$_POST[noreferensi]'";
	mysql_query("UPDATE gl_trans SET total= '$total', transaksi= '$trans_dr', akun= '$exp_dr[0]' WHERE id='$_POST[id_d]'", $con_gl);
    mysql_query("UPDATE gl_trans SET total= '$total', transaksi= '$trans_ke', akun= '$exp_ke[0]' WHERE id='$_POST[id_k]'", $con_gl);
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