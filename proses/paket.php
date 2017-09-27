<?php require_once('../connections/con_gl.php'); ?>

<?php

$act = $_GET[act];

$url = "index.php?component=paket";

//$nop = str_replace(" ","",strtoupper($_POST['unitkerja']));

$nop = strtoupper($_POST['nama']);

$ope = $_POST['open'];



/* Validasi */



if($act=='add' AND (trim($_POST['nama']) <> '')) {

	// cek no polisi

	mysql_select_db($database_con_gl, $con_gl);

	$query_cekno = "select jenis_paket_name from jenis_paket where jenis_paket_name='$nop'";

	$cekno       = mysql_query($query_cekno, $con_gl);

	$row_cekno   = mysql_fetch_assoc($cekno);

	$total_cekno = mysql_num_rows($cekno);

	if($total_cekno > 0) { 

		$error[] = '- Nama Paket  '.$nop.' sudah terdaftar';

	}

}



/*End validasi */

if (isset($error)) {

	echo "<b>Error</b>: <br />".implode("<br />", $error);

}else{

	if($act =='add') {

	$query = "INSERT INTO jenis_paket (jenis_paket_name) VALUES ('$_POST[nama]')";

	}else if($act=='edit'){

	$query ="UPDATE jenis_paket SET jenis_paket_name='$_POST[nama]' WHERE jenis_paket_id='$_POST[id]'";

	}else{

	$query = "delete from jenis_paket where jenis_paket_id='$_POST[id]'";
	///printf($query);

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