<?php require_once('../connections/con_gl.php'); ?>
<?php
$act = $_GET[act];
$url = "index.php?component=asetperusahaan";

/* Validasi */
if (trim($_POST['golongan']) == '') {
	$error[] = '- Golongan harus diisi !!!';
}
if (trim($_POST['aset']) == '') {
	$error[] = '- Aset harus diisi !!!';
}
if (trim($_POST['tahun']) == '') {
	$error[] = '- Tahun harus diisi !!!';
}
if (trim($_POST['tahun']) <> '' AND !is_numeric($_POST[tahun])) {
	$error[] = '- Tahun harus angka !!!';
}
if (trim($_POST['qty']) == '') {
	$error[] = '- Qty harus diisi !!!';
}
if (trim($_POST['qty']) <> '' AND !is_numeric($_POST[qty])) {
	$error[] = '- QTY harus angka !!!';
}
if (trim($_POST['total']) == '') {
	$error[] = '- Total harus diisi !!!';
}
if (trim($_POST['total']) <> '' AND !is_numeric($_POST[total])) {
	$error[] = '- Total harus angka !!!';
}
/*End validasi */
if (isset($error)) {
	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);
}else{
	if($act =='add') {
	$query = "INSERT INTO gl_aset (id, golID, aset, thn, qty, total, keterangan) VALUES (NULL, '$_POST[golongan]', '$_POST[aset]', '$_POST[tahun]', '$_POST[qty]', '$_POST[total]', '$_POST[keterangan]')";
	}else if($act=='edit'){
	$query ="UPDATE gl_aset SET golID='$_POST[golongan]', thn='$_POST[tahun]', aset='$_POST[aset]', qty='$_POST[qty]', total='$_POST[total]', keterangan='$_POST[keterangan]' WHERE id='$_POST[id]'";
	}else{
	$query = "delete from gl_aset where id='$_POST[id]'";
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