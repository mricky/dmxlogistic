<?php require_once('../connections/con_gl.php'); ?>
<?php
mysql_select_db($database_con_gl, $con_gl);

//Tangkap parameter
$pickupdate = str_replace('/', '-', $_POST['pickupdate']); 
$dropoffdate = str_replace('/', '-', $_POST['dropoffdate']);
$pickuptime = $_POST['pickuptime'];
$dropofftime = $_POST['dropofftime'];

//$interval = $_POST['interval']; if($interval == '') $interval = '0';
$type = $_POST['type']; 
  
switch($type)
{
    case 'day' :
	// get param checkin & check out 
	// return value 
	// < 12 jam dianggap 12 jam, yang muncul adalah paket dengan 12 jam 1 hari
	// lebih dari 12 jam dan kurang dari 18 jam dianggap 18 jam yang muncul 18 jam
	// lebih dari 18 jam dianggap paket 24 jam
	 $query = mysql_query("SELECT 
        (hour(
            timediff('$pickupdate $pickuptime', 
                     '$dropoffdate  $dropofftime')
            ) ) 
   		 AS totalhours") or die (mysql_error());
		 //list($result) = mysql_fetch_row($query);
 		 //echo str_replace($result);
		 $jumlahjam = null;
		 $jumlahhari = null;
		 $notif = null;
		 $minimumjam = null;
		 $paketbarang = null;
		 
		 while($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
    		 $jumlahjam = $row['totalhours'];
		 }
         //echo $jumlahjam;
         if($jumlahjam <= 8)
		 {
			 $jumlahhari = 1;			 
			 $notif = "Durasi sewa < 8 jam dihitung 8 Jam";
			 $minimumjam = 8;
			 echo $jumlahhari;
		 }
		 else if($jumlahjam >= 8 && $jumlahjam <= 12)
		 {
			 //echo 'hitung > 18';
			 //echo 'keluar paket 12 jam';
			 $jumlahhari = 1;			 
			 $notif = "Durasi sewa >= 8 && <= 12 jam dihitung 12 Jam";
			 $minimumjam = 12;
			 echo $jumlahhari;
		 }
		 else if($jumlahjam >= 12 && $jumlahjam <= 18)
		 {
			 //echo 'hitung > 18';
			 //echo 'keluar paket 12 jam';
			 $jumlahhari = 1;			 
			 $notif = "Durasi sewa >= 12 && <= 18 jam dihitung 18 Jam";
			 $minimumjam = 18;
			 echo $jumlahhari;
		 }
		 else if($jumlahjam >= 18 && $jumlahjam <= 24)
		 {
			 
			  // keluar paket 24 jam
			 $jumlahhari = 1;			 
			 $notif = "Durasi sewa >= 18 && <= 24 dihitung 1 hari";
			 $minimumjam = 24;
			 echo $jumlahhari;
		 }
    	 else if($jumlahjam > 24)
		 {
			 $minimumjam = 24;
		   //echo 'hitung > 24';
		    
			/*
		$query2 = mysql_query("SELECT DATEDIFF('$dropoffdate','$pickupdate') + 1 as jumlahhari") or die (mysql_error());
		
		 while($row2 = mysql_fetch_array($query2, MYSQL_ASSOC)) {
    		 $tt = $row2['jumlahhari'];
		 }
		 */
		  $jumlahhari = ceil($jumlahjam / 24);
		 $tt =  $jumlahhari;
		 echo $tt;			  
		 
		 $notif = "Durasi sewa > 24 jam dihitung " .$tt. " hari";	 
		 }		
	break;
}
echo "<script>var txtNotif = document.getElementById('notif');</script>";
echo "<script>txtNotif.innerHTML ='".$notif."'</script>";
echo "<script>document.getElementById('jmlhwkt').value='" .$jumlahjam. "';</script>";
echo "<script>document.getElementById('minimumjam').value='" .$minimumjam. "';</script>";
echo "<script>document.getElementById('diskon').value='0';</script>";
echo "<script>document.getElementById('txtdiskon').value='0';</script>";
echo "<script>document.getElementById('hargasatuan').value='0';</script>";
echo "<script>document.getElementById('bbm').value='0';</script>";
echo "<script>document.getElementById('tol').value='0';</script>";
echo "<script>document.getElementById('parkir').value='0';</script>";
echo "<script>document.getElementById('supir').value='0';</script>";
echo "<script>document.getElementById('akomodasi').value='0';</script>";
echo "<script>document.getElementById('other').value='0';</script>";
echo "<script>document.getElementById('total').value='0';</script>";
echo "<script>document.getElementById('biaya').value='0';</script>";
echo "<script>document.getElementById('ntotal').value='0';</script>";

//echo "<script>document.getElementById('txtbarang').value='" .$paketbarang. "';</script>";
/*
switch($type){
	case 'day' :
		$query = mysql_query("select date_add('$tanggal', interval $interval $type)") or die (mysql_error());
		list($result) = mysql_fetch_row($query);
		echo str_replace("-", "/", $result);
		break;
	case 'hour' :	
		$waktu = $_POST['waktu']; //echo "select date_add('$tanggal $waktu', interval $interval $type)";
		$query = mysql_query("select date_add('$tanggal $waktu', interval $interval $type)") or die (mysql_error());
		list($result) = mysql_fetch_row($query);
		$hasil = explode(" ", $result);
		echo str_replace("-", "/", $hasil[0]);
		echo "<script>document.getElementById('waktucheckout').value='".substr($hasil[1],0,5)."';</script>";
		break;
		
}
*/
?>