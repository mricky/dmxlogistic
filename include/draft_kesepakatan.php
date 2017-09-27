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
$query_kontrak = "select a.no,ar.area, a.tgl, a.mulai, a.sampai, a.total, a.biaya, a.pajak, a.pph,a.durasi,a.pbayar, a.nilai_tebus, b.nama, b.nama2, b. jabatan2, b.alamat, b.npwp, b.tlp, b.email from gl_kontrak a, gl_area ar, gl_kontak b where a.no='$_GET[referensi]' AND a.kontak = b.id AND b.id=a.kontak and a.area=ar.id";
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
<p align="center"><strong>KESEPAKATAN BERSAMA</strong><br>
  <strong> </strong><br></p>
  <p>Kesepakatan   dibuat dan ditandatangani pada hari &nbsp;<?php   hari(date("l", strtotime($row_kontrak['tgl']))); ?>, <?php tanggal($row_kontrak['tgl'],"tampilkan"); ?>,  dibuat oleh dan antara:</p>
<ol>
  <li><span dir="LTR"> </span><strong><?php echo $row_gudang['sign_kontrak'];?> </strong>dalam hal ini bertindak dalam jabatannya selaku <?php echo $row_gudang['jabatan'];?> pada PT. GLOBAL INDOTRADA beralamatkan Jl.  RS. Fatmawati No. 29 Jakarta Selatan 12430, dari dan demikian sah mewakili Direksi PT. GLOBAL INDOTRADA berkedudukan di Jakarta Selatan, selanjutnya disebut <strong>MRENT</strong>.</li>
  <li><span dir="LTR"> </span><strong><?php echo $row_kontrak['nama'];?></strong>, <?php echo $row_kontrak['alamat'];?>, <?php echo $row_kontrak['area'];?><strong>, </strong>yang dalam hal ini  bertindak untuk dan atas nama pribadi. Selanjutnya bersama-sama dengan penerima  dan pengganti haknya disebut &ldquo;<strong>PELANGGAN</strong>&rdquo;.</li>
</ol>
<p>MRENT dan PELANGGAN  (secara bersama-sama selanjutnya disebut sebagai <strong>&lsquo;PARA PIHAK&rsquo;</strong>) terlebih dahulu menerangkan bahwa telah terjadi  hubungan hukum antara MRENT dengan PELANGGAN sebagaimana diatur dalam Perjanjian  Sewa Menyewa Kendaraan <?php echo $row_kontrak['no'];?>
  <?php tanggal($row_kontrak['mulai'],"tampilkan"); ?>
, (selanjutnya  disebut<strong> &ldquo;Perjanjian&rdquo;</strong>). </p>
<p>	<br />
  Selanjutnya PARA PIHAK  sepakat dan setuju untuk membuat suatu Kesepakatan Bersama, dan karenanya  saling mengikatkan diri dengan mengikuti syarat dan ketentuan sebagai berikut : </p>
<ol>
  <li>Bahwa <strong>PARA PIHAK</strong> tersebut di atas telah bersepakat dan menyetujui bahwa <i>Car Ownership Program</i> (COP) merupakan penawaran yang diberikan MRENT kepada PELANGGAN sebagai bagian dari Perjanjian, sehingga PELANGGAN dapat melakukan pembelian unit Kendaraan setelah Periode Sewa berakhir. </li>
    <li><span dir="LTR"></span>Penawaran pembelian unit Kendaraan hanya diberlakukan dengan syarat apabila pembayaran Harga Sewa per bulan dilakukan tepat waktu setiap bulannya selama Periode Sewa, dan permohonan atas opsi yang diajukan PIHAK KEDUA telah disetujui oleh PIHAK PERTAMA, serta melihat histori service kendaraan yang layak.
<li><span dir="LTR"> </span>Bahwa PELANGGAN wajib menyampaikan permohonan pembelian Kendaraan secara tertulis selambat-lambatnya 7 (tujuh hari) sebelum berakhirnya Periode Sewa Kendaraan. Permohonan yang diajukan setelah jangka waktu yang ditentukan tidak akan diproses oleh MRENT.</li>
<li>Pemberian diskon terhadap pembelian unit Kendaraan dilihat dari nilai buku sesuai depresiasi Kendaraan  dengan perhitungan sebagai berikut:<br />Kendaraan 	: <br /><ul><li>Biaya Sewa Rp.<?php echo number_format($row_invoice['harga'],0,',','.');?>/ bulan yang berlaku untuk Jangka Waktu Sewa selama 48 bulan, biaya pelunasan untuk pembelian akan dikenakan sebesar Rp. <?php echo number_format($row_kontrak['nilai_tebus'],0,',','.');?></li>
  <li>Harga belum termasuk PPN 10%</li></ul></li>
</ol>
<p>Demikian Kesepakatan Bersama ini dibuat dengan berdasarkan itikad baik para pihak.</p>
<table width="601" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" valign="top">Jakarta, <?php tanggal($row_kontrak['tgl'],"tampilkan"); ?></td>
  </tr>
  <tr>
    <td width="248" valign="top"><p>MRENT</p>
    <p>PT. GLOBAL INDOTRADA</p></td>
    <td width="154" valign="top"><p>&nbsp;</p>
    <p>PELANGGAN</p></td>
    <td width="199" valign="top"><p align="center">&nbsp;</p>
    <p align="center">PENJAMIN</p></td>
  </tr>
  <tr>
    <td valign="top"><p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><strong><?php echo $row_gudang['sign_kontrak'];?></strong></td>
    <td valign="center"><strong><?php echo $row_kontrak['nama'];?></strong></td>
    <td valign="center">&nbsp;</td>
  </tr>
  <tr>
    <td width="248" valign="top"><p><?php echo $row_gudang['jabatan'];?></p></td>
    <td width="154" valign="top">&nbsp;</td>
    <td width="199" valign="top"><p align="center">&nbsp;</p></td>
  </tr>
</table>
</body>
</html>
