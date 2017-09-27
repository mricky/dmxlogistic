<?php require_once('../connections/con_gl.php'); ?>
<?php
echo 'done';
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
$query_tr1 = "SELECT gl_trans.jumlah, gl_satuan.satuan FROM gl_trans, gl_satuan WHERE gl_satuan.id=gl_trans.satuan AND gl_trans.no_ref='$_GET[referensi]' ORDER BY gl_trans.id desc";
$tr1 = mysql_query($query_tr1, $con_gl) or die(mysql_error());
$row_tr1 = mysql_fetch_assoc($tr1);
$totalRows_tr1 = mysql_num_rows($tr1);

mysql_select_db($database_con_gl, $con_gl);
$query_tr2 = "SELECT gl_barang.barang, gl_trans.barang as kdbrg FROM gl_barang, gl_trans WHERE gl_trans.barang = gl_barang.id AND gl_trans.no_ref='$_GET[referensi]' ORDER BY gl_trans.id desc";
$tr2 = mysql_query($query_tr2, $con_gl) or die(mysql_error());
$row_tr2 = mysql_fetch_assoc($tr2);
$totalRows_tr2 = mysql_num_rows($tr2);

mysql_select_db($database_con_gl, $con_gl);
$query_tr3 = "SELECT gl_trans.transaksi FROM gl_trans WHERE gl_trans.no_ref='$_GET[referensi]' AND gl_trans.barang<>'' ORDER BY gl_trans.id desc";
$tr3 = mysql_query($query_tr3, $con_gl) or die(mysql_error());
$row_tr3 = mysql_fetch_assoc($tr3);
$totalRows_tr3 = mysql_num_rows($tr3);

mysql_select_db($database_con_gl, $con_gl);
$query_tr4 = "SELECT gl_trans.hargasatuan, gl_trans.transaksi, gl_trans.diskon, gl_trans.total, gl_trans.jumlah FROM gl_trans WHERE gl_trans.barang<>'' AND gl_trans.no_ref='$_GET[referensi]' ORDER BY gl_trans.id desc";
$tr4 = mysql_query($query_tr4, $con_gl) or die(mysql_error());
$row_tr4 = mysql_fetch_assoc($tr4);
$totalRows_tr4 = mysql_num_rows($tr4);

mysql_select_db($database_con_gl, $con_gl);
$query_getppn = "SELECT gl_trans.transaksi, gl_trans.total FROM gl_trans WHERE gl_trans.transaksi='Beban Biaya lain' AND gl_trans.no_ref='$_GET[referensi]'";
$getppn = mysql_query($query_getppn, $con_gl) or die(mysql_error());
$row_getppn = mysql_fetch_assoc($getppn);
$totalRows_getppn = mysql_num_rows($getppn);
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
font-size:32px;
font-style:italic
}
</style>
</head>

<body>
<table width="700" border="0" align="center" cellpadding="5" cellspacing="0" style="border:solid 1px #000000;">
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr valign="top">
    <td colspan="2" align="center"><strong><?php echo $row_company['perusahaan']; ?></strong><br />
      <?php echo $row_company['alamat']; ?><br />
    Telp. <?php echo $row_company['telp']; ?> Fax. <?php echo $row_company['fax']; ?><br /></td>
    <td width="35%" align="center" valign="middle"><img src="../<?php echo $row_company['logo']; ?>" /></td>
    <td colspan="2"><table width="100%" border="0" cellpadding="2" cellspacing="0" id="edisi">
      <tr>
        <td width="47%" align="right" style="border-top:solid 1px #000000;border-left:solid 1px #000000;">Edisi : </td>
        <td width="53%" style="border-top:solid 1px #000000;border-left:solid 1px #000000;border-right:solid 1px #000000;"><?php $ed = explode(" | ",$row_brg['barang']); echo $ed[0];?></td>
      </tr>
      <tr>
        <td align="right" style="border-top:solid 1px #000000;border-left:solid 1px #000000;">Job No : </td>
        <td style="border-top:solid 1px #000000;border-left:solid 1px #000000;border-right:solid 1px #000000;"><?php echo $_GET[referensi];?></td>
      </tr>
      <tr>
        <td align="right" style="border-top:solid 1px #000000;border-left:solid 1px #000000;">No PO : </td>
        <td style="border-top:solid 1px #000000;border-left:solid 1px #000000;border-right:solid 1px #000000;">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" style="border-top:solid 1px #000000;border-left:solid 1px #000000;">Tanggal Invoice : </td>
        <td style="border-top:solid 1px #000000;border-left:solid 1px #000000;border-right:solid 1px #000000;"><?php tanggal($row_gettgl['tgl'],"tampilkan"); ?></td>
      </tr>
      <tr>
        <td align="right" style="border-top:solid 1px #000000;border-left:solid 1px #000000;border-bottom:solid 1px #000000;">Jatuh Tempo : </td>
        <td style="border-top:solid 1px #000000;border-left:solid 1px #000000;border-right:solid 1px #000000;border-bottom:solid 1px #000000;"><?php tanggal($row_gettgl['jatuhtempo'],"tampilkan"); ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="11%">&nbsp;</td>
    <td width="18%">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="21%">&nbsp;</td>
    <td width="15%">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" style="border-top:solid 1px #000000;border-bottom:solid 1px #000000;">Kepada<br />
    <br />
    <?php echo $row_kontak['nama']; ?><br /><?php echo $row_kontak['alamat']; ?><br />Tlp.<?php echo $row_kontak['tlp']; ?></td>
    <td colspan="3" align="center" style="border-left:solid 1px #000000;border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><h2>INVOICE#<?php echo $_GET[referensi];?></h2></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><strong>Ukuran / Qty </strong></td>
    <td style="border-left:solid 1px #000000;border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><strong>Letak</strong></td>
    <td colspan="2" style="border-left:solid 1px #000000;border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><strong>Keterangan</strong></td>
    <td style="border-left:solid 1px #000000;border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><strong>Tarif</strong></td>
  </tr>
  <tr valign="top" style="height:300px;">
    <td style="border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><ul style="list-style:none;margin:0;padding:0;">
      <?php do { ?>
        <li><?php echo $row_tr1['jumlah']; ?> <?php echo $row_tr1['satuan']; ?></li>
        <?php } while ($row_tr1 = mysql_fetch_assoc($tr1)); ?></ul></td>
    <td style="border-left:solid 1px #000000;border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><ul style="list-style:none;margin:0;padding:0;">
      <?php do { ?>
        <li><?php $let = explode(" | ",$row_tr2['barang']);echo $let[1]; ?></li>
    <?php } while ($row_tr2 = mysql_fetch_assoc($tr2)); ?></ul></td>
    <td colspan="2" style="border-left:solid 1px #000000;border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><ul style="list-style:none;margin:0;padding:0;">
      <?php do { ?>
        <li><?php echo $row_tr3['transaksi']; ?></li>
    <?php } while ($row_tr3 = mysql_fetch_assoc($tr3)); ?></ul></td>
    <td align="right" style="border-left:solid 1px #000000;border-top:solid 1px #000000;border-bottom:solid 1px #000000;"><ul style="list-style:none;margin:0;padding:0;">
      <?php $subtotal =0; $diskon =0; do { ?>
        <li><?php echo number_format($row_tr4['hargasatuan'],0,',','.').",-"; $subtotal += $row_tr4['jumlah']*$row_tr4['hargasatuan'];$tmpdis = intval($row_tr4[diskon] * $row_tr4['total']) / 100;$diskon += $tmpdis;?></li>
        <?php } while ($row_tr4 = mysql_fetch_assoc($tr4)); ?></ul></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" align="right" valign="top" style="border-tops:solid 1px #000000;border-left:solid 1px #000000;">Subtotal : </td>
    <td align="right" valign="top" style="border-tops:solid 1px #000000;border-left:solid 1px #000000;border-rights:solid 1px #000000;"><?php echo number_format($subtotal,0,',','.').",-";?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" align="right" valign="top" style="border-top:solid 1px #000000;border-left:solid 1px #000000;">Diskon : </td>
    <td align="right" valign="top" style="border-top:solid 1px #000000;border-left:solid 1px #000000;border-rights:solid 1px #000000;"><?php echo number_format($diskon,0,',','.').",-";?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" align="right" valign="top" style="border-top:solid 1px #000000;border-left:solid 1px #000000;">Total (Sebelum PPN) :  </td>
    <td align="right" valign="top" style="border-top:solid 1px #000000;border-left:solid 1px #000000;border-rights:solid 1px #000000;"><?php $tep = intval($subtotal - $diskon); echo number_format($tep,0,',','.').",-";?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" align="right" valign="top" style="border-top:solid 1px #000000;border-left:solid 1px #000000;">PPN 10% : </td>
    <td align="right" valign="top" style="border-top:solid 1px #000000;border-left:solid 1px #000000;border-rights:solid 1px #000000;"><?php $ppn = intval($tep*10/100); echo number_format($ppn,0,',','.').",-";?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" align="right" valign="top" style="border-top:solid 1px #000000;border-left:solid 1px #000000;border-bottoms:solid 1px #000000;">Biaya Lainnya : </td>
    <td align="right" valign="top" style="border-top:solid 1px #000000;border-left:solid 1px #000000;border-rights:solid 1px #000000;border-bottoms:solid 1px #000000;"><?php echo number_format($row_getppn['total'],0,',','.').",-"; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" align="right" valign="top" style="border-top:solid 1px #000000;border-left:solid 1px #000000;border-bottom:solid 1px #000000;">Total : </td>
    <td align="right" valign="top" style="border-top:solid 1px #000000;border-left:solid 1px #000000;border-rights:solid 1px #000000;border-bottom:solid 1px #000000;"><?php $ttol = intval($tep+$ppn+$row_getppn['total']); echo number_format($ttol,0,',','.').",-";?></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">Terbilang</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3" align="center" style="border-top:solid 1px #000000;border-left:solid 1px #000000;border-rights:solid 1px #000000;border-bottom:solid 1px #000000;"><strong><i>#<?php echo ucwords(Terbilang($ttol));?>#</i></strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>Rekening Bank </strong></td>
    <td colspan="2" align="right">&nbsp;</td>
    <td align="center"><strong>Hormat Kami </strong></td>
  </tr>
  <tr valign="top">
    <td>&nbsp;</td>
    <td colspan="3"><?php echo $row_company['cabang']; ?><br />
      No. <?php echo $row_company['norek']; ?> a.n<br />
      <?php echo $row_company['atasnama']; ?> <br /></td>
    <td align="center"><br />
        <br />
      <br />
      <strong style="text-decoration:underline">Yulianah</strong><br />
    Koord. Penagihan</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3" align="center" style="border:solid 1px #000000;">Ketik Bayar Iklan&lt;spasi&gt;Tanggal&lt;spasi&gt;Nama Produk&lt;spasi&gt;Jumlah Tagihan&lt;spasi&gt;No.Rek/A.n<br />
    SMS via  085697466706,  081585129701 </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">Catatan : Seluruh Ummi Group Media tidak menerima imbalan atau pemberian apapun dari pihak luar selama menjalankan tugas <br />
      Lembar asli sebagai bukti penagihan dan sebagai tanda terima pembayaran bila telah cari di rekening bank <?php echo $row_company['atasnama']; ?></td>
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
