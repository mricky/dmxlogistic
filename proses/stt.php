<?php
// session_start();
 require_once('../connections/con_gl.php');require './phpmailer/PHPMailerAutoload.php'; ?>
<?php include('../connections/config.php'); ?>
<?php
$act = $_GET[act];
$url = base_url("index.php?component=stt");
echo $act;


// -- validasi
if(($act =='add') || ($act == 'edit')) { 
	
	if (trim($_POST['nostt']) == '') {
		$error[] = '- NO STT harus diisi !!!';
	}
	
	if (trim($_POST['idcustomer']) == '') {
		$error[] = '- Customer harus diisi !!!';
	}
	if (trim($_POST['idpenerima']) == '') {
		$error[] = '- Penerima harus diisi !!!';
	}
	
	if (trim($_POST['tanggalstt']) == '') {
		$error[] = '- Tanggal STT harus diisi !!!';
	}
	if (trim($_POST['tanggalkirim']) == '') {
		$error[] = '- Tanggal Kirim harus diisi !!!';
	}
	if (trim($_POST['idorigin']) == '') {
		$error[] = '- Kota Asal harus dipilih !!!';
	}
	if (trim($_POST['iddestination']) == '') {
		$error[] = '- Kota Tujuan harus dipilih !!!';
	}
	if (trim($_POST['idnextdest']) == '') {
		$error[] = '- Kota Terusan harus dipilih !!!';
	}
	if (trim($_POST['idservice']) == '') {
		$error[] = '- Layanan harus dipilih !!!';
	}
	if (trim($_POST['idhandling']) == '') {
		$error[] = '- Mode Armada harus dipilih !!!';
	}
	if (trim($_POST['rate']) == 0) {
		$error[] = '- Rate Tidak boleh 0 !!!';
	}
	
			
}
else if($act == "delete")
{
	// cek no pembayaran
	mysql_select_db($database_con_gl, $con_gl);
	$query_cekno = "select IDSTT from transaksipembayaran where IDSTT ='$_POST[id]'";
	$cekno       = mysql_query($query_cekno, $con_gl);
	$row_cekno   = mysql_fetch_assoc($cekno);
	$total_cekno = mysql_num_rows($cekno);
	if($total_cekno > 0) { 
		$error[] = '- Lakukan Void '.$nop.' stt sudah terdaftar pembayaran';
	}
	// CHECK INVOICCE
	mysql_select_db($database_con_gl, $con_gl);
	$query_ceknoinv = "select STT_ID from invoice_detail where STT_ID ='$_POST[id]'";
	$ceknoinv       = mysql_query($query_ceknoinv, $con_gl);
	$row_ceknoinv   = mysql_fetch_assoc($ceknoinv);
	$total_ceknoinv = mysql_num_rows($ceknoinv);
	if($total_ceknoinv > 0) { 
		$error[] = '- Lakukan Void '.$nop.' stt sudah terdaftar invoice';
	}
}
else if ($act == 'bayar')
{
if (trim($_POST['keterangan']) == '') {
		$error[] = '- Keterangan harus diisi !!!';
	}
	if(intval($_POST['pembayaran'] > intval($_POST['kekurangan'])))
	{
		$error[] = '- Pembayaran melebihi nominal sisa pembayaran !!!';
	}

}
if (isset($error)) {
	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);
}else{
	switch($act) {
	case("add"):
	
	mysql_select_db($database_con_gl, $con_gl);		
		$now = strtotime('now');
		$query = "INSERT INTO detailstt (IDCUSTOMER,IDPENERIMA,NOCONNOTE,AIRWAYBILL,TGLCONNOTE,TGLMANIFEST,IDSERVICE,IDHANDLING,IDORIGIN,IDDESC,IDTERUSAN,COLLY,WEIGHT,DIM_P,DIM_L,DIM_T,RATE_KIRIM,CHARGE_KIRIM,PPNPERCENT,PPN,INSURANCE,INCURANCEPERCENT,NBARANGINSURANCE,PACKING,OTHERCHARGE,TOTAL_CHARGE,NOSMU,COST_SHIPPING,COST_DELIVERY,COST_TRUCKING,COST_WAREHOUSE,COST_RA,COST_SMU,COST_GRDH,COST_FEEMARKETING,COST_REFUNDCUST,SHIPPING,DELIVERY,WAREHOUSE,RA,TRUCKING,GRDH,IDSTATUS,CREATED_BY,CREATED_AT,GUDANG) VALUES ('$_POST[idcustomer]','$_POST[idpenerima]', '$_POST[nostt]','$_POST[airwaybill]', '$_POST[tanggalstt]', '$_POST[tanggalkirim]', '$_POST[idservice]', '$_POST[idhandling]', '$_POST[idorigin]','$_POST[iddestination]', '$_POST[idnextdest]', '$_POST[colly]','$_POST[weight]', '$_POST[panjang]', '$_POST[lebar]', '$_POST[tinggi]', '$_POST[rate]', '$_POST[charge]', '$_POST[ppn]','$_POST[nominalppn]', '$_POST[chargeinsurace]', '$_POST[insurance]','$_POST[chargeinsurace]', '$_POST[chargepacking]','$_POST[othercharge]','$_POST[totalsales]','$_POST[nosmu]','$_POST[costshipping]','$_POST[costdelivery]','$_POST[costrucking]','$_POST[costwarehouse]','$_POST[costra]','$_POST[costfreight]','$_POST[costgrdh]','$_POST[feemarketing]',
'$_POST[refundcust]',
'$_POST[agentshipping]','$_POST[agentdelivery]','$_POST[agentwarehouse]','$_POST[agentra]','$_POST[agenttrucking]','$_POST[agentgrdh]','$_POST[statusstt]','$_SESSION[nama]',$now,'$_SESSION[cabang_id]')";
		
		//save email
		print_r($query);
		//die($query);
		
		
		
		$runquery = mysql_query($query, $con_gl) or die (mysql_error());
		if($runquery) { 
			echo "<img src=\"images/ok.png\" align=\"left\" width=\"16\">&nbsp;&nbsp;Data berhasil disimpan ...";
			echo "<script type=\"text/javascript\">setTimeout(\"location.href='".$url."'\", 2000);</script>";
		}else{
			echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal disimpan !!!";
		}
		

		mysql_select_db($database_con_gl, $con_gl);
 		$customer = mysql_query("SELECT * from customer WHERE IDCUSTOMER = '$_POST[idcustomer]'", $con_gl) or die(mysql_error());
		$row_customer = mysql_fetch_assoc($customer);
		
		mysql_select_db($database_con_gl, $con_gl);
 		$penerima = mysql_query("SELECT * from penerima WHERE IDPENERIMA = '$_POST[idpenerima]'", $con_gl) or die(mysql_error());
		$row_penerima = mysql_fetch_assoc($penerima);
		
//		die($row_customer);
		 // Email	
	break;
	case("delete"):
	
		$query = "delete from detailstt where ID='$_POST[id]'";
		/*
		$query2 = "delete from gl_detailtrans where no_ref='$_POST[noreferensi]'";
		$query3 = "delete from gl_book where no_ref='$_POST[noreferensi]'";
		*/
		// hapus data
		mysql_select_db($database_con_gl, $con_gl);
		$runquery = mysql_query($query, $con_gl);
		if($runquery) { 
			// ---
			mysql_query($query2, $con_gl);
			mysql_query($query3, $con_gl);
			// ---
			echo "<img src=\"images/ok.png\" align=\"left\" width=\"16\">&nbsp;&nbsp;Data berhasil dihapus ...";
			echo "<script type=\"text/javascript\">setTimeout(\"location.href='".$url."'\", 2000);</script>";
		}else{
			echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal dihapus !!!";
		}
	break;
	case("bayar"):
		$today = date("Y-m-d"); 
		$gudang = $_POST['gudang'];
		$res = mysql_query("SELECT getARNumber(74) AS result");
		 	if ($res === false) {
				echo mysql_errno().': '.mysql_error();
			}
			while ($obj = mysql_fetch_object($res)) {
		$query = "INSERT INTO gl_pembayaran (no_order,no_ref, no_transaksi, tgl_bayar, jns_pemb, tipe_pemb, pmb_nominal, hold_status,keterangan) VALUES 				                 ('$_POST[no_ref]','$_POST[no_ref]','$obj->result','$today', '$_POST[cr_jenisbayar]','$_POST[cr_tipebayar]','$_POST[pembayaran]','$_SESSION[nama]','$_POST[keterangan]')";
			}
		
		// save data
		mysql_select_db($database_con_gl, $con_gl);
		$runquery = mysql_query($query, $con_gl) or die (mysql_error());
		if($runquery) { 
			echo "<img src=\"images/ok.png\" align=\"left\" width=\"16\">&nbsp;&nbsp;Data berhasil disimpan ...";

			echo "<script type=\"text/javascript\">window.opener.location.href='".$url."'; window.close();</script>";
		}else{
			echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal disimpan !!!";
		}
		
		

		
		
	break;
	case("edit"):
		$now = strtotime('now');
		$query = "UPDATE detailstt   SET IDCUSTOMER='$_POST[idcustomer]',IDPENERIMA='$_POST[idpenerima]',NOCONNOTE='$_POST[nostt]',AIRWAYBILL='$_POST[airwaybill]',TGLCONNOTE='$_POST[tanggalstt]',TGLMANIFEST='$_POST[tanggalkirim]',IDSERVICE='$_POST[idservice]',IDHANDLING='$_POST[idhandling]',IDORIGIN='$_POST[idorigin]',IDDESC='$_POST[iddestination]',IDTERUSAN='$_POST[idnextdest]',COLLY='$_POST[colly]',WEIGHT='$_POST[weight]',DIM_P='$_POST[panjang]',DIM_L='$_POST[lebar]',DIM_T='$_POST[tinggi]',RATE_KIRIM='$_POST[rate]',CHARGE_KIRIM='$_POST[charge]',PPNPERCENT='$_POST[ppn]',PPN='$_POST[nominalppn]',INSURANCE='$_POST[chargeinsurace]',INCURANCEPERCENT='$_POST[insurance]',NBARANGINSURANCE='$_POST[chargeinsurace]',PACKING='$_POST[chargepacking]',OTHERCHARGE='$_POST[othercharge]',TOTAL_CHARGE='$_POST[totalsales]',NOSMU='$_POST[nosmu]', IDSTATUS='$_POST[statusstt]',UPDATED_BY='$_SESSION[nama]',UPDATED_AT=$now WHERE ID = $_POST[idstt]";
		// die($query);
		$runquery = mysql_query($query, $con_gl) or die (mysql_error());
		if($runquery) { 
			echo "<img src=\"images/ok.png\" align=\"left\" width=\"16\">&nbsp;&nbsp;Data berhasil disimpan ...";
			echo "<script type=\"text/javascript\">setTimeout(\"location.href='".$url."'\", 2000);</script>";
		}else{
			echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal disimpan !!!";
		}


	break;
	default:
		
			
		
	break;
	}
}
?>