<?php
// session_start(); 
require_once('../connections/con_gl.php'); ?>
<?php include('../connections/config.php'); ?>
<?php
$act = $_GET[act];

//$url = "http://system.bimextour.com/index.php?component=ticketing";
$url = base_url("index.php?component=tracking");
//$url = "index.php?component=ticketing";
$ope = $_POST['open'];
// -- validasi

/*End validasi */
if ($act=='add' AND trim($_POST['idstt']) == '') {

	$error[] = '- STT harus dipilih';
			
}

if (isset($error)) {
	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);
}else{
	switch($act) {
	case("add"):
			
		mysql_query("delete from tracking_stt where idstt = '$_POST[idstt]'") or die (mysql_error());	
		$i=0;
		$idstatus = array();
		if(isset($_SESSION['idstatus'])){
			foreach($_SESSION['idstatus'] as $kd){
				$stt = $_SESSION['idstatus'][$i];
				$create_at =  strtotime('now');
				
				$trackingdate = $_SESSION['trackingdate'][$i];
				$city = $_SESSION['city'][$i];
				$idcity = $_SESSION['idcity'][$i];
				$idstatus = $_SESSION['idstatus'][$i];
    			$status = $_SESSION['status'][$i];
    			$desc = $_SESSION['desc'][$i];
			
					
				$query = "insert into tracking_stt (idstt,tracking_status_id,tracking_city,tracking_date,tracking_desc,created_at,created_by) values ('$_POST[idstt]','$idstatus','$idcity','$trackingdate','$desc',$create_at,'test')";
				//die($query);
				$addquery = mysql_query($query, $con_gl) or die (mysql_error());
				
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
	if($addquery) { 
			echo "<img src=\"images/ok.png\" align=\"left\" width=\"16\">&nbsp;&nbsp;Data berhasil disimpan ...";
			echo "<script type=\"text/javascript\">setTimeout(\"location.href='".$url."'\", 2000);</script>";
		}else{
			echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal disimpan !!!";
		
		}
}
?>