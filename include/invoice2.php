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







<body>



<table width="739" border="0" align="center" cellpadding="6" cellspacing="0" style="border:solid 1px #000000;">



  <tr>



    <td colspan="5" align="center" valign="top"><h2>INVOICE</h2></td>

  </tr>



  <tr>



    <td width="24%" align="left" valign="top"><strong>TANGGAL : </strong><?php tanggal($row_gettgl['tgl'],"tampilkan");?></td>



    <td width="26%" align="left" valign="top"><strong>TANGGAL JT : </strong><?php tanggal($row_gettgl['jatuhtempo'],"tampilkan");?></td>



    <td width="2%" align="center" valign="top">&nbsp;</td>



    <td width="24%" align="right" valign="top"><strong>NOMOR :</strong></td>



    <td width="24%" align="left" valign="top"><?php echo $_GET['referensi'];?></td>

  </tr>



  <tr>



    <td colspan="2" align="left" valign="top" style="border:solid 1px #000;border-left:none;"><strong>CUSTOMER</strong></td>



    <td align="center" valign="top">&nbsp;</td>



    <td colspan="2" align="center" valign="top" style="border:solid 1px #000;border-right:none;"><strong>PAKET SEWA</strong></td>

  </tr>



  <tr>



    <td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="4">



      <tr>



        <td width="35%" valign="top">Nama</td>



        <td width="2%" valign="top">:</td>



        <td valign="top"><?php echo $row_kontak['nama'];?></td>

      </tr>



      <tr>



        <td valign="top">Alamat</td>



        <td valign="top">:</td>



        <td valign="top"><?php echo $row_kontak['alamat'];?></td>

      </tr>





      <tr>



        <td valign="top">No.Telepon</td>



        <td valign="top">:</td>



        <td valign="top"><?php echo $row_kontak['tlp'];?></td>

      </tr>



      <tr>



        <td valign="top">NPWP</td>



        <td valign="top">:</td>



        <td valign="top"><?php echo $row_kontak['npwp'];?></td>

      </tr>



    </table></td>



    <td align="center" valign="top">&nbsp;</td>



    <td colspan="2" rowspan="4" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="4">



      <tr>



        <td width="35%" valign="top">Jenis Sewa</td>



        <td width="2%" valign="top">:</td>



        <td align="left" valign="top"><?php echo $row_brg['barang'];?></td>

      </tr>



      <tr>



        <td valign="top">Lama Sewa</td>



        <td valign="top">:</td>



        <td align="left" valign="top"><?php echo $numberDays;?> hari</td>

      </tr>



      <tr>



        <td valign="top">Check out</td>



        <td valign="top">:</td>



        <td align="left" valign="top"><?php tanggal($row_gettgl['checkin'],"tampilkan");?> <?php echo $row_gettgl['waktucheckout'];?></td>

      </tr>



      <tr>



        <td valign="top">Check in</td>



        <td valign="top">:</td>



        <td align="left" valign="top"><?php tanggal($row_gettgl['checkout'],"tampilkan");?> <?php echo $row_gettgl['waktucheckin'];?></td>

      </tr>



      <tr>



        <td valign="top">&nbsp;</td>



        <td valign="top">&nbsp;</td>



        <td align="right" valign="top">&nbsp;</td>

      </tr>



      <tr>



        <td valign="top">Harga Sewa</td>



        <td valign="top">:</td>



        <td align="right" valign="top"><?php echo number_format($row_brg['hargasatuan']*$row_brg['jumlah'],0,',','.');?>,-</td>

      </tr>



      <tr>



        <td valign="top">Discount</td>



        <td valign="top">:</td>



        <td align="right" valign="top"><?php $diskon = ($row_brg['diskon'] / 100) * ($row_brg['hargasatuan']*$row_brg['jumlah']); echo number_format($diskon,0,',','.');?>,-</td>

      </tr>



      <tr>



        <td valign="top">Biaya Oprasional</td>



        <td valign="top">:</td>



        <td align="right" valign="top"><?php echo number_format($row_getopr['total'],0,',','.');?>,-</td>

      </tr>



      <tr>



        <td valign="top">Deposit</td>



        <td valign="top">:</td>



        <td align="right" valign="top">0,-</td>

      </tr>



      <tr>

        <td valign="top">Uang Muka </td>

        <td valign="top">&nbsp;</td>

        <td align="right" valign="top">0,-</td>

      </tr>

      <tr>



        <td valign="top">Denda</td>



        <td valign="top">:</td>



        <td align="right" valign="top">0,-</td>

      </tr>



      <tr>



        <td valign="top">PPN</td>



        <td valign="top">:</td>



        <td align="right" valign="top"><?php echo number_format($row_getppn['total'],0,',','.');?>,-</td>

      </tr>



      <tr>



        <td valign="top">Total Tagihan</td>



        <td valign="top">:</td>



        <td align="right" valign="top" style="background:#EEE;font-weight:bold;text-decoration:underline;"><?php $gtotal = ($row_getppn['total'] + ($row_brg['hargasatuan']*$row_brg['jumlah']) + $row_getopr['total']) - $diskon; echo number_format($gtotal,0,',','.');?>,-</td>

      </tr>



    </table></td>

  </tr>



  <tr>



    <td colspan="2" align="left" valign="top" style="border:solid 1px #000;border-left:none;"><strong>KENDARAAN</strong></td>



    <td align="center" valign="top">&nbsp;</td>

  </tr>



  <tr valign="top">



    <td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="4">



      <tr>



        <td width="35%" valign="top">No. Polisi</td>



        <td width="2%" valign="top">:</td>



        <td valign="top"><?php echo $row_brg['nopolisi'];?></td>

      </tr>



      <tr>



        <td valign="top">Tipe</td>



        <td valign="top">:</td>



        <td valign="top"><?php echo $row_brg['tipekendaraan'];?></td>

      </tr>



      <tr>



        <td valign="top">Merk</td>



        <td valign="top">:</td>



        <td valign="top"><?php echo $row_brg['merk'];?></td>

      </tr>



    </table></td>



    <td rowspan="2" align="center" valign="top">&nbsp;</td>

  </tr>

  <tr valign="top">

    <td colspan="2" align="center" valign="top"><table width="330" height="107" border="1">

      <tr>

        <td height="18"><div align="center">Customer</div></td>

        <td><div align="center">Marketing</div></td>

        <td><div align="center">Accounting</div></td>

      </tr>

      <tr>

        <td><div align="center"></div></td>

        <td><div align="center"></div></td>

        <td><div align="center">

          <p>&nbsp;</p>

          <p>&nbsp;</p>

        </div>

          <p>&nbsp;</p>

          </td>

      </tr>

    </table></td>

  </tr>



  <tr>



    <td align="right" valign="top"><div align="left"><strong>TERBILANG :</strong></div></td>



    <td colspan="4" align="center" valign="top" style="border:solid 1px #000;"><i><?php echo ucwords(Terbilang($gtotal));?> Rupiah</i></td>

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