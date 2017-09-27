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

$query_kontak = "SELECT gl_retailtrans.kontak, gl_kontak.nama, gl_kontak.alamat, gl_kontak.tlp FROM gl_retailtrans, gl_kontak WHERE gl_retailtrans.no_ref='$_GET[referensi]' AND gl_kontak.id = gl_retailtrans.kontak";

$kontak = mysql_query($query_kontak, $con_gl) or die(mysql_error());

$row_kontak = mysql_fetch_assoc($kontak);

$totalRows_kontak = mysql_num_rows($kontak);

//printf($query_kontak);





mysql_select_db($database_con_gl, $con_gl);

$query_tr4 = "SELECT * from v_kasir_penagihan a where a.id ='$_GET[id]' AND a.invoice_no='$_GET[invoice_no]'";

$tr4 = mysql_query($query_tr4, $con_gl) or die(mysql_error());

$row_tr4 = mysql_fetch_assoc($tr4);

$totalRows_tr4 = mysql_num_rows($tr4);



mysql_select_db($database_con_gl, $con_gl);

$query_company = "SELECT * FROM gl_gudang where id = '$row_tr4[gudang]'";

$company = mysql_query($query_company, $con_gl) or die(mysql_error());

$row_company = mysql_fetch_assoc($company);

$totalRows_company = mysql_num_rows($company);



mysql_select_db($database_con_gl, $con_gl);

$query_getppn = "select * from gl_kontrak inner join gl_retailtrans on gl_kontrak.`no` = gl_retailtrans.kontrak where gl_retailtrans.no_ref='$_GET[referensi]'";

$getppn = mysql_query($query_getppn, $con_gl) or die(mysql_error());

$row_getppn = mysql_fetch_assoc($getppn);

$totalRows_getppn = mysql_num_rows($getppn);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>BIMEX SYSTEM ONLINE : INVOICE  #<?php echo $_GET[referensi];?></title>

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

font-size:10px;

font-style:italic

}

#edisi tr td {

font-size:10px;

}

page[size="A4"] {

  background: white;

  width: 21cm;

  height: 29.7cm;

  display: block;

  margin: 0 auto;

  margin-bottom: 0.5cm;

  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);

}

@media print {

    .page {

        margin: 0;

        border: initial;

        border-radius: initial;

        width: initial;

        min-height: initial;

        box-shadow: initial;

        background: initial;

        page-break-after: always;

    }

}

</style>

</head>



<body onload="javascript: window.print();">

<table width="1200" border="0" align="left" cellpadding="5" cellspacing="0" style="border:solid 1px #000000;">

  <tr>

    <td colspan="3"><strong><?php echo $row_company['pajak_pt'];; ?></strong><br />

      <?php echo $row_company['keterangan']; ?>

Telp. <?php echo $row_company['tlp']; ?><br />

www.bimextour.com</td>

    <td><img src="../m_logo.png" alt="" width="172" height="37" /></td>

  </tr>

  <tr align="left">

    <td colspan="2" style="border-top:solid 1px #000000;border-bottom:solid 1px #000000;">To

      <br />

      <?php echo $row_tr4['nama']; ?><br />

      <?php echo $row_tr4['alamat']; ?><br />

    Tlp.<?php echo $row_tr4['tlp']; ?></td>

    <td align="center" style="border-left:solid 1px #000000;border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><strong>INVOICE <?php echo $_GET[invoice_no];?></strong></td>

    <td style="border-left:solid 1px #000000;border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><strong>DATE : </strong><?php echo date("l F j, Y, g:i a"); ?></td>

  </tr>

  <tr align="center">

    <td width="7%" style="border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><strong>NO</strong></td>

    <td width="30%" style="border-left:solid 1px #000000;border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><strong>ITEM</strong></td>

    <td width="43%" style="border-left:solid 1px #000000;border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><strong>DETAILS</strong></td>

    <td width="20%" style="border-left:solid 1px #000000;border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><strong>PRICE</strong></td>

  </tr>

  <?php

  /*Edited by suwondo*/

  $a = "select b.id as jenisid, b.tipekendaraan, c.nopolisi, harga, diskon, total, transaksi from gl_dkontrak a, gl_tipekendaraan b, gl_masterkendaraan c, gl_retailtrans d where a.kendaraan = c.nopolisi AND b.id = c.tipekendaraan AND a.kontrak = d.kontrak AND d.no_ref = '$_GET[referensi]' order by a.id"; 

 

  $b = mysql_query($a) or die (mysql_error());

  while(list($jenisid, $tipekendaraan, $nopolisi, $harga, $diskon, $total, $transaksi) = mysql_fetch_row($b)){

	$jen[] = $jenisid;

	$tipe[] = $tipekendaraan;

	$nopol[] = $nopolisi;

	$hrg[] = $harga;

	$disc[] = $diskon;

	$tot[] = $total;

	$trans[] = $transaksi;

  }

  ?>

  <tr valign="top" style="height:50px;">

    <td align="center" style="border-top:solid 1px #000000;border-bottom:solid 1px #000000;">1</td>

    <td style="border-left:solid 1px #000000;border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><?php echo $row_tr4['tipekendaraan']; ?> - <?php echo $row_tr4['nopolisi']; ?></td>

    <td style="border-left:solid 1px #000000;border-top:solid 1px #000000;border-bottom:solid 1px #000000;"> Periode Sewa <?php echo$row_tr4['tgl_invoice']; ?> - <?php echo$row_tr4['tgl_periodesewa']; ?></td>

    <td align="right" style="border-left:solid 1px #000000;border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><?php echo number_format($row_tr4['harga'],0,',','.').",-";?></td>

  </tr>

  <tr>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td align="right" valign="top" style="border-top:solid 1px #000000;border-left:solid 1px #000000;">Salary Driver :</td>

    <td align="right" valign="top" style="border-top:solid 1px #000000;border-left:solid 1px #000000;border-rights:solid 1px #000000;"><?php echo number_format($row_tr4['salary_driver'],0,',','.').",-";?></td>

  </tr>

  <tr>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td align="right" valign="top" style="border-top:solid 1px #000000;border-left:solid 1px #000000;">PPN 10% : </td>

    <td align="right" valign="top" style="border-top:solid 1px #000000;border-left:solid 1px #000000;border-rights:solid 1px #000000;"><?php echo number_format($row_tr4['ppnunit'],0,',','.').",-";?></td>

  </tr>

  <tr>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td align="right" valign="top" style="border-top:solid 1px #000000;border-left:solid 1px #000000;border-bottom:solid 1px #000000;">Total : </td>

    <td align="right" valign="top" style="border-top:solid 1px #000000;border-left:solid 1px #000000;border-rights:solid 1px #000000;border-bottom:solid 1px #000000;"><?php echo number_format($row_tr4['total'],0,',','.').",-";?></td>

  </tr>

  

  <tr>

    <td style="border-top:solid 1px #000000;border-left:solid 1px #000000;border-bottom:solid 1px #000000;"> Says :</td>

    <td colspan="3" align="center" style="border-top:solid 1px #000000;border-rights:solid 1px #000000;border-bottom:solid 1px #000000;"><strong><i>#<?php echo ucwords(Terbilang($row_tr4['total']));?> Rupiah #</i></strong></td>

  </tr>

  <tr>

    <td colspan="2"><strong>Account Number</strong></td>

    <td align="right">&nbsp;</td>

    <td align="center"><strong>Regards</strong></td>

  </tr>

  <tr valign="top">

    <td colspan="2"><p>Bank : <?php echo $row_company['bank']; ?><br />

      No. <?php echo $row_company['norek']; ?><br />

      <?php echo $row_company['atasnama']; ?> </p>

      <p><br />

    </p></td>

    <td>Bank : BNI<br />

No. 210 219 6163<br />

PT. BIRAMA IDAMAN EXPRESS</td>

    <td align="center"><p><br />

      </p>

      <p><br />

        <br />

        <br />

        <strong style="text-decoration:underline"><?php echo ucfirst($_SESSION[nama]);?></strong></p></td>

  </tr>

  <tr>

    <td colspan="4" style="border:solid 1px #000000;border-right:none;font-size:12px;"><strong>Notes :</strong>    Lembar asli sebagai bukti penagihan, kwitansi pembayaran akan diberikan bila customer telah melakukan transaksi pembayaran melalui cash/transfer ke <?php echo $row_company['atasnama']; ?></td>

  </tr>

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



mysql_free_result($tr2);



mysql_free_result($tr3);



mysql_free_result($tr4);

?>

