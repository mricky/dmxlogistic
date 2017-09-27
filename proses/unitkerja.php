<?php require_once('../connections/con_gl.php'); ?>
<?php
$act = $_GET[act];
$url = "index.php?component=unitkerja";
//$nop = str_replace(" ","",strtoupper($_POST['unitkerja']));
$nop = strtoupper($_POST['unitkerja']);
$ope = $_POST['open'];

/* Validasi */
if (trim($_POST['unitkerja']) == '') {
	$error[] = '- Unit Kerja harus diisi';
}
if($act=='add' AND (trim($_POST['unitkerja']) <> '')) {
	// cek no polisi
	mysql_select_db($database_con_gl, $con_gl);
	$query_cekno = "select unitkerja from gl_unitkerja where unitkerja='$nop'";
	$cekno       = mysql_query($query_cekno, $con_gl);
	$row_cekno   = mysql_fetch_assoc($cekno);
	$total_cekno = mysql_num_rows($cekno);
	if($total_cekno > 0) { 
		$error[] = '- Unit Kerja  '.$nop.' sudah terdaftar';
	}
}

/*End validasi */
if (isset($error)) {
	echo "<b>Error</b>: <br />".implode("<br />", $error);
}else{
	if($act =='add') {
	$query = "INSERT INTO gl_unitkerja (id, unitkerja, keterangan) VALUES (NULL, '$_POST[unitkerja]', '$_POST[keterangan]')";
	}else if($act=='edit'){
	$query ="UPDATE gl_unitkerja SET unitkerja='$_POST[unitkerja]', keterangan='$_POST[keterangan]' WHERE id='$_POST[id]'";
	}else{
	$query = "delete from gl_unitkerja where id='$_POST[id]'";
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