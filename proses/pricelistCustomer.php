<?php
// session_start();
 require_once('../connections/con_gl.php'); ?>
<?php include('../connections/config.php'); ?>
<?php
$act = $_GET[act];
$nop = strtoupper($_POST['hp']);
//$url = "http://system.bimextour.com/index.php?component=ticketing";
$url = base_url("index.php?component=customer");
//$url = "index.php?component=ticketing";
$ope = $_POST['open'];
// -- validasi
if ($act=='addPriceCustomer' AND trim($_POST['nama']) == '') {

	$error[] = '- Nama harus diisi';

}

if ($act=='addPriceCustomer' AND trim($_POST['alamat']) == '') {

	$error[] = '- Alamat harus diisi';

}
if ($act=='addPriceCustomer' AND trim($_POST['hp']) == '') {

	$error[] = '- Hp harus diisi';

}



if($act=='addPriceCustomer' AND (trim($_POST['nama']) <> ''))

{

	// cek no polisi

	mysql_select_db($database_con_gl, $con_gl);

	$query_cekno = "select customer from nama where NAMACUSTOMER='$nop'";

	$cekno       = mysql_query($query_cekno, $con_gl);

	$row_cekno   = mysql_fetch_assoc($cekno);

	$total_cekno = mysql_num_rows($cekno);

	if($total_cekno > 0) { 

		$error[] = '- Nama Customer '.$nop.' sudah terdaftar';

	}

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
if( !isset($_SESSION['idnextdest']) )
{
	$error[] = '- Silahkan Pilih Kota Terusan';
}
if( !isset($_SESSION['idhandling']) )
{
	$error[] = '- Silahkan Pilih Handling';
}
if( !isset($_SESSION['charge']) )
{
	$error[] = '- Silahkan Isi Charge';
}
if( !isset($_SESSION['weight']) )
{
	$error[] = '- Silahkan Isi Berat';
}


/*End validasi */
if (isset($error)) {
	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);
}else{
	switch($act) {
	case("addPriceCustomer"):
		// cek no pembayaran
		echo "init";
		$kode =  "CST".strtotime('now');
            $query = "INSERT INTO customer (KODECUSTOMER,NAMACUSTOMER,ALAMAT,TELEPON,FAX,HP,EMAIL,MARKETING,GUDANG)"

                    . " VALUES ('$kode','$_POST[nama]','$_POST[alamat]','$_POST[telepon]','$_POST[fax]','$_POST[hp]','$_POST[email]','$_POST[marketing]','$_SESSION[cabang_id]');";
					
					 $conn = mysql_select_db($database_con_gl, $con_gl);
		 $runquery = mysql_query($query, $con_gl); 
		
		 if(!$runquery)
		 {
			  die('Invalid query: ' . mysql_error());
		 }
		 else
		 {	 
		 	$cust_id = mysql_insert_id();
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
				$charge = $_SESSION['charge'][$i];
				$description = $_SESSION['description'][$i];
				$duration = $_SESSION['duration'][$i];
			
							
				$create_at =  strtotime('now');
				$addquery = mysql_query("insert into pricelist values ('','$cust_id','$idservice','$idorigin','$iddestination','$idnextdest','$idhandling','$charge','','$duration','$description',$create_at)") or die (mysql_error());
				
			
				
				printf($addquery);
			$i++;
			}
		}
		
		}
	break;
	case("editPriceCustomer"):
		mysql_query("delete from pricelist where IDCUSTOMER='$_POST[id]'") or die (mysql_error());
		
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
				$charge = $_SESSION['charge'][$i];
				$description = $_SESSION['description'][$i];
				$duration = $_SESSION['duration'][$i];
			
							
				$create_at =  strtotime('now');
				$addquery = mysql_query("insert into pricelist values ('','$_POST[id]','$idservice','$idorigin','$iddestination','$idnextdest','$idhandling','$charge','','$duration','$description',$create_at)") or die (mysql_error());
				
			
				
				printf($addquery);
			$i++;
			}
		}
		
	break;
	default:
		/*	
		//Save to gl_retailtrans
		
		
		*/
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