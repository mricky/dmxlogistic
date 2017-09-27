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

$query_detail = "SELECT * FROM v_ticketing_detail where noreferensico ='$_GET[referensi]'";



$detail = mysql_query($query_detail, $con_gl) or die(mysql_error());



$row_detail = mysql_fetch_assoc($detail);



//printf($row_detail);





mysql_select_db($database_con_gl, $con_gl);



$query_tiketing = "SELECT * FROM v_ticketing where noreferensico ='$_GET[referensi]'";



$ticketing = mysql_query($query_tiketing, $con_gl) or die(mysql_error());



$row_ticketing = mysql_fetch_assoc($ticketing);



//printf($query_tiketing);

mysql_select_db($database_con_gl, $con_gl);

$query_company = "SELECT * FROM gl_gudang where id = '74'";

$company = mysql_query($query_company, $con_gl) or die(mysql_error());

$row_company = mysql_fetch_assoc($company);

$totalRows_company = mysql_num_rows($company);







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



    <td rowspan="2" align="left" valign="top"><strong><?php echo $row_company['pajak_pt'];; ?></strong><br />

      <?php echo $row_company['keterangan']; ?> Telp. <?php echo $row_company['tlp']; ?><br />

www.bimextour.com</td>

    <td width="29%" rowspan="2" align="center" valign="top"><h2>INVOICE</h2></td>

    <td width="37%" align="left" valign="top"><strong>DATE : </strong><?php echo date("l F j, Y, g:i a"); ?></td>

  </tr>

  <tr>

    <td align="left" valign="top"><strong>NOMOR :</strong><?php echo $_GET['referensi'];?></td>

  </tr>



  <tr>



    <td colspan="3" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="4">

      <tr>

        <td width="5%" valign="top">Name</td>

        <td width="1%" valign="top">:</td>

        <td width="57%" valign="top"><?php echo $row_ticketing['customer'];?></td>

        <td width="9%" valign="top">Email</td>

        <td width="1%" valign="top">:</td>

        <td width="27%" valign="top"><?php echo $row_ticketing['emailalt'];?></td>

      </tr>

      <tr>

        <td valign="top">Address</td>

        <td valign="top">:</td>

        <td valign="top"><?php echo $row_ticketing['alamat'];?></td>

        <td valign="top">Phone</td>

        <td valign="top">:</td>

        <td valign="top"><?php echo $row_ticketing['hp'];?></td>

      </tr>

    </table></td>



  </tr>



  <tr>



    <td colspan="3" align="left" valign="top" style="border:solid 1px #000;border-left:none;"><strong>Details</strong></td>



  </tr>



  <tr>



    <td colspan="3" align="left" valign="top"><table width="100%" border="1" cellspacing="0" cellpadding="4">

      <tr>

        <th>No</th>

        <th>Customer</th>

        <th>City</th>

        <th>Description</th>

        <th>Fare</th>

      </tr>

      <?php $no=1; do { ?>

      <tr valign="top">

        <td width="3%" align="left"><?php echo $no;$no++;?>.</td>

        <td width="15%"><?php echo $row_detail['hotel'];?></td>

        <td width="16%"><?php echo $row_detail['kota_hotel'];?></td>

        <td width="51%"><?php echo $row_detail['info_hotel'];?></td>

        <td width="15%" align="right"><span style="background:#EEE;font-weight:bold;text-decoration:underline;">

          <?php  echo number_format($row_detail['nominaljual_hotel'],0,',','.');?>

        </span></td>

      </tr>

      <?php }while($row_detail = mysql_fetch_assoc($detail)); ?>

    </table></td>



  </tr>



  <tr>



    <td colspan="3" align="right" valign="top"><table align="left" width="1209" height="113" border="1">

      <tr>

        <td height="8" colspan="2" align="left"><strong>Says : </strong><i><?php echo ucwords(Terbilang($row_ticketing['nominaljual_hotel']));?> Rupiah</i></td>

        <td height="8" colspan="2" align="right"><strong>Total : <span style="background:#EEE;font-weight:bold;text-decoration:underline;">

          <?php  echo number_format($row_ticketing['nominaljual_hotel'],0,',','.');?>

        </span></strong></td>

        </tr>

      <tr>

        <td height="8"><strong>Account Number</strong></td>

        <td width="684" height="8">&nbsp;</td>

        <td width="162"><div align="center">Customer</div></td>

        <td width="177"><div align="center">Accounting</div></td>

      </tr>

      <tr>

        <td width="158">Bank : <?php echo $row_company['bank']; ?><br />

          No. <?php echo $row_company['norek']; ?><br />

  <?php echo $row_company['atasnama']; ?></td>

        <td>Bank : BNI<br />

          No. 210 219 6163<br />

          PT. BIRAMA IDAMAN EXPRESS</td>

        <td>&nbsp;</td>

        <td width="177"><p>&nbsp;</p></td>

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