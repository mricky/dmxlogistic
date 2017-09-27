<?php require_once('../connections/con_gl.php'); ?>



<?php



//session_start();



function Terbilang($x)



{



  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");



  if ($x < 12)



    return " " . $abil[$x];



  elseif ($x < 20)



    return Terbilang($x - 10) . "belas";



  elseif ($x < 100)



    return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);



  elseif ($x < 200)



    return " seratus" . Terbilang($x - 100);



  elseif ($x < 1000)



    return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);



  elseif ($x < 2000)



    return " seribu" . Terbilang($x - 1000);



  elseif ($x < 1000000)



    return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);



  elseif ($x < 1000000000)



    return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);



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



mysql_select_db($database_con_gl, $con_gl);



if($_REQUEST['tipecust']=='R'){

//Ini untuk query cust. retail

$query_data = "select a.id, a.tgl, a.noref, a.info, a.driver, b.nopolisi, b.tahun, b.warnautama, b.norangka, b.nomesin, c.tipekendaraan, e.merk, d.kontak, d.checkin, d.waktucheckin, d.checkout, d.waktucheckout from gl_kkeluar a, gl_masterkendaraan b, gl_tipekendaraan c, gl_retailtrans d, gl_merkkendaraan e where a.id='$_GET[id]' AND a.kendaraan = b.nopolisi AND b.tipekendaraan = c.id AND b.merk = e.id AND a.noref = d.no_ref";

$data = mysql_query($query_data, $con_gl) or die(mysql_error());

$row_data = mysql_fetch_assoc($data);

}else{

//Ini untuk query cust. corporate

$query_data = "select a.id, a.tgl, a.noref, a.info, a.driver, b.nopolisi, b.tahun, b.warnautama, b.norangka, b.nomesin, c.tipekendaraan, e.merk, d.no, d.mulai, d.sampai from gl_kkeluar a, gl_masterkendaraan b, gl_tipekendaraan c, gl_kontrak d, gl_merkkendaraan e where a.id='$_GET[id]' AND a.kendaraan = b.nopolisi AND b.tipekendaraan = c.id AND b.merk = e.id AND a.noref = d.no";

$data = mysql_query($query_data, $con_gl) or die(mysql_error());

$row_data = mysql_fetch_assoc($data);

list($row_data['kontak']) = mysql_fetch_row(mysql_query("select kontak from gl_kontrak where no = '$row_data[noref]' "));

}



// --- get customer

$cust = mysql_query("select * from gl_kontak where id='$row_data[kontak]'", $con_gl) or die(mysql_error());

$row_cust = mysql_fetch_assoc($cust);

// --- get driver

$driv = mysql_query("select * from gl_kontak where id='$row_data[driver]'", $con_gl) or die(mysql_error());

$row_driv = mysql_fetch_assoc($driv);

//---

$startTimeStamp = strtotime($row_data['checkin']);



$endTimeStamp = strtotime($row_data['checkout']);







$timeDiff = abs($endTimeStamp - $startTimeStamp);







$numberDays = $timeDiff/86400;  // 86400 seconds in one day







// and you might want to convert to integer



$numberDays = intval($numberDays);





// and you might want to convert to integer







?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml">



<head>



<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />



<title>Delivery Order #<?php echo $_GET[referensi];?></title>



<style>



body {



padding:0;



margin:0;



font-family:Verdana, Arial, Helvetica, sans-serif;



font-size:11px;



line-height:14px;



}



h2 {



padding:0;



margin:0;



font-family:Verdana, Arial, Helvetica, sans-serif;



font-size:18px;



font-style:italic



}



#edisi tr td {



font-size:8px;



}



</style>



</head>







<body onload="javascript: window.print();">



<table width="1200" align="center" cellpadding="6" cellspacing="0" style="border:solid 1px #000000;">



  <tr>

    <td width="140" align="left" valign="top"><h5><img src="../m_logo.png" alt="" width="140" height="34" /></h5>

    </td>

    <td align="center" valign="top"><h3>BERITA ACARA SERAH TERIMA KENDARAAN </h3></td>

  </tr>

  <tr>

    <td colspan="2" align="left" valign="top"><strong>DATE : </strong><?php echo date("l F j, Y, g:i a"); ?>

      <table width="100%" border="0" cellspacing="0" cellpadding="2">

      <tr>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td width="13%" rowspan="3" ><strong>Fuel</strong></td>

        <td >&nbsp;</td>

        <td width="16%" rowspan="3" ><img src="../images/indikator_bensin.png" alt="" width="94" height="51" /></td>

        <td width="2%" rowspan="3" >&nbsp;</td>

        <td width="30%" rowspan="3" ><strong>KM :</strong>

          <input name="kmawal" type="text" id="kmawal" size="10" maxlength="10" /></td>

        </tr>

      <tr>

        <td colspan="4"><strong>DATA CUSTOMER</strong></td>

        <td width="1%" valign="top">:</td>

        </tr>

      <tr>

        <td width="15%">Kepada YTH,</td>

        <td width="1%" align="center">&nbsp;</td>

        <td width="9%" valign="top">&nbsp;</td>

        <td width="13%" valign="top">&nbsp;</td>

        <td width="1%" height="17" valign="top">&nbsp;</td>

        </tr>

      <tr>

        <td width="15%">&nbsp;</td>

        <td width="1%" align="center">&nbsp;</td>

        <td width="9%" valign="top">&nbsp;</td>

        <td width="13%" valign="top">&nbsp;</td>

        <td height="17" valign="top">&nbsp;</td>

        <td width="1%" valign="top">&nbsp;</td>

        <td colspan="3" valign="top"><strong>DATA KENDARAAN</strong></td>

        </tr>

      

      <tr>

        <td>Nama</td>

        <td>:</td>

        <td colspan="3"><?php echo $row_cust['nama'];?></td>

        <td>&nbsp;</td>

        <td>No. Polisi</td>

        <td>:</td>

        <td><?php echo $row_data['nopolisi'];?></td>

      </tr>

      <tr>

        <td>Alamat</td>

        <td align="center">:</td>

        <td colspan="3" valign="top"><?php echo $row_cust['alamat'];?></td>

        <td valign="top">&nbsp;</td>

        <td valign="top">Merk</td>

        <td valign="top">:</td>

        <td valign="top"><?php echo $row_data['merk'];?></td>

        </tr>

      <tr>

        <td>No. Telp</td>

        <td align="center">:</td>

        <td colspan="3" valign="top"><?php echo $row_cust['tlp'];?></td>

        <td valign="top">&nbsp;</td>

        <td valign="top">Warna</td>

        <td valign="top">:</td>

        <td valign="top"><?php echo $row_data['warnautama'];?></td>

        </tr>

      <tr>

        <td>No. Kontrak </td>

        <td align="center">:</td>

        <td colspan="3" valign="top"><?php echo $row_data['no'];?></td>

        <td valign="top">&nbsp;</td>

        <td valign="top">Tipe</td>

        <td valign="top">:</td>

        <td valign="top"><?php echo $row_data['tipekendaraan'];?></td>

      </tr>

      

      <tr>

        <td>Periode Kontrak</td>

        <td align="center">:</td>

        <td colspan="3" valign="top"><?php tanggal($row_data['mulai'],"tampilkan");?>

-

  <?php tanggal($row_data['sampai'],"tampilkan");?></td>

        <td valign="top">&nbsp;</td>

        <td valign="top">No. Rangka</td>

        <td valign="top">:</td>

        <td valign="top"><?php echo $row_data['norangka'];?></td>

      </tr>

      <tr>

        <td>Delivery </td>

        <td align="center">:</td>

        <td colspan="3" valign="top"><?php tanggal(date("Y/m/d"),"tampilkan");?></td>

        <td valign="top">&nbsp;</td>

        <td valign="top">No. Mesin</td>

        <td valign="top">:</td>

        <td valign="top"><?php echo $row_data['nomesin'];?></td>

      </tr>

      <tr>

        <td>&nbsp;</td>

        <td align="center">&nbsp;</td>

        <td colspan="2" valign="top">&nbsp;</td>

        <td valign="top">&nbsp;</td>

        <td valign="top">&nbsp;</td>

        <td colspan="3" valign="top">&nbsp;</td>

      </tr>

    </table></td>

  </tr>

  <tr>

    <td colspan="2" align="left" valign="top"><table width="100%" border="1" cellspacing="0" cellpadding="2">

      <tr>

        <td width="26%" align="center"><strong>Customer</strong></td>

        <td width="26%" align="center"><strong>Driver</strong></td>

        <td width="26%" align="center"><strong>BIMEX</strong></td>

      </tr>

      <tr align="center" valign="bottom">

        <td><?php echo $row_cust['nama'];?></td>

        <td height="65"><?php echo $row_driv['nama'];?></td>

        <td height="65"><?php echo $_SESSION[nama];?></td>

      </tr>

    </table></td>

  </tr>

  <!--<tr>



    <td align="center" valign="top">&nbsp;</td>



    <td align="center" valign="top">&nbsp;</td>



    <td align="center" valign="top">&nbsp;</td>



    <td align="center" valign="top">&nbsp;</td>



    <td align="center" valign="top">&nbsp;</td>



  </tr>-->



</table>



</body>



</html>



<?php



mysql_free_result($getppn);







mysql_free_result($kontak);







mysql_free_result($brg);







mysql_free_result($gettgl);







mysql_free_result($company);







mysql_free_result($tr1);



?>