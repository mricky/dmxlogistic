<?php require_once('../connections/con_gl.php'); ?>

<?php

$act = $_GET[act];

$url = "index.php?component=satuan";

//$nop = str_replace(" ","",strtoupper($_POST['unitkerja']));

$nop = strtoupper($_POST['nama']);

$ope = $_POST['open'];



/* Validasi */

if (trim($_POST['kode']) == '') {

	$error[] = '- Kode Satuan harus diisi';

}

if($act=='add' AND (trim($_POST['nama']) <> '')) {

	// cek no polisi

	mysql_select_db($database_con_gl, $con_gl);

	$query_cekno = "select NAMASATUAN from satuan where NAMASATUAN='$nop'";

	$cekno       = mysql_query($query_cekno, $con_gl);

	$row_cekno   = mysql_fetch_assoc($cekno);

	$total_cekno = mysql_num_rows($cekno);

	if($total_cekno > 0) { 

		$error[] = '- Nama Satuan  '.$nop.' sudah terdaftar';

	}

}



/*End validasi */

if (isset($error)) {

	echo "<b>Error</b>: <br />".implode("<br />", $error);

}else{

	if($act =='add') {

	$query = "INSERT INTO satuan (KODESATUAN, NAMASATUAN) VALUES ('$_POST[kode]', '$_POST[nama]')";

	}else if($act=='edit'){

	$query ="UPDATE satuan SET KODESATUAN='$_POST[kode]', NAMASATUAN='$_POST[nama]' WHERE SATUAN_ID='$_POST[id]'";

	}else{

	$query = "delete from satuan where SATUAN_ID='$_POST[id]'";

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