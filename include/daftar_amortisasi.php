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

$query_tr4 = "SELECT * from v_amortisasi a where  a.kontrak='$_GET[referensi]'";

$tr4 = mysql_query($query_tr4, $con_gl) or die(mysql_error());

$row_tr4 = mysql_fetch_assoc($tr4);

$totalRows_tr4 = mysql_num_rows($tr4);



mysql_select_db($database_con_gl, $con_gl);

$query_tr5 = "SELECT * from v_amortisasi a where  a.kontrak='$_GET[referensi]'";

$tr5 = mysql_query($query_tr5, $con_gl) or die(mysql_error());

$row_tr5= mysql_fetch_assoc($tr5);

$totalRows_tr5 = mysql_num_rows($tr5);

$pembayaran = 0;

do{

	$pembayaran += $row_tr5['pembayaran'];

} while ($row_tr5 = mysql_fetch_assoc($tr5)); 

//printf($query_tr4);





?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Untitled Document</title>

</head>



<body>

<table width="710" border="0" align="center" cellpadding="0" cellspacing="0" style="border:solid 1px #000000;">

  <tr>

    <td colspan="10"><img src="../mrent_logo.png" alt="" width="163" height="107" /></td>

  </tr>

  <tr>

    <td colspan="10" align="center"><strong>DAFTAR AMORTISASI SECARA EFEKTIF</strong></td>

  </tr>

  <tr>

    <td colspan="2">Nomor Dealer</td>

    <td colspan="6"><?php echo $row_tr4['kodecabang'];?> - <?php echo $row_tr4['cabang'];?></td>

    <td>Jumlah Pembiayaan</td>

    <td><?php echo number_format($row_tr4['total'],0,',','.').",-";?></td>

  </tr>

  <tr>

    <td colspan="2">Jenis Piutang</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>Nilai Tebus</td>

    <td><span style="border-bottom:solid 1px #000000;border-right:solid 1px #000000"><?php echo number_format($row_tr4['nilai_tebus'],0,',','.').",-";?></span></td>

  </tr>

  <tr>

    <td colspan="2">Pola Transaksi</td>

    <td><?php 

	if($row_tr4['is_cop']== 1)

	{

		echo "COP";

	}else

	{

		echo "RENTAL BULANAN";

	}?></td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td colspan="2">No PJJ</td>

    <td colspan="5"><?php echo $row_tr4['kontrak'];?> - <?php echo $row_tr4['nama'];?></td>

    <td>&nbsp;</td>

    <td>Harga Pembelian</td>

    <td><?php echo number_format($row_tr4['otr'],0,',','.').",-";?></td>

  </tr>

  <tr>

    <td colspan="2">Masa Angsuran</td>

    <td><?php echo $row_tr4['durasi'];?></td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td colspan="2">Tgl Angsuran Ke-1</td>

    <td><?php echo $row_tr4['tgl_invoice'];?></td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>Jumlah Piutang</td>

    <td><span style="border-bottom:solid 1px #000000;border-right:solid 1px #000000"><?php echo number_format($row_tr4['otr'],0,',','.').",-";?></span></td>

  </tr>

  <tr>

    <td colspan="2">Angsuran Per Bulan</td>

    <td width="7%"><?php echo number_format($row_tr4['angsuran'],0,',','.').",-";?></td>

    <td width="7%">&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td width="20%" style="border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><strong>Tgl JT Tempo</strong></td>

    <td width="4%" style="border-left:solid 1px #000000;border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><strong>ANG KE</strong></td>

    <td style="border-left:solid 1px #000000;border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><strong>POKOK</strong></td>

    <td style="border-left:solid 1px #000000;border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><strong>BUNGA</strong></td>

    <td style="border-left:solid 1px #000000;border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><strong>BESAR ANGSURAN</strong></td>

    <td style="border-left:solid 1px #000000;border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><strong>SISA POKOK</strong></td>

    <td style="border-left:solid 1px #000000;border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><strong>SISA BUNGA</strong></td>

    <td style="border-left:solid 1px #000000;border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><strong>JUMLAH BUNGA</strong></td>

    <td style="border-left:solid 1px #000000;border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><strong>JML ANGSURAN</strong></td>

    <td style="border-left:solid 1px #000000;border-top:solid 1px #000000;border-bottom:solid 1px #000000;border-right:solid 1px #000000"><strong>- % Bunga -</strong></td>

  </tr>

  <?php

  

    	

   do {

	   $angsuran += $row_tr4['angsuran'];

		$sisa_pokok += $row_tr4['sisa_pokok'];

		$jml_angsuran += $row_tr4['angsuran_bayar'];

		

 ?>

  <tr valign="top" bgcolor="#FFFFFF"">

    <td style="border-bottom:solid 1px #000000;border-right:solid 1px #000000"><?php echo $row_tr4['tgl_invoice'];?></td>

    <td style="border-bottom:solid 1px #000000;border-right:solid 1px #000000" align="center"><?php 

	if($row_tr4['pmb_nominal'] != 0)

	{

	   echo "*".$row_tr4['periode'];

	}

    else

    {

       echo $row_tr4['periode'];

    }

	?>

	</td>

    <td style="border-bottom:solid 1px #000000;border-right:solid 1px #000000" align="center">0</td>

    <td style="border-bottom:solid 1px #000000;border-right:solid 1px #000000" align="center">0</td>

    <td style="border-bottom:solid 1px #000000;border-right:solid 1px #000000" align="right"><?php echo number_format($row_tr4['angsuran'],0,',','.').",-";?></td>

    <td style="border-bottom:solid 1px #000000;border-right:solid 1px #000000" align="right"><?php echo number_format($row_tr4['sisa_pokok'],0,',','.').",-";?></td>

    <td style="border-bottom:solid 1px #000000;border-right:solid 1px #000000" align="center">0</td>

    <td style="border-bottom:solid 1px #000000;border-right:solid 1px #000000" align="center">0</td>

    <td style="border-bottom:solid 1px #000000;border-right:solid 1px #000000" align="right"><?php echo number_format($row_tr4['angsuran_bayar'],0,',','.').",-";?></td>

    <td style="border-bottom:solid 1px #000000;border-right:solid 1px #000000">&nbsp;</td>

  </tr>

 <?php } while ($row_tr4 = mysql_fetch_assoc($tr4)); ?>

  <tr>

    <td colspan="2"><strong>TOTAL</strong></td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td><span style="border-bottom:solid 1px #000000;border-right:solid 1px #000000"><strong><?php echo number_format($angsuran,0,',','.').",-";?></span></strong></td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

  </tr>

</table>

</body>

</html>