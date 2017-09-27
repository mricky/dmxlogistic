<?php
// session_start();
 require_once('../connections/con_gl.php'); ?>
<?php include('../connections/config.php'); ?>
<?php
$act = $_GET[act];
$url = base_url("index.php?component=piutang");
//$nop = str_replace(" ","",strtoupper($_POST['merk']));
$id = strtoupper($_POST['id']);
$ope = $_POST['open'];

/* Validasi */
if(($act =='bayar'))
{
	
	if(intval($_POST['nominalbayar'] > intval($_POST['kekurangan'])))
	
	 
		{
			$error[] = '- Pembayaran melebihi nominal sisa pembayaran !!!';
		}
		
}
if(($act =='add') || ($act == 'edit')) { 
	if (trim($_POST['noinvoice']) == '') {
		$error[] = '- No Invoice harus diisi !!!';
	}
	if (trim($_POST['tanggaldatanginvoice']) == '') {
		$error[] = '- Tanggal Datang Invoice harus diisi !!!';
	}
	if (trim($_POST['tanggalinvoice']) == '') {
		$error[] = '- Tanggal Invoice harus diisi !!!';
	}
	if (trim($_POST['idagent']) == '') {
		$error[] = '- Agent Invoice harus diisi !!!';
	}
	if (trim($_POST['nominal']) == '') {
		$error[] = '- Nominal tidak boleh 0 !!!';
	}
	if (trim($_POST['keterangan']) == '') {
		$error[] = '- Keterangan harus diisi !!!';
	}
		/*
		mysql_select_db($database_con_gl, $con_gl);
		$query_cekno = "select NOINV from tagihan where NOINV='$_POST[noinvoice]'";
		$cekno       = mysql_query($query_cekno, $con_gl);
		$total_cekno = mysql_num_rows($cekno);
		
		if($total_cekno > 0) { 
			$error[] = '- No Invoice '.$nop.' sudah terdaftar pembayaran';
			
		}
		*/
		
	
	
	
}

/*End validasi */
if (isset($error)) {
	echo "<b>Error</b>: <br />".implode("<br />", $error);
}else{
	
	if($act =='add') {
	
	
	$now = strtotime('now');
	$query = "INSERT INTO transaksipembayaran (IDSTT,NOTRANSAKSI,NOTRANSFER,TGLBAYAR,IDMETODEBAYAR,IDJENISBAYAR,TOTALBAYAR,CREATED_BY,CREATED_AT) VALUES ('$_POST[idagent]','$_POST[tanggaldatanginvoice]','$_POST[tanggalinvoice]','$_POST[noinvoice]','$_POST[nominal]','$_SESSION[nama]','$now')";
	
	
	}else if($act=='edit'){
	$query ="UPDATE gl_pengeluaranuang SET tgl='$_POST[tgl]',id_jenis='$_POST[jenispengeluaran]',notransaksi='$_POST[notransaksi]',nobukti='$_POST[nobukti]',nominal='$_POST[nominal]',keterangan='$_POST[keterangan]',updated_by = '$_SESSION[nama]', updated_at = '$today' WHERE id='$_POST[idpengeluaran]'";
	
	}else if($act=='bayar'){
	
		 $now = strtotime('now');
	     $NOTRANSAKSI = "CI-".strtotime('now');
	  // cash out
	  $query = "INSERT INTO transaksipembayaran (IDSTT,NOTRANSAKSI,NOTRANSFER,TGLBAYAR,IDMETODEBAYAR,IDJENISBAYAR,TOTALBAYAR,KETERANGAN,CREATED_BY,CREATED_AT) VALUES ($_GET[IDSTT],'$NOTRANSAKSI','$_POST[notransfer]','$_POST[tanggalbayar]','$_POST[cr_tipebayar]','$_POST[cr_jenisbayar]','$_POST[nominalbayar]','$_POST[keterangan]','$_SESSION[nama]','$now')";
	
		// die($query);
		// update stt 
		/*
		$queryUdate = "update detailstt set IDSTATUSBAYAR = 1 where IDSTT = $_GET[IDSTT]";
		printf($queryUpdate);
		die($queryUpdate);
		mysql_select_db($database_con_gl, $con_gl);
		$runqueryUpdate = mysql_query($queryUpdate, $con_gl);
		*/
	}
	
	else{
	$query = "delete from gl_pengeluaranuang where id='$_POST[id]'";
	}
	mysql_select_db($database_con_gl, $con_gl);
	$runquery = mysql_query($query, $con_gl);
	
	if($runquery ) {
			echo "<img src=\"images/ok.png\" align=\"left\" width=\"16\">&nbsp;&nbsp;Data berhasil disimpan ...";
			echo "<script type=\"text/javascript\">setTimeout(\"window.close();\", 2000);</script>";
	}else{
		echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal disimpan !!!";
			echo "<script type=\"text/javascript\">setTimeout(\"window.close();\", 2000);</script>";
	}
	//window.close();
	
}
?>
