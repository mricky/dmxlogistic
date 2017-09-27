<?php require_once('../connections/con_gl.php'); ?>

<?php

session_start();

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
mysql_select_db($database_con_gl, $con_gl);
$query_status = "select * from v_kasir where no_ref = '$_GET[noreferensi]'";
$status = mysql_query($query_status, $con_gl) or die(mysql_error());
$row_status = mysql_fetch_assoc($status);

$query_brg = "SELECT gl_masterkendaraan.nopolisi, gl_merkkendaraan.merk, gl_masterkendaraan.warnautama,gl_tipekendaraan.tipekendaraan,gl_detailtrans.ppn,gl_detailtrans.pph, gl_detailtrans.hargasatuan, gl_detailtrans.diskon, gl_detailtrans.diskonamount FROM gl_detailtrans, gl_masterkendaraan, gl_tipekendaraan, gl_merkkendaraan WHERE gl_detailtrans.no_ref='$_GET[noreferensi]' AND gl_detailtrans.kendaraan = gl_masterkendaraan.nopolisi AND gl_merkkendaraan.id = gl_masterkendaraan.merk AND gl_tipekendaraan.id = gl_masterkendaraan.tipekendaraan";
//printf($query_brg);
$brg = mysql_query($query_brg, $con_gl) or die(mysql_error());

$row_brg = mysql_fetch_assoc($brg);
$jumlah = $row_brg['jumlah']; if($jumlah == 0) $jumlah=1;
$totalRows_brg = mysql_num_rows($brg);

$query_data = "select a.id, a.tgl, a.noref, a.info, g.nama, b.nopolisi, b.tahun, b.norangka, b.nomesin, c.tipekendaraan, d.jmlhr, d.jmlwkt, e.merk, b.warnautama,d.tujuan, d.kontak, d.checkin, d.waktucheckout, d.waktucheckin, d.checkout, d.waktucheckout, d.bbm, d.tol, d.supir, d.parkir, d.akomod, d.other, h.transaksi,h.hargasatuan, h.diskon, h.diskonamount, h.ppn from gl_kkeluar a, gl_masterkendaraan b, gl_tipekendaraan c, gl_retailtrans d, gl_merkkendaraan e, gl_kontak g, gl_detailtrans h where a.id='$_GET[id]' AND a.kendaraan = b.nopolisi AND b.tipekendaraan = c.id AND b.merk = e.id AND a.noref = d.no_ref AND g.id=a.driver AND. d.no_ref=h.no_ref";
$data = mysql_query($query_data, $con_gl) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$jumlah = $row_data['jumlah']; if($jumlah == 0) $jumlah=1;

}else{
//Ini untuk query cust. corporate
$query_data = "select a.id, a.tgl, a.noref, a.info, a.driver, b.nopolisi, b.tahun, b.norangka, b.nomesin, c.tipekendaraan, e.merk, d.kontrak from gl_kkeluar a, gl_masterkendaraan b, gl_tipekendaraan c, gl_dkontrak d, gl_merkkendaraan e where a.id='$_GET[id]' AND a.kendaraan = b.nopolisi AND b.tipekendaraan = c.id AND b.merk = e.id AND a.noref = d.kontrak";
$data = mysql_query($query_data, $con_gl) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
list($row_data['kontak']) = mysql_fetch_row(mysql_query("select kontak from gl_kontrak where no = '$row_data[noref]' "));
}
// --- get ppn
$ppn = mysql_query("SELECT gl_trans.transaksi, gl_trans.total FROM gl_trans WHERE gl_trans.transaksi='Beban Pajak' AND gl_trans.no_ref='$row_data[noref]'", $con_gl) or die(mysql_error());
$row_getppn = mysql_fetch_assoc($ppn);

// get biaya operational

mysql_select_db($database_con_gl, $con_gl);

$query_getopr = "select (a.akomod + a.bbm + a.other + a.parkir + a.supir + a.tol) as biayaops from gl_retailtrans a where a.no_ref ='$_GET[referensi]'";
$getopr = mysql_query($query_getopr, $con_gl) or die(mysql_error());

$row_getopr = mysql_fetch_assoc($getopr);

$totalRows_getopr = mysql_num_rows($getopr);

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
    <td width="141" align="left" valign="top"><h5><img src="../m_logo.png" alt="" width="140" height="34" /></h5>
    </td>
    <td width="516" align="right" valign="top"><h3>SURAT PERINTAH JALAN (SPJ) </h3></td>
    <td width="517" align="center" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="left" valign="top"><strong>DATE : </strong><?php echo date("l F j, Y, g:i a"); ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td colspan="4"><strong><p>KENDARAAN KELUAR</p></strong></td>
        <td colspan="4" ><strong>KENDARAAN MASUK</strong>  </td>
        </tr>
      <tr>
        <td width="15%"><strong>Fuel</strong></td>
        <td width="1%" align="center">:</td>
        <td width="16%" valign="top"><img src="../images/indikator_bensin.png" alt="" width="94" height="51" /></td>
        <td width="17%" valign="top"><strong>KM :</strong> 
          <input name="kmawal" type="text" id="kmawal" size="10" maxlength="10" /></td>
        <td width="12%" valign="top"><strong>Fuel</strong></td>
        <td width="1%" valign="top">:</td>
        <td width="27%" valign="top"><img src="../images/indikator_bensin.png" alt="" width="94" height="51" /></td>
        <td width="11%" valign="top"><strong>KM : </strong>
          <input name="kmakhir" type="text" id="kmakhir" size="10" maxlength="10" /></td>
      </tr>
      
      <tr>
        <td colspan="8"><div align="left"><strong>DATA CUSTOMER</strong></div></td>
      </tr>
      <tr>
        <td>Nama</td>
        <td align="center">:</td>
        <td colspan="2" valign="top"><?php echo $row_cust['nama'];?></td>
        <td valign="top">Destination</td>
        <td valign="top">:</td>
        <td colspan="2" rowspan="3" valign="top"><?php echo $row_data['tujuan'];?></td>
        </tr>
      <tr>
        <td>Alamat</td>
        <td align="center">:</td>
        <td colspan="2" valign="top"><?php echo $row_cust['alamat'];?></td>
        <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
        </tr>
      <tr>
        <td>No. Telp</td>
        <td align="center">:</td>
        <td colspan="2" valign="top"><?php echo $row_cust['tlp'];?></td>
        <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
        </tr>
      
      <tr>
        <td colspan="4"><div align="left"><strong>DATA KENDARAAN</strong></div></td>
        <td colspan="4"><div align="center"></div></td>
      </tr>
      <tr>
        <td>No. Polisi</td>
        <td align="center">:</td>
        <td colspan="2" valign="top"><?php echo $row_data['nopolisi'];?></td>
        <td valign="top">Driver</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo $row_data['nama'];?></td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td>Merk</td>
        <td align="center">:</td>
        <td colspan="2" valign="top"><?php echo $row_data['merk'];?></td>
        <td valign="top">Duration</td>
        <td valign="top">:</td>
        <td colspan="2" valign="top"><?php echo $row_data['jmlhr'];?>hari </td>
        </tr>
      <tr>
        <td>Colour</td>
        <td align="center">:</td>
        <td colspan="2" valign="top"><?php echo $row_data['warnautama'];?></td>
        <td valign="top">Pickup Date</td>
        <td>:</td>
        <td colspan="2"><?php echo $row_data['waktucheckin'];?>  (
          <?php tanggal($row_data['checkin'],"tampilkan"); ?>
-
  <?php tanggal($row_data['checkout'],"tampilkan"); ?> )</td>
      </tr>
      <tr>
        <td>Tipe</td>
        <td align="center">:</td>
        <td colspan="2" valign="top"><?php echo $row_data['tipekendaraan'];?></td>
        <td valign="top">Pickup Detail</td>
        <td>:</td>
        <td colspan="2"><?php echo $row_data['transaksi'];?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" align="left" valign="top"><table width="100%" border="1" cellspacing="0" cellpadding="2">
      <tr>
        <td width="26%" align="center"><strong>Operasional Staff</strong></td>
        <td width="26%" align="center"><strong>Driver</strong></td>
      </tr>
      <tr align="center" valign="bottom">
        <td height="65"><?php echo $_SESSION[nama];?></td>
        <td height="65"><?php echo $row_driv['nama'];?></td>
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