<?php 
//session_start();
 require_once('../connections/con_gl.php'); ?>

<?php include('../connections/config.php'); ?>
<?php
$act = $_GET[act];

//$url = "http://system.bimextour.com/index.php?component=ticketing";
$idhandling = $_POST['idhandling'];

if($idhandling == '1')
{
$url = base_url("index.php?component=agent&idhandling=1");
}
else if($idhandling == '2')
{
$url = base_url("index.php?component=agent&idhandling=2");
}
else if($idhandling == '3')
{
$url = base_url("index.php?component=agent&idhandling=3");
}
else if($idhandling == '4')
{
$url = base_url("index.php?component=agent&idhandling=4");
}
else if($idhandling == '5')
{
$url = base_url("index.php?component=agent&idhandling=5");
}
else if($idhandling == '6')
{
$url = base_url("index.php?component=agent&idhandling=6");
}
else if($idhandling == '7')
{
$url = base_url("index.php?component=agent&idhandling=7");
}
//$url = "index.php?component=ticketing";
$ope = $_POST['open'];
// -- validasi
$nop = strtoupper($_POST['nama']);
if ($act=='addPricelistAgent' AND trim($_POST['nama']) == '') {

	$error[] = '- Nama harus diisi';

}

if ($act=='addPricelistAgent' AND trim($_POST['alamat']) == '') {

	$error[] = '- Alamat harus diisi';

}
if ($act=='addPricelistAgent' AND trim($_POST['hp']) == '') {

	$error[] = '- Hp harus diisi';

}

if( !isset($_SESSION['idservice']) )
{
	$error[] = '- Silahkan Pilih Service';
}

if( !isset($_SESSION['idorigin']) )
{
	$error[] = '- Silahkan Pilih Kota Asal';
}
if( !isset($_SESSION['iddestination']) )
{
	$error[] = '- Silahkan Pilih Kota Tujuan';
}
if( !isset($_SESSION['rate']) )
{
	$error[] = '- Silahkan Pilih Rate';
}
if( !isset($_SESSION['minpackage']) )
{
	$error[] = '- Silahkan Pilih Minimal Paket';
}

mysql_select_db($database_con_gl, $con_gl);

	$query_cekno = "select agent from NAMAAGENT where NAMAAGENT='$nop'";

	$cekno       = mysql_query($query_cekno, $con_gl);

	$row_cekno   = mysql_fetch_assoc($cekno);

	$total_cekno = mysql_num_rows($cekno);

	if($total_cekno > 0) { 

		$error[] = '- Nama Agent '.$nop.' sudah terdaftar';

	}

if (isset($error)) {
	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);
}else{
	$today = date("Y-m-d"); 
	switch($act) {
	case("addPriceAgent"):
		
		$kode =  "AGN".strtotime('now');
        $query = "INSERT INTO agent (IDAGENTHANDLING, KODEAGENT,NAMAAGENT,ALAMAT,TELEPON,FAX,HP,EMAIL,NPWP,BANK,ACCOUNTNUMBER,ATASNAMA,IDGUDANG)"

                    . " VALUES ('$_POST[idhandling]','$kode','$_POST[nama]','$_POST[alamat]','$_POST[telepon]','$_POST[fax]','$_POST[hp]','$_POST[email]','$_POST[npwp]','$_POST[bank]','$_POST[rekening]','$_POST[atas_nama]','$_SESSION[cabang_id]');";
		 //	die($query);
 		 $conn = mysql_select_db($database_con_gl, $con_gl);
		 $runquery = mysql_query($query, $con_gl); 
		// die($query.$url);
		 if(!$runquery)
		 {
			  die('Invalid query: ' . mysql_error());
		 }
		 else
		 {	 
		 	$agent_id = mysql_insert_id();
			$i=0;
		$pricelist = array();
		if(isset($_SESSION['idservice'])){
			foreach($_SESSION['idservice'] as $kd){
					//echo 'puter session';
							
				$idservice = $_SESSION['idservice'][$i];
				$service = $_SESSION['service'][$i];
				$idhandling = $_SESSION['idhandling'][$i];
				$handling = $_SESSION['handling'][$i];
				$idorigin = $_SESSION['idorigin'][$i];
				$origin = $_SESSION['origin'][$i];
				$iddestination = $_SESSION['iddestination'][$i];
				$destination = $_SESSION['destination'][$i];
				$idnextdest = $_SESSION['idnextdest'][$i];
				$nextdest = $_SESSION['nextdest'][$i];
				$idmodatransport = $_SESSION['idmodatransport'][$i];				
				$rate = $_SESSION['rate'][$i];
				$minpackage = $_SESSION['minpackage'][$i];								
				$create_at =  strtotime('now');
				$addquery = mysql_query("insert into agentpricelist values ('','$idorigin','$agent_id','$iddestination','$idnextdest','$idmodatransport','$idservice','$rate','$minpackage',$create_at)") or die (mysql_error());			
						
				printf($addquery);
			$i++;
			}
		}
		
		 }
		 
		 
	break;
	case("delete"):
		// cek no pembayaran
		
	break;
	case("editPriceAgent"):
		mysql_query("delete from agentpricelist where IDAGENT='$_POST[id]'") or die (mysql_error());
		
		$i=0;
		$pricelist = array();
		if(isset($_SESSION['idservice'])){
			foreach($_SESSION['idservice'] as $kd){
					//echo 'puter session';
							
				$idservice = $_SESSION['idservice'][$i];
				$service = $_SESSION['service'][$i];
				$idhandling = $_SESSION['idhandling'][$i];
				$handling = $_SESSION['handling'][$i];
				$idorigin = $_SESSION['idorigin'][$i];
				$origin = $_SESSION['origin'][$i];
				$iddestination = $_SESSION['iddestination'][$i];
				$destination = $_SESSION['destination'][$i];
				$idnextdest = $_SESSION['idnextdest'][$i];
				$nextdest = $_SESSION['nextdest'][$i];
				$idmodatransport = $_SESSION['idmodatransport'][$i];				
				$rate = $_SESSION['rate'][$i];
				$minpackage = $_SESSION['minpackage'][$i];
								
				$create_at =  strtotime('now');
				$addquery = mysql_query("insert into agentpricelist values ('','$idorigin','$_POST[id]','$iddestination','$idnextdest','$idmodatransport','$idservice','$rate','$minpackage',$create_at)") or die (mysql_error());			
						
				printf($addquery);
			$i++;
			}
		}
		
	break;
	default:
			
		
		
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