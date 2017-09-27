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



// query pemanggil

mysql_select_db($database_con_gl, $con_gl);

$query_tr4 = "SELECT * from v_kasir_penagihan a where a.id ='$_GET[id]' AND a.invoice_no='$_GET[invoice_no]'";

$tr4 = mysql_query($query_tr4, $con_gl) or die(mysql_error());

$row_tr4 = mysql_fetch_assoc($tr4);

$totalRows_tr4 = mysql_num_rows($tr4);



mysql_select_db($database_con_gl, $con_gl);

$query_kontrak = "SELECT * from gl_kontrak where no = '$row_tr4[kontrak]'";

$tr_kontrak = mysql_query($query_kontrak, $con_gl) or die(mysql_error());

$row_kontrak = mysql_fetch_assoc($tr_kontrak);

//printf($query_kontrak);























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



<title>BIMEX SYSTEM ONLINE : KWITANSI  #<?php echo $_GET[referensi];?></title>



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

    <td align="left" valign="top"><H2>KWITANSI</H2></td>

  </tr>

  <tr>



    <td width="48%" align="left" valign="top"><strong>DATE : </strong><?php echo date("l F j, Y, g:i a"); ?></td>



    <td width="52%" align="right" valign="top"><strong>NOMOR : <label><input name="nokwitansi" type="text" id="nokwitansi	" value="KW<?php echo time();?>" size="31" maxlength="31" onchange="cekReferensi(this.value);"/></label></td>

    

  </tr>



  <tr>



    <td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="4">



      <tr>

        

        <td width="16%" valign="top">Diterima dari</td>

        

        <td width="2%" valign="top">:</td>

        

        <td valign="top"><?php echo $row_tr4['nama'];?></td>

      </tr>



      <tr>

        

        <td valign="top">Jumlah</td>

        

        <td valign="top">:</td>

        

        <td valign="top"><span style="background:#EEE;font-weight:bold;text-decoration:underline;">

          Rp. <?php $gtotal = ($row_tr4['total_bayar']); echo number_format($gtotal,0,',','.');?>

          ,-</span></td>

      </tr>



      <tr>

        <td valign="top">Terbilang</td>

        <td valign="top">:</td>

        <td valign="top"><?php echo ucwords(Terbilang($row_tr4['total_bayar']));?> Rupiah</td>

      </tr>

      <tr>

        <td valign="top"> Pembayaran </td>

        <td valign="top">:</td>

        <td valign="top">Sewa kendaraan Periode ke - <?php echo $row_tr4['periode'];?></td>

      </tr>

      <tr>

        <td valign="top">No Invoice</td>

        <td valign="top">:</td>

        <td valign="top"><?php echo $row_tr4['invoice_no'];?></td>

      </tr>

      <tr>

        <td valign="top">Periode Sewa </td>

        <td valign="top">:</td>

        <td valign="top"><?php echo $row_tr4['tgl_invoice'];?> - <?php echo $row_tr4['tgl_periodesewa'];?></td>

        </tr>

      <tr>

        <td valign="top">Nopol</td>

        <td valign="top">:</td>

        <td valign="top"><?php echo $row_tr4['nopolisi'];?></td>

      </tr>

    </table></td>

  </tr>



  <tr valign="top">

    <td colspan="2" align="center" valign="top"><table align="left" width="1209" height="130" border="1">

      <tr>

        <td height="8" colspan="2"><div align="center">Pembayaran Cheque / Bilyet Giro / Credit Card </div></td>

        <td width="248"><div align="center">Accounting</div></td>

      </tr>

      <tr>

        <td width="467" height="8"><div align="center">Bank                                     </div></td>

        <td width="472"><div align="center">No.CQ/BG</div></td>

        <td width="248" rowspan="3"><p>&nbsp;</p>          </td>

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