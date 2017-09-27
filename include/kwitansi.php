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



$query_kontak = "SELECT gl_retailtrans.kontak, gl_kontak.nama, gl_kontak.alamat, gl_kontak.tlp, gl_kontak.npwp FROM gl_retailtrans, gl_kontak WHERE gl_retailtrans.no_ref='$_GET[referensi]' AND gl_kontak.id = gl_retailtrans.kontak";



$kontak = mysql_query($query_kontak, $con_gl) or die(mysql_error());



$row_kontak = mysql_fetch_assoc($kontak);



$totalRows_kontak = mysql_num_rows($kontak);







mysql_select_db($database_con_gl, $con_gl);

$query_status = "select * from v_kasir where no_ref = '$_GET[referensi]'";

$status = mysql_query($query_status, $con_gl) or die(mysql_error());

$row_status = mysql_fetch_assoc($status);



$query_brg = "SELECT gl_masterkendaraan.nopolisi, gl_merkkendaraan.merk, gl_tipekendaraan.tipekendaraan, gl_detailtrans.hargasatuan, gl_detailtrans.ppn, gl_detailtrans.diskonamount as diskon FROM gl_detailtrans, gl_masterkendaraan, gl_tipekendaraan, gl_merkkendaraan WHERE gl_detailtrans.no_ref='$_GET[referensi]' AND gl_detailtrans.kendaraan = gl_masterkendaraan.nopolisi AND gl_merkkendaraan.id = gl_masterkendaraan.merk AND gl_tipekendaraan.id = gl_masterkendaraan.tipekendaraan";



$brg = mysql_query($query_brg, $con_gl) or die(mysql_error());



$row_brg = mysql_fetch_assoc($brg);

$jumlah = $row_brg['jumlah']; if($jumlah == 0) $jumlah=1;

$totalRows_brg = mysql_num_rows($brg);







mysql_select_db($database_con_gl, $con_gl);



$query_gettgl = "SELECT gl_retailtrans.checkin, gl_retailtrans.waktucheckin, gl_retailtrans.checkout, gl_retailtrans.waktucheckout, gl_retailtrans.tgl, gl_retailtrans.jatuhtempo FROM gl_retailtrans WHERE gl_retailtrans.no_ref='$_GET[referensi]'";



$gettgl = mysql_query($query_gettgl, $con_gl) or die(mysql_error());



$row_gettgl = mysql_fetch_assoc($gettgl);



$totalRows_gettgl = mysql_num_rows($gettgl);







mysql_select_db($database_con_gl, $con_gl);



$query_company = "SELECT * FROM gl_company";



$company = mysql_query($query_company, $con_gl) or die(mysql_error());



$row_company = mysql_fetch_assoc($company);



$totalRows_company = mysql_num_rows($company);





// company

mysql_select_db($database_con_gl, $con_gl);

$query_company = "SELECT * FROM gl_gudang where id = '74'";

$company = mysql_query($query_company, $con_gl) or die(mysql_error());

$row_company = mysql_fetch_assoc($company);

$totalRows_company = mysql_num_rows($company);





mysql_select_db($database_con_gl, $con_gl);



$query_getppn = "SELECT gl_detailtrans.transaksi, gl_detailtrans.total FROM gl_detailtrans WHERE gl_detailtrans.no_ref='$_GET[referensi]'";



$getppn = mysql_query($query_getppn, $con_gl) or die(mysql_error());



$row_getppn = mysql_fetch_assoc($getppn);



$totalRows_getppn = mysql_num_rows($getppn);



// get biaya operational



mysql_select_db($database_con_gl, $con_gl);



$query_getopr =  "select (a.akomod + a.bbm + a.other + a.parkir + a.supir + a.tol) as biayaops from gl_retailtrans a where a.no_ref ='$_GET[referensi]'";



$getopr = mysql_query($query_getopr, $con_gl) or die(mysql_error());



$row_getopr = mysql_fetch_assoc($getopr);



$totalRows_getopr = mysql_num_rows($getopr);



// ---



$startTimeStamp = strtotime($row_gettgl['checkin']);



$endTimeStamp = strtotime($row_gettgl['checkout']);







$timeDiff = abs($endTimeStamp - $startTimeStamp);







$numberDays = $timeDiff/86400;  // 86400 seconds in one day







// and you might want to convert to integer



$numberDays = intval($numberDays);



?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml">



<head>



<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />



<title>Form Invoice #<?php echo $_GET[referensi];?></title>



<style>



body {



padding:0;



margin:0;



font-family:Verdana, Arial, Helvetica, sans-serif;



font-size:13px;



line-height:13px;



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



<table width="1200" border="0" align="center" cellpadding="6" cellspacing="0" style="border:solid 1px #000000;">



  <tr>



    <td align="left" valign="top"><strong><?php echo $row_company['pajak_pt'];; ?></strong><br />

      <?php echo $row_company['keterangan']; ?> Telp. <?php echo $row_company['tlp']; ?><br />

www.bimextour.com</td>

    <td width="14%" align="left" valign="top"></td>

    <td width="54%" align="left" valign="top"><h2>KWITANSI</h2></td>

  </tr>



  <tr>



    <td width="32%" align="left" valign="top"><strong>DATE : </strong><?php echo date("l F j, Y, g:i a"); ?></td>



    <td colspan="2" align="right" valign="top"><strong>NOMOR : <?php echo $_GET['referensi'];?></strong></td>

    

  </tr>



  <tr>



    <td colspan="3" align="left" valign="top" style="border:solid 1px #000;border-left:none;"><strong>CUSTOMER</strong></td>

  </tr>



  <tr>



    <td colspan="3" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="4">



      <tr>

        

        <td width="16%" valign="top">Diterima dari</td>

        

        <td width="2%" valign="top">:</td>

        

        <td width="82%" valign="top"><?php echo $row_kontak['nama'];?></td>

      </tr>



      <tr>

        

        <td valign="top">Jumlah</td>

        

        <td valign="top">:</td>

        

        <td valign="top"><span style="background:#EEE;font-weight:bold;text-decoration:underline;">

          <?php  echo number_format($row_status['totalsewa'],0,',','.');?>

          ,-</span></td>

      </tr>



      <tr>

        <td valign="top">Terbilang</td>

        <td valign="top">:</td>

        <td valign="top"><?php echo ucwords(Terbilang($row_status['totalsewa']));?> Rupiah</td>

      </tr>

      <tr>

        <td valign="top"> Pembayaran </td>

        <td valign="top">:</td>

        <td valign="top">Sewa Kendaraan <?php echo $row_brg['tipekendaraan'];?> - <?php echo $row_brg['nopolisi'];?></td>

      </tr>

      <tr>

        <td valign="top">Periode sewa </td>

        <td valign="top">:</td>

        <td valign="top"><?php echo tanggal($row_gettgl['checkin'],"tampilkan");?> - <?php echo tanggal($row_gettgl['checkout'],"tampilkan");?></td>

      </tr>

      <tr>

        <td valign="top">No. Order </td>

        <td valign="top">:</td>

        <td valign="top"><?php echo $_GET['referensi'];?></td>

      </tr>

    </table></td>

  </tr>



  <tr valign="top">

    <td colspan="3" align="center" valign="top"><table align="left" width="1209" height="130" border="1">

      <tr>

        <td height="8" colspan="2"><div align="center">Pembayaran Cheque / Bilyet Giro / Credit Card </div></td>

        <td width="248"><div align="center">Accounting</div></td>

      </tr>

      <tr>

        <td width="467" height="8"><div align="center">Bank </div></td>

        <td width="472"><div align="center">No.CQ/BG</div></td>

        <td width="248" rowspan="3"><p>&nbsp;</p></td>

      </tr>

      <tr>

        <td height="55" colspan="2">&nbsp;</td>

      </tr>

      <tr>

        <td colspan="2">Pembayaran dengan Cheque/Bilyet Giro dianggap sah apabila telah dicairkan pada rekening</td>

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