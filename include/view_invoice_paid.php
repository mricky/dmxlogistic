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



$query_invoice = "SELECT * FROM v_invoice where KODEINVOICE ='$_GET[noinvoice]'";
$invoice = mysql_query($query_invoice, $con_gl) or die(mysql_error());
$row_invoice = mysql_fetch_assoc($invoice);


$query_listbayar = "SELECT * from v_pembayaran_invoice where KODEINVOICE = '$_GET[noinvoice]'";
$order_listbayar  = mysql_query($query_listbayar, $con_gl) or die(mysql_error());
$row_order_listbayar = mysql_fetch_assoc($order_listbayar);
$totalRows_order_listbayar = mysql_num_rows($order_listbayar);



//printf($query_detail);





mysql_select_db($database_con_gl, $con_gl);



$query_invoice = "SELECT * FROM v_invoice where KODEINVOICE ='$_GET[noinvoice]'";
$invoice = mysql_query($query_invoice, $con_gl) or die(mysql_error());

$row_invoice = mysql_fetch_assoc($invoice);




//printf($query_tiketing);











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



font-size:12px;



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



    <td width="39%" rowspan="2" align="left" valign="top"><h2>&nbsp;</h2>

    </td>

    <td width="22%" rowspan="2" align="left" valign="top"><h2>Histori Pembayaran</h2></td>

    <td width="39%" align="left" valign="top"><strong>DATE : </strong><?php echo date("l F j, Y, g:i a"); ?></td>

  </tr>

  <tr>

    <td align="left" valign="top"><strong>NOMOR : <?php echo $_GET['noinvoice'];?></strong></td>

  </tr>



  <tr>

    <td colspan="3" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="4">

      <tr>

        <td width="10%" valign="top">Customer</td>

        <td width="1%" valign="top">:</td>

        <td width="46%" valign="top"><?php echo $row_invoice['NAMACUSTOMER'];?></td>

        <td width="8%" valign="top">&nbsp;</td>
        <td width="35%" valign="top">&nbsp;</td>
      </tr>

      <tr>
        <td valign="top">Total Tagihan</td>
        <td valign="top">:</td>
        <td valign="top"><span style="background:#EEE;font-weight:bold;text-decoration:underline;"><strong>
          <?php  echo number_format($row_invoice['TOTAL_CHARGE'],0,',','.');?>
        </strong> ,-</span></td>
        <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>

        <td valign="top">Total Bayar</td>

        <td valign="top">:</td>

        <td valign="top"><span style="background:#EEE;font-weight:bold;text-decoration:underline;"><strong>
          <?php  echo number_format($row_invoice['TOTALBAYAR'],0,',','.');?>
        </strong> ,-</span></td>

        <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
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

        <th><strong>Tanggal</strong></th>

        <th><strong>No Transfer</strong></th>

        <th>Jenis Bayar </th>

        <th>Metode Bayar </th>

        <th>Kasir</th>
        <th><strong>Nominal</strong></th>
      </tr>

      <?php $no=1; do { ?>

      <tr valign="top">

        <td width="2%" align="left"><?php echo $no;$no++;?>.</td>

        <td width="24%"><?php echo $row_order_listbayar['TGLBAYAR']; ?></td>

        <td width="16%"><?php echo $row_order_listbayar['NOTRANSFER']; ?></td>

        <td width="11%"align ="center"><?php echo $row_order_listbayar['NAMAJENISBAYAR']; ?></td>

        <td width="28%"align="right"><?php echo $row_order_listbayar['METODEBAYAR']; ?></td>

        <td width="19%" align="right"><?php echo $row_order_listbayar['CREATED_BY']; ?></td>
        <td width="19%" align="right"><?php echo number_format($row_order_listbayar['TOTALBAYAR'],0,',','.').",-"; ?></td>
      </tr>

      <?php }while($row_order_listbayar = mysql_fetch_assoc($order_listbayar)); ?>

    </table></td>

  </tr>



  <tr valign="top">

    <td colspan="3" align="center" valign="top"><table align="left" width="1209" height="38" border="1">

      <tr>

        <td width="939" height="32" colspan="2"><strong>Says : <i><?php echo ucwords(Terbilang($row_invoice['TOTALBAYAR']));?></i>Rupiah</strong></td>

        <td width="248" height="32" align="right"><strong>Total : <span style="background:#EEE;font-weight:bold;text-decoration:underline;">
        <?php  echo number_format($row_invoice['TOTALBAYAR'],0,',','.');?>
        </span>
           
          <span style="background:#EEE;font-weight:bold;text-decoration:underline;">            </span></strong></td>
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