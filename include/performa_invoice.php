<?php require_once('../connections/con_gl.php'); ?>
<?php
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
$query_tr1 = "SELECT gl_trans.jumlah, gl_satuan.satuan, gl_trans.hargasatuan, gl_trans.total, gl_trans.diskon, gl_barang.barang FROM gl_trans, gl_satuan, gl_barang WHERE gl_satuan.id=gl_trans.satuan AND gl_trans.no_ref='$_GET[referensi]' AND gl_barang.id=gl_trans.barang ORDER BY gl_trans.id desc";
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Performa Invoice</title>
<style>
@charset "utf-8";
/* CSS Document */
.utama{
	padding-left:10px;
	padding-right:20px;
	padding-bottom:10px;
	padding-top:10px;
	border-bottom:4px solid #003046;
}
.txt1-1{
	color:#333;
	font-family:arial;
	font-size:36px;
	font-weight:bold;
	letter-spacing:3px;
}
.txt1-2{
	color:#333;
	font-family:arial;
	font-size:14pxpx;
	letter-spacing: 2px;
	font-weight:bold;
}
.txt2-1{
	text-transform:uppercase;
	font-size:24px;
	font-family:"Times New Roman", Times, serif;
	letter-spacing: 10px;
	padding-bottom:10px;
	padding-top:5px;
}
.txt2-2{
	text-transform:uppercase;
	font-size:14pxpx;
	font-family:Arial;
	font-weight:bold;
	letter-spacing: 3px;
	padding-bottom:10px;
	padding-top:5px;
}
.txt2-3{
	text-transform:uppercase;
	font-size:14pxpx;
	font-family:Arial;
	padding-top:3px;
	padding-bottom:10px;
}
.txt3-1{
	text-transform:uppercase;
	font-size:12px;
	text-decoration:underline;
	font-weight:bold;
	font-family:Arial;
	padding-top:3px;
}
.txt3-2{
	border-bottom:1px solid #333;
	padding-top:2px;
	text-transform:uppercase;
	font-size:12px;
	font-family:Arial;
}
.txt3-3{
	font-family:Arial;
	font-size:12px;
	padding:2px;
}
.txt4-h1{
	text-transform:uppercase;
	font-size:14px;
	text-decoration:underline;
	font-weight:bold;
	font-family:Arial;
	padding-top:3px;
	padding-bottom:3px;
}
.txt4-h{
	font-size:14px;
	font-weight:bold;
	font-family:Arial;
	padding-top:3px;
}
.txt4-h2{
	font-size:14px;
	font-weight:bold;
	font-family:Arial;
	padding-top:3px;
	padding-bottom:5px;
}
.tag_RP{
	padding-left:5px;
	padding-top:1px;
	padding-bottom:5px;
	text-align:right;
	font-family:Arial;
	font-size:13px;	
}
.tag_RPB{
	padding-left:5px;
	padding-bottom:5px;
	padding-top:1px;
	text-align:right;
	font-family:Arial;
	font-size:13px;
	font-weight:bold;
}
.tag_RP2{
	padding-right:5px;
	padding-top:1px;
	padding-bottom:5px;
	text-align:right;
	font-family:Arial;
	font-size:13px;	
}
.tag_RPBL{
	border-top:2px solid #333;
	padding-right:5px;
	padding-bottom:5px;
	padding-top:1px;
	text-align:right;
	font-family:Arial;
	font-size:13px;
	font-weight:bold;
}
.fot-1{
	text-align:right;
	font-family:Arial;
	font-size:12px;
 }
.fot-1b{
	text-align:right;
	font-family:Arial;
	font-size:12px;
	font-weight:bold;
}
.fot-2{
	text-align:left;
	font-family:Arial;
	font-size:12px;
}
.fot-b{
 text-align:left;
 font-family:Arial;
 font-size:12px;
 text-decoration:underline;
 font-weight:bold;
 }
</style>
</head>
<body>
<table width="800" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td class="utama">
    <!-- B : Header Invoide-->
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="11%"><img src="../images/logo_invoice.png" width="183" height="72" /></td>
        <td width="80%" style="padding-left:50px" valign="bottom">
        <div class="txt1-1">PT. DWI TUNGGAL PUTRA</div>
        <div class="txt1-2">CORPORATION TELECOMMUNICATION SOLUTION</div>
        </td>
      </tr>
    </table>
    <!-- E : Header Invoide-->
    </td>
  </tr>
  <tr>
    <td style="padding-top:10px">
    <!-- B : PERFORMA INVOICE-->
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #333;-moz-border-radius:6px;">
          <tr>
            <td align="center">
           <div class="txt2-1"> Performa invoice </div>
           <div class="txt2-2"> COLOCATION & DATA CENTER </div>
           <div class="txt2-3"> No. : <?php echo $_GET[referensi];?></div>
            </td>
          </tr>
      </table>
    <!-- E : PERFORMA INVOICE-->
    </td>
  </tr>
  <tr>
    <td style="padding-top:10px">
    <!-- B : PERFORMA INVOICE-->
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="33%" style="padding-left:0px;padding-right:10px">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #333;-moz-border-radius:6px;">
          <tr>
            <td align="center">
           <div class="txt3-1">
           tanggal tagihan
           </div>
           <div class="txt3-2"> STATEMENT DATE </div>
           <div class="txt3-3"> <?php tanggal($row_gettgl['tgl'],"tampilkan"); ?></div>
            </td>
          </tr>
        </table>
        </td>
         <td width="33%" style="padding-left:10px;padding-right:10px">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #333;-moz-border-radius:6px;">
          <tr>
            <td align="center">
           <div class="txt3-1">
           Periode akses
           </div>
           <div class="txt3-2"> access period</div>
           <div class="txt3-3">  <?php tanggal($row_gettgl['tgl'],"tampilkan"); ?> - <?php tanggal($row_gettgl['jatuhtempo'],"tampilkan"); ?></div>
            </td>
          </tr>
        </table>
        </td>
        <td width="33%" style="padding-left:10px;padding-right:0px">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #333;-moz-border-radius:6px;">
          <tr>
            <td align="center">
           <div class="txt3-1">
           Tanggal jatuh tempo
           </div>
           <div class="txt3-2">Due date</div>
           <div class="txt3-3"><?php tanggal($row_gettgl['jatuhtempo'],"tampilkan"); ?></div>
            </td>
          </tr>
        </table>
        </td>
      </tr>
    </table>
    <!-- E : PERFORMA INVOICE-->
    </td>
  </tr>
  <tr>
    <td style="padding-top:10px">
    <!-- B : Tujuan-->
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="45%" style="padding:10px">
        <div style="font-family:Arial;font-size:14px;padding-bottom:2px">Kepada /Bill to :</div> 
        <div style="font-family:Arial;font-size:16px;font-weight:bold"><?php echo strtoupper($row_kontak['nama']); ?></div>
        <div style="font-family:Arial;font-size:13px;padding-bottom:2px"><?php echo $row_kontak['alamat']; ?></div>
        </td>
        <td width="55%" valign="top" style="text-align:right;padding-right:100px">
        <div style="font-family:Arial;font-size:13px">Up : Bagian Finance</div>
        </td>
      </tr>
    </table>
    <!-- E : rincian-->
    </td>
  </tr>
    <tr>
    <td style="padding-top:10px" >
    <!-- B : Tujuan-->
   <table width="100%" border="0" cellspacing="1" cellpadding="5" bgcolor="#333333">
      <tr  bgcolor="#FFFFFF">
        <td width="6%" align="center" class="txt4-h">No.</td>
        <td width="52%" align="center">
        <div class="txt4-h1">URAIAN</div>
        <div style="font-family:Arial;font-size:12px;color:#999;letter-spacing:2px;">DESCRIPTION</div>
        </td>
        <td width="11%" align="center" class="txt4-h">Qty</td>
        <td width="15%" align="center">
        <div class="txt4-h">Harga Satuan</div>
        <div class="txt4-h2">(Rp)</div>
        </td>
        <td width="16%" align="center">
        <div class="txt4-h">Jumlah</div>
        <div class="txt4-h2">(Rp)</div>
        </td>
      </tr>
	  <?php $no = 1; $subtotal = 0; do { ?>
      <tr valign="top" bgcolor="#FFFFFF">
        <td align="right"><?php echo $no;$no++;?>.</td>
        <td><?php echo $row_tr1['barang']; ?> (diskon : <?php echo $row_tr1['diskon']; ?> %) </td>
        <td align="center"><?php echo $row_tr1['jumlah']; ?> <?php echo $row_tr1['satuan']; ?></td>
        <td align="right"><?php echo number_format($row_tr1['hargasatuan'],0,',','.').",-"; ?></td>
        <td align="right"><?php echo number_format($row_tr1['total'],0,',','.').",-"; $subtotal +=$row_tr1['total'];?></td>
      </tr>
	  <?php } while ($row_tr1 = mysql_fetch_assoc($tr1)); ?>
      <tr  bgcolor="#FFFFFF">
        <td colspan="2">&nbsp;</td>
        <td colspan="2">
        <div class="tag_RP">Sub Total</div>
        <div class="tag_RP">PPN 10%</div>
        <div class="tag_RP">Meterai</div>
        <div class="tag_RPB">GRAND TOTAL</div>
        </td>
        <td>
        <div class="tag_RP2"><?php echo number_format($subtotal,0,',','.').",-";?></div>
        <div class="tag_RP2"><?php $ppn = (10 * $subtotal) / 100; echo number_format($ppn,0,',','.').",-";?></div>
        <div class="tag_RP2"><?php $materai = 6000; echo number_format($materai,0,',','.').",-";?></div>
        <div class="tag_RPBL"><?php $total = $subtotal + $ppn + $materai; echo number_format($total,0,',','.').",-";?></div>
        </td>
      </tr>
      <tr  bgcolor="#FFFFFF">
        <td colspan="5" style="padding-bottom:30px;">
        <div align="center" style="font-family:arial;font-size:13px;padding-top:10px;padding-bottom:15px;"> Terbilang : =<?php echo ucwords(Terbilang($total));?>=</div>
        <div>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="38%" style="padding-left:15px">
            <div style="text-decoration:underline;font-family:arial;font-size:12px;padding-bottom:8px">Keterangan :</div>
            <div style="font-family:arial;font-size:12px;padding-bottom:7px;">Pembayaran dengan Transfer&nbsp;(Full Amount) ke:</div>
            <div style="font-family:arial;font-size:12px;font-weight:bold;padding-bottom:7px;">BANK CENTRAL ASIA</div>
            <div style="font-family:arial;font-size:12px;padding-bottom:7px;">Cabang Galaxy</div>
            <div style="font-family:arial;font-size:12px;padding-bottom:7px;">Jl. Kertajaya Indah Timur No. 37-38.Surabaya</div>
            <div style="font-family:arial;font-size:12px;padding-bottom:7px;">A/C No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<b> 788.059.3131</b> (Rupiah)</div>
            <div style="font-family:arial;font-size:12px;padding-bottom:7px;">Atas nama&nbsp;: <b>PT Dwi Tunggal Putra</b></div>
            </td>
            <td width="62%" align="right" style="padding-right:100px;">
            <div>Jakarta, 01 september</div>
            <div>&nbsp;</div>
            <div><br />
              <br />
              Ir . Sugeng Alifen</div>
            <div>Direktur Utama</div>
            </td>
          </tr>
        </table>
        </div>
        </td>
        </tr>
    </table>
    <!-- E : rincian-->
    </td>
  </tr>
  <tr>
    <td style="padding-top:2px" >
    <!-- B : footer-->
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="45%">
        <div class="fot-b">Note :</div>
         <div class="fot-2"><i>Demi kenyamanan anda, setiap pembayaran melalui transfer bank harap mencantumkan Nomor Invoice pada bukti setoran bank dan dikirimkan melalui fax :021-5269570 / email : billing@gsd.net.id </i></div>
        </td>
        <td width="55%">
        <div class="fot-1">Jln. Embong Tanjung No.40 Surabaya 60271. Indonesia</div>
        <div class="fot-1b"> NPWP No. 02.232.719.3-611.000</div>
        <div class="fot-1">cyber building 5th Floor.  </div>
        <div class="fot-1">Jl.Kuningan Barat No.8 Jakarta 12710, Indonesia  </div>
        <div class="fot-1">Ph. +62-21-5269257,+62-21-5269258, +62-21-5269570</div>
        <div class="fot-1">URL : http://www.gsd.net.id</div>
        </td>
      </tr>
    </table>
    <!-- E : footer-->
    </td>
  </tr>
</table>

</body>
</html>
<?php
mysql_free_result($tr1);
?>