<?php 
//session_start(); 
require_once('../connections/con_gl.php'); require './phpmailer/PHPMailerAutoload.php'; ?>
<?php include('../connections/config.php'); ?>
<?php
$act = $_GET[act];

//$url = "http://system.bimextour.com/index.php?component=ticketing";
//$url = "http://sim.dmxlogistic.com/index.php?component=invoice";
//$url = "index.php?component=ticketing";
$url = base_url("index.php?component=invoice");
$ope = $_POST['open'];
// -- validasi

/*End validasi */
if ($act=='addInvoice' AND trim($_POST['customer']) == '') {

	$error[] = '- Customer harus dipilih';
			
}
if($act=='addInvoice' AND empty($_SESSION['stt']))
{
	$error[] = '- STT harus dipilih';
}
if (isset($error)) {
	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);
}else{
	switch($act) {
	case("addInvoice"):
			
	
	$create_at =  strtotime('now');
	$query = "insert into invoice (TGLINVOICE,KODEINVOICE,IDCUSTOMER,REF_TCHARGE,REF_TCOST,KETERANGAN,CREATED_AT,CREATED_BY) values ('$_POST[tanggalstt]','$_POST[noinvoice]','$_POST[idcustomer]','0','0',
'$_POST[keterangan]',$create_at,'test')"; 
		
			
		//printf($query);
		
		mysql_select_db($database_con_gl, $con_gl);
		$runquery = mysql_query($query, $con_gl) or die (mysql_error());
		
		$lastinsert = mysql_insert_id();
		
	//	printf($lastinsert);
		
		$i=0;
		$stt = array();
		if(isset($_SESSION['stt'])){
			foreach($_SESSION['stt'] as $kd){
				$stt = $_SESSION['stt'][$i];
				$create_at =  strtotime('now');
				$query = "insert invoice_detail (INVOICE_ID,STT_ID,STT_STATUS_ID) VALUES ($lastinsert,$stt,2)";
				$addquery = mysql_query($query, $con_gl) or die (mysql_error());
				//printf($query);
				//update stt here
				$queryUpdate = "update detailstt set IDSTATUS = 2 where ID = $stt";
				$addqueryUpdate = mysql_query($queryUpdate, $con_gl) or die (mysql_error());
			$i++;
			}
		}
	break;
	case("delete"):
		// cek no pembayaran
		
	break;
	case("edit"):
		
	break;
	
	}
	if($addquery && $runquery) { 
			echo "<img src=\"images/ok.png\" align=\"left\" width=\"16\">&nbsp;&nbsp;Data berhasil disimpan ...";
			echo "<script type=\"text/javascript\">setTimeout(\"location.href='".$url."'\", 2000);</script>";
		}else{
			echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal disimpan !!!";
		
		}
}
?>