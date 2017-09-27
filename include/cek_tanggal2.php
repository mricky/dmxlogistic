<?php require_once('../connections/con_gl.php'); ?>
<?php
mysql_select_db($database_con_gl, $con_gl);

//Tangkap parameter
$tanggal = str_replace('/', '-', $_POST['tanggal']); 
$interval = $_POST['interval']; if($interval == '') $interval = '0';
$type = $_POST['type'];

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
?>