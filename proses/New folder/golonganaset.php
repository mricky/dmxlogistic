<?php require_once('../connections/con_gl.php'); ?>
<?php
$act = $_GET[act];
$url = "index.php?component=golonganaset";

/* Validasi */
if (trim($_POST['golongan']) == '') {
	$error[] = '- Golongan harus diisi !!!';
}
if (trim($_POST['umur']) == '') {
	$error[] = '- Umur harus diisi !!!';
}
if (trim($_POST['umur']) <> '' AND !is_numeric($_POST[umur])) {
	$error[] = '- Umur harus angka !!!';
}
if (trim($_POST['bobot']) == '') {
	$error[] = '- Bobot harus diisi !!!';
}
if (trim($_POST['bobot']) <> '' AND !is_numeric($_POST[bobot])) {
	$error[] = '- Bobot harus angka !!!';
}
/*End validasi */
if (isset($error)) {
	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);
}else{
	if($act =='add') {
	$query = "INSERT INTO gl_gol (id, golongan, jangka, bobot, metode) VALUES (NULL, '$_POST[golongan]', '$_POST[umur]', '$_POST[bobot]', '$_POST[metode]')";
	}else if($act=='edit'){
	$query ="UPDATE gl_gol SET golongan='$_POST[golongan]', jangka='$_POST[umur]', bobot='$_POST[bobot]', metode='$_POST[metode]' WHERE id='$_POST[id]'";
	}else{
	$query = "delete from gl_gol where id='$_POST[id]'";
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