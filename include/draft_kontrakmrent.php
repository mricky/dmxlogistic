<?php require_once('../connections/con_gl.php'); ?>
<?php
//echo 'dodol';
//echo $_POST[norek];
//echo $_GET[noreferensi];

function hari($day)
{
	switch($day){
		case("Sunday"):
		 $hari = "Minggu";
		break;
		case("Monday"):
		 $hari = "Senin";
		break;
		case("Tuesday"):
		 $hari = "Selasa";
		break;
		case("Wednesday"):
		 $hari = "Rabu";
		break;
		case("Thursday"):
		 $hari = "Kamis";
		break;
		case("Friday"):
		 $hari = "Jumat";
		break;
		case("Saturday"):
		 $hari = "Sabtu";
		break;
		
	}
	echo $hari;
}
function tanggal($xdate,$par) {
$_t = explode("/",$xdate);
$_t1 = $_t[0];
$_t2 = $_t[1];
$_t3 = $_t[2];
switch($_t2) {
	case("12"):
	$bln_eng = "Desember";
	break;     
	case("11"):
	$bln_eng = "November";
	break;
	case("10"):
	$bln_eng = "Oktober";
	break;
	case("09"):
	$bln_eng = "September";
	break;
	case("08"):
	$bln_eng = "Agustus";
	break;
	case("07"):
	$bln_eng = "Juli";
	break;
	case("06"):
	$bln_eng = "Juni";
	break;
	case("05"):
	$bln_eng = "Mei";
	break;
	case("04"):
	$bln_eng = "April";
	break;
	case("03"):
	$bln_eng = "Maret";
	break;
	case("02"):
	$bln_eng = "Februari";
	break;
	default:
	$bln_eng = "Jan";
	break;
	
	echo $bln_eng;
}
$gentgl = $_t3."&nbsp;".$bln_eng."&nbsp;".$_t1;
if($par=='tampilkan') {
 echo $gentgl;
}
}
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
// get company
mysql_select_db($database_con_gl, $con_gl);
$query_company = "SELECT * FROM gl_company";
$company = mysql_query($query_company, $con_gl) or die(mysql_error());

$row_company = mysql_fetch_assoc($company);
$totalRows_company = mysql_num_rows($company);
// get kontrak
mysql_select_db($database_con_gl, $con_gl);
$query_kontrak = "select a.no,ar.area, a.tgl, a.mulai, a.sampai, a.total, a.biaya, a.pajak, a.pph,a.durasi,a.pbayar,a.nilai_tebus, b.nama, b.nama2, b. jabatan2, b.alamat, b.npwp, b.tlp, b.email from gl_kontrak a, gl_area ar, gl_kontak b where a.no='$_GET[referensi]' AND a.kontak = b.id AND b.id=a.kontak and a.area=ar.id";
$kontrak = mysql_query($query_kontrak, $con_gl) or die(mysql_error());
$row_kontrak = mysql_fetch_assoc($kontrak);

// invloice 

mysql_select_db($database_con_gl, $con_gl);
$query_invoice = "select harga, ppnunit from invoice_kontrak where kontrak ='$_GET[referensi]'";
$invoice = mysql_query($query_invoice, $con_gl) or die(mysql_error());
$row_invoice = mysql_fetch_assoc($invoice);
// get kendaraan
mysql_select_db($database_con_gl, $con_gl);
$query_lkend = "select d.jeniskendaraan, b.nopolisi,b.warnautama,b.namapemilik, c.tipekendaraan, b.tahun, b.nomesin, b.norangka from gl_dkontrak a, gl_masterkendaraan b, gl_tipekendaraan c, gl_jeniskendaraan d where a.kontrak='$_GET[referensi]' AND a.kendaraan = b.id AND b.tipekendaraan = c.id and b.jeniskendaraan = d.id order by a.id";
$lkend = mysql_query($query_lkend, $con_gl) or die(mysql_error());
$row_lkend = mysql_fetch_assoc($lkend);
$total_lkend = mysql_num_rows($lkend);
// get sewa
// --- list kendaraan
mysql_select_db($database_con_gl, $con_gl);
$query_slkend = "SELECT a.id, a.kendaraan AS nopol, a.harga, a.diskon, a.ppnunit, a.biayatambahan, a.durasi, a.total, a.transaksi, c.tipekendaraan, d.jeniskendaraan
FROM gl_dkontrak a, gl_masterkendaraan b, gl_tipekendaraan c, gl_jeniskendaraan d
WHERE a.kontrak =  '$_GET[referensi]'
AND a.kendaraan = b.id
AND b.tipekendaraan = c.id and b.jeniskendaraan = d.id
ORDER BY a.id"; 
$slkend = mysql_query($query_slkend, $con_gl) or die(mysql_error());
$row_slkend = mysql_fetch_assoc($slkend);
$total_slkend = mysql_num_rows($slkend);


mysql_select_db($database_con_gl, $con_gl);
$query_total = "select gudang,sum(harga) as harga, sum(salary_driver) as salary_driver, sum(harga) * 10 / 100 as diskon, sum(ppnunit) as ppn, sum(total) as total from v_total_penagihan WHERE kontrak = '$_GET[referensi]'"; 
//printf($query_total);
$stotal = mysql_query($query_total, $con_gl) or die(mysql_error());
$row_stotal= mysql_fetch_assoc($stotal);
$total_stotal = mysql_num_rows($slkend);

// get company
mysql_select_db($database_con_gl, $con_gl);
$query_gudang = "SELECT * FROM gl_gudang where id = $row_stotal[gudang]";
$gudang = mysql_query($query_gudang, $con_gl) or die(mysql_error());

$row_gudang = mysql_fetch_assoc($gudang);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Draft Kontrak <?php echo $_GET['referensi'];?></title>

<STYLE type="text/css">

OL.alpha { list-style-type: lower-alpha }
</STYLE>
</head>

<body>
<p align="center"><strong>PERJANJIAN SEWA MENYEWA KENDARAAN</strong><br>
  <strong>NOMOR :&nbsp;<?php echo $row_kontrak['no'];?></strong><strong> </strong><br></p>
  <p>Perjanjian  dibuat dan ditandatangani pada hari &nbsp;<?php   hari(date("l", strtotime($row_kontrak['tgl']))); ?>, <?php tanggal($row_kontrak['tgl'],"tampilkan"); ?>,  dibuat oleh dan antara:</p>
<ol>
  <li><span dir="LTR"> </span><strong><?php echo $row_gudang['sign_kontrak'];?> </strong>dalam hal ini bertindak dalam jabatannya selaku <?php echo $row_gudang['jabatan'];?> pada PT. GLOBAL INDOTRADA beralamatkan Jl.  RS. Fatmawati No. 29 Jakarta Selatan 12430, dari dan demikian sah mewakili Direksi PT. GLOBAL INDOTRADA berkedudukan di Jakarta Selatan, selanjutnya disebut <strong>MRENT</strong>.</li>
  <li><span dir="LTR"> </span><strong><?php echo $row_kontrak['nama'];?></strong>, <?php echo $row_kontrak['alamat'];?>, <?php echo $row_kontrak['area'];?><strong>, </strong>yang dalam hal ini  bertindak untuk dan atas nama pribadi. Selanjutnya bersama-sama dengan penerima  dan pengganti haknya disebut &ldquo;<strong>PELANGGAN</strong>&rdquo;.</li>
</ol>
<p>MRENT dan PELANGGAN (selanjutnya secara bersama-sama disebut  &ldquo;Para Pihak&rdquo;), sepakat untuk membuat dan menandatangani  Perjanjian Sewa-Menyewa Kendaraan ini (selanjutnya disebut dengan &ldquo;Perjanjian&rdquo;)  dengan syarat dan ketentuan sebagai berikut: </p>
<ol>
  <li>MRENT dengan ini menyewakan kendaraan kepada PELANGGAN dan PELANGGAN  setuju untuk menyewa dari MRENT dengan data kendaraan yang disewa sebagai  berikut: </br>
  <ol type="a">
  <li>Merk  / Tipe&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;:&#160;<?php echo $row_lkend['tipekendaraan'];?></li>
  <li>Nomor Rangka&#160;&#160;&#160;:&#160;<?php echo $row_lkend['norangka'];?></li>
  <li>Nomor Mesin&#160;&#160;&#160;&#160;&#160;:&#160;<?php echo $row_lkend['nomesin'];?></li>
  <li>Warna&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;:&#160;<?php echo $row_lkend['warnautama'];?></li>
  <li>Atas Nama&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;:&#160;<?php echo $row_lkend['namapemilik'];?></li>
  <li>Nomor Polisi&#160;&#160;&#160;&#160;&#160;&#160;:&#160;<?php echo $row_lkend['nopolisi'];?></li>
  <li>Kondisi&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;:&#160;Baru/Bekas</li>
  </ol>
  </li>
    <li><span dir="LTR"> </span>Para Pihak sepakat dan setuju dengan  periode sewa, harga sewa, cara pembayaran, kendaraan pengganti, sebagai  berikut:</br>
  <ol type="a">
  <li>Periode sewa:
    <?php tanggal($row_kontrak['mulai'],"tampilkan"); ?>
     sampai dengan 
     <?php tanggal($row_kontrak['sampai'],"tampilkan"); ?>
  </li>
  <li>Harga sewa per bulan: Rp. <?php echo number_format($row_invoice['harga'],0,',','.');?> tidak termasuk pajak</li>
  <li>Kendaraan Pengganti: Tersedia</li>
  <li>Metode Pembayaran		: Payment in Advance, setiap tanggal 
    <?php   echo date("d", strtotime($row_kontrak['tgl'])); ?>
setiap bulannya selama <?php echo $row_kontrak['durasi'];?> bulan, dengan perincian sebagai berikut:<br>
    <table border="1" cellspacing="0" cellpadding="0" width="624">
      <tr>
        <td width="219" valign="top"><p align="center">Dari Tanggal</p></td>
        <td width="166" valign="top"><p align="center">s/d Tanggal</p></td>
        <td width="231" valign="top"><p align="center">Biaya Sewa Per Bulan</p></td>
      </tr>
      <tr>
        <td width="219" valign="top"><p align="center">
          <?php tanggal($row_kontrak['mulai'],"tampilkan"); ?>
        </p></td>
        <td width="166" valign="top"><p align="center">
          <?php tanggal($row_kontrak['sampai'],"tampilkan"); ?>
        </p></td>
        <td width="231" valign="top"><p align="center">Rp. <?php echo number_format($row_invoice['harga'],0,',','.');?></p></td>
      </tr>
    </table>
    <p>Pada tempat yang telah ditentukan, yaitu: Jl.  RS. Fatmawati No. 29 Jakarta Selatan 12430, atau:<br>
      Ke Rekening&#160;&#160;&#160;:&#160;PT.  GLOBAL INDOTRADA<br>
      Pada Bank&#160;&#160;&#160;&#160;&#160;&#160;: BCA  KCP FATMAWATI<br>
      No. Rekening&#160;&#160;:&#160;07 13018993</p></li>
  <li>	Denda Keterlambatan Pembayaran&#160;&#160;&#160;:&#160;Rp. 100.000 / hari</li>
  <li><span dir="LTR"> </span>Denda Keterlambatan  Pengembalian&#160;&#160;:&#160;Rp. 150.000 / hari</li>
  <li><span dir="LTR"> </span>Denda Pengakhiran Sewa  Dipercepat&#160;&#160;:&#160;25% dari total harga sewa yang belum  terpakai selama periode sewa. </li>
</ol>
  <li><span dir="LTR"> </span>Mengenai ketentuan dalam pelaksanaan Perjanjian ini MRENT dan PELANGGAN sepakat untuk tunduk dan patuh pada seluruh Syarat dan Ketentuan Perjanjian Sewa-Menyewa Kendaraan sebagaimana yang dilampirkan pada Perjanjian ini dan merupakan satu kesatuan dan bagian yang tidak terpisahkan dari Perjanjian.</br></li>
</ol>
<p>Demikian Perjanjian ini berlaku efektif pada tanggal sebagaimana disebutkan di atas, aslinya dibuat dalam rangkap 2 (dua) bermaterai cukup, dan memiliki kekuatan hukum yang sama, satu rangkap untuk MRENT dan satu rangkap diberikan kepada PELANGGAN.</p>
<table width="408" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="203" valign="top">MRENT</td>
    <td width="199" valign="top"><p align="center">PELANGGAN</p></td>
  </tr>
  <tr>
    <td valign="top"><p>PT. GLOBAL INDOTRADA</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><strong><?php echo $row_gudang['sign_kontrak'];?></strong></td>
    <td valign="center"><strong><?php echo $row_kontrak['nama'];?></strong></td>
  </tr>
  <tr>
    <td width="203" valign="top"><p><?php echo $row_gudang['jabatan'];?></p></td>
    <td width="199" valign="top"><p align="center">&nbsp;</p></td>
  </tr>
</table>
</body>
</html>
