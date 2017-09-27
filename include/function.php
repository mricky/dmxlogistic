<?php 
function getBody($sesi,$page,$task) {
	if(isset($sesi) OR $sesi <>'') {
		if(isset($page) AND $page<>'' AND empty($task)) {
			$file = "components/".$page."/default.php";
		}else if(isset($task) AND $task<>'') {
			$file= "components/".$page."/".$task.".php";
		}else{
			$file ="home.php";
		}
	}else{
		$file ="login.php";
	}
	if(file_exists($file)) {
		include($file);
	}else{
		include('notfound.php');
	}
	//echo $file;
}

function defaultContent($controller) {
	if(isset($controller) AND $controller<>'') {
		$file="components/".$_GET[component]."/".$controller.".php";
	}else{
		$file="components/".$_GET[component]."/main.php";
	}
	if(file_exists($file)) {
		include($file);
	}else{
		include('notfound.php');
	}
	//echo "<br/>".$file;
}

function tanggal($xdate,$par) {
$_t = explode("/",$xdate);
$_t1 = $_t[0];
$_t2 = $_t[1];
$_t3 = $_t[2];
switch($_t2) {
	case("12"):
	$bln_eng = "Dec";
	break;
	case("11"):
	$bln_eng = "Nov";
	break;
	case("10"):
	$bln_eng = "Okt";
	break;
	case("09"):
	$bln_eng = "Sep";
	break;
	case("08"):
	$bln_eng = "Aug";
	break;
	case("07"):
	$bln_eng = "Jul";
	break;
	case("06"):
	$bln_eng = "Jun";
	break;
	case("05"):
	$bln_eng = "May";
	break;
	case("04"):
	$bln_eng = "Apr";
	break;
	case("03"):
	$bln_eng = "Mar";
	break;
	case("02"):
	$bln_eng = "Feb";
	break;
	default:
	$bln_eng = "Jan";
	break;
}
$gentgl = $_t3."&nbsp;".$bln_eng."&nbsp;".$_t1;
if($par=='tampilkan') {
 echo $gentgl;
}
}

function cekAkses($akses,$rule) {
	if(!strstr($akses,$rule)) {
		echo "<script type=\"text/javascript\">history.go(-1);</script>";
	}
}
function format_tgl_indo($tgl){
        list($tahun, $bulan, $tanggal) = explode("-", $tgl);// bln/tgl/tahun
        $month = array("","Jan","Feb","Mar","Apr","Mei","Jun","Jul","Aug","Sep","Oct","Nov","Des");
        $bulan = (int) $bulan; 
        $bulan = $month[$bulan];
        $tanggal_indo = $tanggal." ".$bulan." ".$tahun;
        return $tanggal_indo;
    }
?>