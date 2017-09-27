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



$query_kontak = "SELECT gl_rtrans.kontak, gl_kontak.nama, gl_kontak.alamat, gl_kontak.tlp, gl_kontak.npwp FROM gl_rtrans, gl_kontak WHERE gl_rtrans.no_ref='$_GET[referensi]' AND gl_kontak.id = gl_rtrans.kontak";



$kontak = mysql_query($query_kontak, $con_gl) or die(mysql_error());



$row_kontak = mysql_fetch_assoc($kontak);



$totalRows_kontak = mysql_num_rows($kontak);







mysql_select_db($database_con_gl, $con_gl);



$query_brg = "SELECT gl_trans.barang as kdbrg, gl_barang.barang, gl_masterkendaraan.nopolisi, gl_merkkendaraan.merk, gl_tipekendaraan.tipekendaraan, gl_trans.hargasatuan, gl_trans.jumlah, gl_trans.diskon FROM gl_trans, gl_barang, gl_masterkendaraan, gl_tipekendaraan, gl_merkkendaraan WHERE gl_trans.no_ref='$_GET[referensi]' AND gl_barang.id=gl_trans.barang AND gl_trans.kendaraan = gl_masterkendaraan.nopolisi AND gl_merkkendaraan.id = gl_masterkendaraan.merk AND gl_tipekendaraan.id = gl_masterkendaraan.tipekendaraan";



$brg = mysql_query($query_brg, $con_gl) or die(mysql_error());



$row_brg = mysql_fetch_assoc($brg);

$jumlah = $row_brg['jumlah']; if($jumlah == 0) $jumlah=1;

$totalRows_brg = mysql_num_rows($brg);







mysql_select_db($database_con_gl, $con_gl);



$query_gettgl = "SELECT gl_rtrans.checkin, gl_rtrans.waktucheckin, gl_rtrans.checkout, gl_rtrans.waktucheckout, gl_rtrans.tgl, gl_rtrans.jatuhtempo FROM gl_rtrans WHERE gl_rtrans.no_ref='$_GET[referensi]'";



$gettgl = mysql_query($query_gettgl, $con_gl) or die(mysql_error());



$row_gettgl = mysql_fetch_assoc($gettgl);



$totalRows_gettgl = mysql_num_rows($gettgl);







mysql_select_db($database_con_gl, $con_gl);



$query_company = "SELECT * FROM gl_company";



$company = mysql_query($query_company, $con_gl) or die(mysql_error());



$row_company = mysql_fetch_assoc($company);



$totalRows_company = mysql_num_rows($company);







mysql_select_db($database_con_gl, $con_gl);



$query_getppn = "SELECT gl_trans.transaksi, gl_trans.total FROM gl_trans WHERE gl_trans.transaksi='Beban Pajak' AND gl_trans.no_ref='$_GET[referensi]'";



$getppn = mysql_query($query_getppn, $con_gl) or die(mysql_error());



$row_getppn = mysql_fetch_assoc($getppn);



$totalRows_getppn = mysql_num_rows($getppn);



// get biaya operational



mysql_select_db($database_con_gl, $con_gl);



$query_getopr = "SELECT gl_trans.transaksi, gl_trans.total FROM gl_trans WHERE gl_trans.transaksi='Beban Biaya Lain' AND gl_trans.no_ref='$_GET[referensi]'";



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



<table width="739" border="0" align="center" cellpadding="6" cellspacing="0" style="border:solid 1px #000000;">



  <tr>



    <td colspan="2" align="center" valign="top"><h2>KWINTASI</h2></td>

  </tr>



  <tr>



    <td width="64%" align="left" valign="top"><strong>TANGGAL : </strong><?php tanggal($row_gettgl['tgl'],"tampilkan");?></td>



    <td width="36%" align="left" valign="top"><strong>NOMOR : <?php echo $_GET['referensi'];?></strong></td>

    <!--<label><input name="noreferensi" type="text" id="noreferensi" value="KW<?php echo time();?>" size="31" maxlength="31" onchange="cekReferensi(this.value);"/></label> -->

  </tr>



  <tr>



    <td colspan="2" align="left" valign="top" style="border:solid 1px #000;border-left:none;"><strong>CUSTOMER</strong></td>

  </tr>



  <tr>



    <td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="4">



      <tr>



        <td width="16%" valign="top">Diterima dari</td>



        <td width="2%" valign="top">:</td>



        <td width="82%" valign="top"><?php echo $row_kontak['nama'];?></td>

      </tr>



      <tr>



        <td valign="top">&nbsp;</td>



        <td valign="top">&nbsp;</td>



        <td valign="top">&nbsp;</td>

      </tr>





      <tr>



        <td valign="top">Jumlah</td>



        <td valign="top">:</td>



        <td valign="top"><span style="background:#EEE;font-weight:bold;text-decoration:underline;">

        <?php /*$gtotal = ($row_getppn['total'] + ($row_brg['hargasatuan']*$jumlah) + $row_getopr['total']) - $diskon; echo number_format($gtotal,0,',','.');*/

		mysql_select_db($database_con_gl, $con_gl);

		$query_kontak = "SELECT gl_rtrans.kontak, gl_kontak.nama, gl_kontak.alamat, gl_kontak.tlp FROM gl_rtrans, gl_kontak WHERE gl_rtrans.no_ref='$_GET[referensi]' AND gl_kontak.id = gl_rtrans.kontak";

$kontak = mysql_query($query_kontak, $con_gl) or die(mysql_error());

$row_kontak = mysql_fetch_assoc($kontak);

$totalRows_kontak = mysql_num_rows($kontak);



mysql_select_db($database_con_gl, $con_gl);

$query_brg = "SELECT gl_trans.barang as kdbrg, gl_barang.barang FROM gl_trans, gl_barang WHERE gl_trans.no_ref='$_GET[referensi]' AND gl_barang.id=gl_trans.barang";

$brg = mysql_query($query_brg, $con_gl) or die(mysql_error());

$row_brg = mysql_fetch_assoc($brg);

$totalRows_brg = mysql_num_rows($brg);



mysql_select_db($database_con_gl, $con_gl);

$query_gettgl = "SELECT gl_rtrans.tgl, gl_rtrans.jatuhtempo FROM gl_rtrans WHERE gl_rtrans.no_ref='$_GET[referensi]'";

$gettgl = mysql_query($query_gettgl, $con_gl) or die(mysql_error());

$row_gettgl = mysql_fetch_assoc($gettgl);

$totalRows_gettgl = mysql_num_rows($gettgl);



mysql_select_db($database_con_gl, $con_gl);

$query_company = "SELECT * FROM gl_company";

$company = mysql_query($query_company, $con_gl) or die(mysql_error());

$row_company = mysql_fetch_assoc($company);

$totalRows_company = mysql_num_rows($company);



mysql_select_db($database_con_gl, $con_gl);

$query_tr1 = "SELECT gl_trans.jumlah, gl_satuan.satuan FROM gl_trans, gl_satuan WHERE gl_satuan.id=gl_trans.satuan AND gl_trans.no_ref='$_GET[referensi]' ORDER BY gl_trans.id";

$tr1 = mysql_query($query_tr1, $con_gl) or die(mysql_error());

$row_tr1 = mysql_fetch_assoc($tr1);

$totalRows_tr1 = mysql_num_rows($tr1);



mysql_select_db($database_con_gl, $con_gl);

$query_tr2 = "SELECT gl_barang.barang, gl_trans.barang as kdbrg FROM gl_barang, gl_trans WHERE gl_trans.barang = gl_barang.id AND gl_trans.no_ref='$_GET[referensi]' ORDER BY gl_trans.id";

$tr2 = mysql_query($query_tr2, $con_gl) or die(mysql_error());

$row_tr2 = mysql_fetch_assoc($tr2);

$totalRows_tr2 = mysql_num_rows($tr2);



mysql_select_db($database_con_gl, $con_gl);

$query_tr3 = "SELECT gl_trans.transaksi FROM gl_trans WHERE gl_trans.no_ref='$_GET[referensi]' AND gl_trans.barang<>'' ORDER BY gl_trans.id";

$tr3 = mysql_query($query_tr3, $con_gl) or die(mysql_error());

$row_tr3 = mysql_fetch_assoc($tr3);

$totalRows_tr3 = mysql_num_rows($tr3);



mysql_select_db($database_con_gl, $con_gl);

$query_tr4 = "SELECT gl_trans.hargasatuan, gl_trans.transaksi, gl_trans.diskon, gl_trans.total, gl_trans.jumlah FROM gl_trans WHERE gl_trans.barang<>'' AND gl_trans.no_ref='$_GET[referensi]' ORDER BY gl_trans.id";

$tr4 = mysql_query($query_tr4, $con_gl) or die(mysql_error());

$row_tr4 = mysql_fetch_assoc($tr4);

$totalRows_tr4 = mysql_num_rows($tr4);



mysql_select_db($database_con_gl, $con_gl);

$query_getppn = "SELECT gl_trans.transaksi, gl_trans.total FROM gl_trans WHERE gl_trans.transaksi='Beban Biaya lain' AND gl_trans.no_ref='$_GET[referensi]'";

$getppn = mysql_query($query_getppn, $con_gl) or die(mysql_error());

$row_getppn = mysql_fetch_assoc($getppn);

$totalRows_getppn = mysql_num_rows($getppn);



$subtotal =0; $diskon =0; do {

        $subtotal += $row_tr4['jumlah']*$row_tr4['hargasatuan'];$tmpdis = intval($row_tr4[diskon] * $row_tr4['total']) / 100;$diskon += ($row_tr4['jumlah']*$row_tr4['hargasatuan']) - $row_tr4['total'];  } while ($row_tr4 = mysql_fetch_assoc($tr4));

		 $tep = intval($subtotal - $diskon);

		 $ppn = intval($tep*10/100);



		$ttol = intval($tep+$ppn+$row_getppn['total']); echo number_format($ttol,0,',','.');

		?>

          ,-</span></td>

      </tr>



      <tr>

        <td valign="top">&nbsp;</td>

        <td valign="top">&nbsp;</td>

        <td valign="top">&nbsp;</td>

      </tr>

      <tr>

        <td valign="top">Terbilang</td>

        <td valign="top">:</td>

        <td valign="top"><?php echo ucwords(Terbilang($ttol));?> Rupiah</td>

      </tr>

      <tr>

        <td valign="top">&nbsp;</td>

        <td valign="top">&nbsp;</td>

        <td valign="top">&nbsp;</td>

      </tr>

      <tr>

        <td valign="top">Untuk Pembayaran </td>

        <td valign="top">:</td>

        <td valign="top">Sewa <?php echo $row_brg['barang'];?> - No. Kendaraan : <?php echo $row_brg['nopolisi'];?></td>

      </tr>

      <tr>

        <td valign="top">&nbsp;</td>

        <td valign="top">&nbsp;</td>

        <td valign="top">&nbsp;</td>

      </tr>

      <tr>

        <td valign="top">Periode Sewa </td>

        <td valign="top">:</td>

        <td valign="top"><?php echo tanggal($row_gettgl['checkout'],"tampilkan");?> - <?php echo tanggal($row_gettgl['checkin'],"tampilkan");?></td>

      </tr>

      <tr>

        <td valign="top">&nbsp;</td>

        <td valign="top">&nbsp;</td>

        <td valign="top">&nbsp;</td>

      </tr>

      <tr>

        <td valign="top">No. Order </td>

        <td valign="top">:</td>

        <td valign="top"><?php echo $_GET['referensi'];?></td>

      </tr>

      

      



    </table></td>

  </tr>



  <tr valign="top">

    <td colspan="2" align="center" valign="top"><table width="740" height="179" border="1">

      <tr>

        <td height="8" colspan="4"><div align="center">Pembayaran Cheque / Bilyet Giro / Credit Card </div></td>

        <td width="257" rowspan="2"><div align="center">Accounting</div></td>

      </tr>

      <tr>

        <td width="98" height="8"><div align="center">Bank                                     </div></td>

        <td width="125"><div align="center">No.CQ/BG</div></td>

        <td width="111"><div align="center">J.Tempo</div></td>

        <td width="115"><div align="center">Nominal</div></td>

      </tr>

      <tr>

        <td height="104" colspan="4"><div align="center"></div></td>

        <td rowspan="2"><div align="center">

          <p>&nbsp;</p>

          <p>&nbsp;</p>

        </div>

          <p>&nbsp;</p>          </td>

      </tr>

      <tr>

        <td colspan="4">Pembayaran dengan Cheque/Bilyet Giro dianggap sah apabila telah dicairkan pada rekening</td>

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