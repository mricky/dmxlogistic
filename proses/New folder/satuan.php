<?php require_once('../connections/con_gl.php'); ?>
<?php
$act = $_GET[act];
$url = "index.php?component=satuan";

/* Validasi */
if (trim($_POST['satuan']) == '') {
	$error[] = '- Satuan Barang harus diisi';
}

/*End validasi */
if (isset($error)) {
	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);
}else{
	if($act =='add') {
	$query = "INSERT INTO gl_satuan (id, satuan, keterangan) VALUES (NULL, '$_POST[satuan]', '$_POST[keterangan]')";
	}else if($act=='edit'){
	$query ="UPDATE gl_satuan SET satuan='$_POST[satuan]', keterangan='$_POST[keterangan]' WHERE id='$_POST[id]'";
	}else{
	$query = "delete from gl_satuan where id='$_POST[id]'";
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