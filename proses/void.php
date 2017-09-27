<?php 
//session_start();
 require_once('../connections/con_gl.php'); ?>
<?php
$act = $_GET[act];
$url = "index.php?component=void";
$ope = $_POST['open'];
$rep = intval($_POST['replacement']);
if($rep=='1') {
	$url .= "&replace=1";	
}
/* Validasi */
if (trim($_POST['tgl_bayar']) == '') {
	$error[] = '- Tanggal harus diisi';
}

/*
if (trim($_POST['driver']) == '') {
	$error[] = '- Karyawan ( Driver ) harus diisi';
}
*/
/*End validasi */
if (isset($error)) {
	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);
}else{
	if($act =='add') {
		$today = date("Y-m-d"); 
		
	}else if($act=='edit'){
		
	$query ="UPDATE transaksipembayaran SET TGLBAYAR='$_POST[tgl_bayar]', TOTALBAYAR='$_POST[pmb_nominal]' WHERE IDPEMBAYARAN='$_POST[id]'";
	
	// ---
	}else{
	$query = "delete from transaksipembayaran where IDPEMBAYARAN='$_POST[id]'";
	//$update_a = mysql_query("update gl_masterkendaraan set tersedia='1' where nopolisi='$_POST[kendaraan]'", $con_gl) or die (mysql_error()); 
	}
	mysql_select_db($database_con_gl, $con_gl);
	$runquery = mysql_query($query, $con_gl) or die (mysql_error());
	if($runquery) {
		echo "<img src=\"images/ok.png\" align=\"left\" width=\"16\">&nbsp;&nbsp;Data berhasil ";if($act=='add' OR $act=='edit') { echo "disimpan";}else{ echo "dihapus"; } echo " ...";
	}else{
		echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal disimpan !!!";
	}
}
?>
<?php if($runquery AND $ope=='window') { ?>
	<script type="text/javascript">top.opener.sendRespondLokasi();self.close(2000);</script>
<?php }else if($runquery AND $ope==''){ ?>
	<script type="text/javascript">setTimeout("location.href='<?php echo $url;?>'", 2000);</script>
<?php } ?>