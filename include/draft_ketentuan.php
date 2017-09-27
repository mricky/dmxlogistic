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
$query_kontrak = "select a.no, a.tgl, a.mulai, a.sampai, a.total, a.biaya, a.pajak, a.pph,a.durasi,a.pbayar, b.nama, b.nama2, b. jabatan2, b.alamat, b.npwp, b.tlp, b.email from gl_kontrak a, gl_kontak b where a.no='$_GET[referensi]' AND a.kontak = b.id AND b.id=a.kontak";
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
input {
	font-size:9px;
	font-weight:bold;
	text-align:center;
	border:none;
}
</style>
</head>

<body>
<blockquote>&nbsp;</blockquote>
<table width="700" border="0" align="center" cellpadding="1" cellspacing="1" >
  <tr>
    <td colspan="2" align="center" valign="top"><strong><img src="../images/l_logo.png" alt="mrent" width="159" height="87" hspace="12" align="left" />SYARAT DAN KETENTUAN  PERJANJIAN SEWA-MENYEWA KENDARAAN</strong></td>
  </tr>
  <tr>
    <td align="justify" valign="top"><p><strong>Pasal 1. BERLAKUNYA SYARAT DAN  KETENTUAN </strong><strong> </strong></p>
      <ol>
        <li><span dir="ltr"> </span>Syarat dan Ketentuan  Perjanjian Sewa-Menyewa Kendaraan (selanjutnya disebut  &ldquo;SKPSMK&rdquo;) merupakan syarat dan ketentuan yang berlaku  secara umum bagi penyewaan Kendaraan yang dilakukan oleh  MRent  kepada PELANGGAN yang dituangkan dalam Perjanjian.</li>
        <li><span dir="ltr"> </span>SKPSMK ini dilekatkan pada  Perjanjian yang dibuat antara MRENT dengan PELANGGAN dan merupakan bagian  penting dan merupakan kesatuan yang tidak dapat dipisahkan dari Perjanjian.</li>
        <li><span dir="ltr"> </span>Dengan disetujui dan  ditandatanganinya Perjanjian oleh PELANGGAN maka seluruh ketentuan dalam SKPSMK  ini berlaku dan mengikat bagi MRENT dan PELANGGAN untuk seluruh Perjanjian Sewa  Menyewa Kendaraan. </li>
      </ol>
      <p><strong>Pasal </strong><strong>2</strong><strong>.  OBJEK SEWA</strong><strong> </strong></p>
      <ol>
        <li><span dir="ltr"> </span>Kendaraan yang disewa  adalah sebagaimana tercantum dalam Perjanjian, dengan nomor polisi Kendaraan  sebagaimana terperinci dalam Lampiran Perjanjian dan/atau  Berita Acara Serah Terima Kendaraan Sewa yang  ditandatangani antara Pihak PELANGGAN dan MRENT.</li>
        <li><span dir="ltr"> </span>Kendaraan dapat  diganti sewaktu-waktu oleh MRENT dengan unit Kendaraan lain yang setipe /  sekelas dengan persetujuan terlebih dahulu dari PELANGGAN.</li>
      </ol>
      <p><strong>Pasal </strong><strong>3</strong><strong>.  KEBERLAKUAN PERJANJIAN</strong></p>
      <ol>
        <li><span dir="ltr"> </span>Perjanjian mulai  berlaku terhitung sejak tanggal ditandatanganinya sampai dengan berakhirnya  seluruh Periode Sewa Kendaraan. </li>
        <li><span dir="ltr"> </span> Apabila Perjanjian  ini telah berakhir sesuai dengan Periode Sewa tersebut namun PELANGGAN masih  terus mempergunakan Kendaraan, maka Para Pihak sepakat bahwa Perjanjian ini  dianggap telah diperpanjang secara otomatis selama 1 (satu) bulan dengan Syarat  dan Ketentuan yang sama. Perpanjangan otomatis tersebut akan berulang pada  setiap tanggal berakhirnya Perjanjian. Kecuali Para Pihak telah menandatangani  suatu Perjanjian yang memuat Syarat dan Ketentuan berbeda dan /atau MRENT telah  memberikan surat pemberitahuan tertulis pada PELANGGAN untuk tidak  memperpanjang Perjanjian ini. </li>
        <li><span dir="ltr"> </span>Berakhirnya Periode  Sewa Kendaraan, apapun sebabnya, tidak akan mengurangi atau menghapus kewajiban  PELANGGAN yang telah dan masih terhutang berdasarkan Perjanjian.</li>
        <li><span dir="ltr"> </span>Apabila PELANGGAN mengakhiri Perjanjian sebelum berakhirnya  Periode Sewa Kendaraan maka PELANGGAN akan dikenakan biaya sebesar 25% (dua puluh  lima persen) dari total Harga Sewa yang belum terpakai selama Periode Sewa  Kendaraan.</li>
        <li><span dir="ltr"> </span>Apabila pengakhiran  Perjanjian yang dilakukan oleh PELANGGAN disebabkan oleh adanya kerusakan  Kendaraan Sewa sebagai akibat dari kesalahan/ kelalaian PELANGGAN dan  menimbulkan kerugian bagi MRENT, maka PELANGGAN wajib bertanggung jawab untuk  menanggung dan menyelesaikan terlebih dahulu biaya-biaya yang timbul atas  kerusakan Kendaraan Sewa tersebut.</li>
      </ol>
      <p><strong>Pasal </strong><strong>4</strong><strong>.  PERIODE DAN HARGA</strong><strong> SEWA</strong></p>
      <ol>
        <li><span dir="ltr"> </span>Periode Sewa Kendaraan  adalah sebagaimana tercantum dalam Perjanjian.</li>
        <li><span dir="ltr"> </span>Harga Sewa Kendaraan  yang dicantumkan dalam Perjanjian belum termasuk PPN 10% sudah meliputi biaya  pemeliharaan dan reparasi Kendaraan, (kecuali untuk reparasi atas kerusakan Kendaraan  karena kelalaian PELANGGAN), biaya perpanjangan STNK, Kendaraan Pengganti dan biaya  premi asuransi atas Kendaraan, kecuali biaya yang ditimbulkan akibat resiko  sendiri sebagaimana yang disebutkan dalam pasal 9 SKPSMK.</li>
      </ol>
      <p><strong>Pasal </strong><strong>5</strong><strong>.  TATACARA PEMBAYARAN</strong></p>
      <ol>
        <li><span dir="ltr"> </span>Pembayaran Harga Sewa Kendaraan adalah  sebagaimana dicantumkan dalam Perjanjian dan  wajib dilakukan PELANGGAN selambat-lambatnya pada Tanggal Jatuh Tempo  sebagaimana tercantum dalam Perjanjian. Apabila Tanggal Jatuh Tempo pembayaran  jatuh pada hari Minggu, hari libur nasional atau hari libur Bank Indonesia maka  pembayaran tersebut harus dilakukan oleh PELANGGAN pada hari kerja sebelumnya.</li>
        <li><span dir="ltr"> </span>PELANGGAN wajib menginformasikan rincian nomor invoice  untuk setiap pembayaran kepada MRENT maksimal H+7 hari kalender dari tanggal  pembayaran secara tertulis atau dapat dilakukan dengan menuliskan rincian nomor  invoice pada berita transfer bank.</li>
        <li><span dir="ltr"> </span>Apabila pembayaran  akan dilakukan dengan cara transfer antar bank maka rekening yang dituju adalah  rekening atas nama PT</a>.  Global Indotrada yang tercantum dalam dokumen invoice. Setiap pembayaran  yang dilakukan dengan transfer antar bank baru dinyatakan atau dianggap lunas  apabila telah dibukukan oleh bank ke dalam rekening dimaksud. </li>
      </ol>
      <p><strong>Pasal </strong><strong>6</strong><strong>. </strong><strong>KETERLAMBATAN PEMBAYARAN DAN DENDA</strong></p>
      <ol>
        <li><span dir="ltr"> </span>Jika PELANGGAN gagal  melunasi kewajiban pembayarannya pada Tanggal Jatuh Tempo, maka MRENT akan  mengenakan Denda Keterlambatan Pembayaran yang besarnya  dicantumkan dalam Perjanjian dan akan dihitung dari total jumlah tagihan yang  tertunggak terhitung sejak Tanggal Jatuh Tempo.</li>
        <li><span dir="ltr"> </span>Apabila PELANGGAN  melakukan Pembatalan Perjanjian terhadap sebagian maupun keseluruhan Kendaraan  sebelum berakhirnya periode yang disepakati dalam Perjanjian dengan alasan  apapun, PELANGGAN membatalkan Perjanjian dan/atau seluruh/sebagian sewa  kendaraan pada saat MRENT telah memesan Kendaraan (sesuai dengan surat  pemesanan Kendaraan/PO yang telah disepakati dan disetujui oleh PELANGGAN yang  diperkuat dengan penanda-tanganan Surat Pesanan Sewa Kendaraan (proposal), maka  PELANGGAN akan dikenakan Denda Pembatalan Perjanjian yang besarnya dicantumkan  dalam Perjanjian dan akan dihitung dari jumlah Harga Sewa Kendaraan yang belum  terpakai selama periode sewa. Denda Pemutusan tersebut tidak menghapus  kewajiban PELANGGAN sehubungan dengan kecelakaan atau kehilangan  Kendaraan atau perlengkapannya sebagaimana diatur dalam pasal 9 dan  pasal 10  SKPSMK.</li>
        <li><span dir="ltr"> </span>Jika PELANGGAN gagal  atau terlambat menyerahkan dan mengembalikan Kendaraan pada tanggal berakhirnya  Periode Sewa maka PELANGGAN dikenakan Denda Keterlambatan Pengembalian yang  besarnya sebagaimana dicantumkan dalam Perjanjian dan akan dihitung berdasarkan  Harga Sewa Kendaraan per bulan. Keterlambatan dan/atau kegagalan pengembalian Kendaraan  sebagaimana dimaksud diatas adalah untuk jangka waktu selambat-lambatnya 7  (tujuh) hari. </li>
      </ol>
    Apabila PELANGGAN tetap gagal melakukan pembayaran Harga  Sewa dan/atau gagal mengembalikan Kendaraan dalam jangka waktu yang telah  ditentukan, maka MRENT berhak menarik Kendaraan dari penguasaan PELANGGAN atau  pihak manapun yang </td>
    <td align="justify" valign="top"><ol>
      <li><span dir="ltr"> </span>menguasai Kendaraan  tanpa pemberitahuan terlebih dahulu kepada PELANGGAN  dan jika dianggap perlu dengan pertolongan  atau bantuan institusi atau lembaga yang berwenang dan segala yang timbul dari  tindakan MRENT tersebut akan dibebankan dan menjadi tanggung jawab PELANGGAN. Tindakan  penarikan yang dimaksud tidak akan dianggap sebagai tindakan pelanggaran MRENT  dalam hal memasuki tanah milik orang lain atau sebagai pelanggaran terhadap  hak-hak </li>
      <li><span dir="ltr"> </span>Ketentuan tentang  denda-denda dalam pasal ini tidak dapat dihapus  keberlakuannya dengan cara apapun, termasuk namun tidak terbatas pada  dibuatnya kesepakatan untuk menghapus denda-denda  dimaksud dalam Perjanjian.</li>
    </ol>
      <p><strong> Pasal </strong><strong>7</strong><strong>. PERUBAHAN NILAI SEWA</strong></p>
      <ol>
        <li><span dir="ltr"> </span>Di dalam hal  terjadinya perubahan kondisi moneter yang sangat berpengaruh terhadap  perhitungan dan kenaikan terhadap Harga Sewa Kendaraan, maka MRENT dapat  meminta PELANGGAN untuk bertemu guna membicarakan memperhitungkan ulang  mengenai harga yang berlaku dan berusaha mencapai suatu kesepakatan yang adil  tentang penyelesaian harga terhadap periode yang tersisa setelah tanggal  terjadinya perubahan keadaan moneter.</li>
        <li><span dir="ltr"> </span>Ketentuan dalam ayat 1  pasal ini tidak dapat dihapus keberlakuannya dengan cara apapun, termasuk namun  tidak terbatas pada dibuatnya kesepakatan untuk menghapus ketentuan dimaksud  dalam Perjanjian.</li>
      </ol>
      <p><strong>Pasal </strong><strong>8</strong><strong>.  KEWAJIBAN MRENT</strong><br />
        Selain daripada kewajiban-kewajiban yang tertuang pada  bagian lain dari Perjanjian dan/atau SKPSMK ini, MRENT berkewajiban memenuhi  ketentuan sebagai berikut :</p>
      <ol>
        <li><span dir="ltr"> </span>Semua biaya dan  pelaksanaan perbaikan serta perawatan Kendaraan, baik yang dilakukan secara  periodik, menjadi tanggungan MRENT serta akan dilakukan di bengkel yang  ditentukan  MRENT. MRENT wajib   melakukan servis mekanis secara teratur, termasuk untuk melakukan perawatan  dan perbaikan Kendaraan sehubungan dengan kegagalan mekanis sebagai akibat dari  penggunaan yang wajar (normal wear and tear)  dan PELANGGAN berkewajiban mendukung proses perbaikan yang akan dilakukan oleh MRENT  seperti penyiapan unit kendaraan sesuai jadwal perbaikan yang ditetapkan, dll. Bila  PELANGGAN lalai dalam mendukung kegiatan perbaikan yang akan dilakukan MRENT  maka segala biaya yang ditimbulkan menjadi tanggungjawab PELANGGAN dan pasal 9  ayat 2 menjadi tidak berlaku.</li>
        <li><span dir="ltr"> </span>Apabila Kendaraan  Pengganti diperjanjikan dalam Perjanjian maka Jika Kendaraan mengalami  kerusakan yang membutuhkan jangka waktu perbaikan 6 (enam) jam atau lebih, maka  MRENT akan menyediakan Kendaraan Pengganti kepada PELANGGAN untuk sementara  tanpa biaya tambahan kepada PELANGGAN, sepanjang kerusakan itu terjadi  diwilayah dimana kantor MRENT berada. Dalam hal ini, Kendaraan Pengganti harus  merupakan Kendaraan setipe/sekelas dengan Kendaraan yang disewa serta dalam  keadaan baik dan layak jalan. PELANGGAN wajib mengembalikan Kendaraan Pengganti dalam  jangka waktu 2 x 24 jam, jika Kendaraan yang disewa telah selesai direparasi  dan dapat beroperasi kembali.</li>
        <li><span dir="ltr"> </span>MRENT bertanggung  jawab atas masa berlaku STNK dan akan memperpanjang  STNK paling lambat 5 (lima) hari sebelum tanggal berakhirnya STNK. Semua biaya  dan pengeluaran untuk perpanjangan tersebut akan ditanggung oleh MRENT, dengan  memperhatikan ketentuan dalam Pasal 9 ayat 4  dan ayat 5  SKPSMK.</li>
      </ol>
      <p><strong>Pasal </strong><strong>9</strong><strong>.  KEWAJIBAN DAN LARANGAN BAGI PELANGGAN</strong><br />
        Selain daripada kewajiban-kewajiban  yang tertuang pada bagian lain dari Perjanjian dan/atau SKPSMK ini, PELANGGAN  berkewajiban </a>mematuhi ketentuan sebagai berikut: </p>
      <ol>
        <li><span dir="ltr"> </span>PELANGGAN wajib  memenuhi kewajiban pembayarannya atas Harga Sewa serta denda-denda atau  kewajiban pembayaran lainnya sebagaimana ditentukan dalam Perjanjian.</li>
        <li><span dir="ltr"> </span>PELANGGAN wajib  menghubungi MRENT untuk pengaturan perawatan atau pemeriksaan secara teratur  setiap 10.000 KM dan wajib menyerahkan Kendaraan kepada MRENT atau bengkel yang  ditunjuk MRENT untuk dilakukan perawatan berkala dan/atau reparasi Kendaraan  dalam hal Kendaraan memasuki jadwal rutin perawatan dan/atau mengalami  kerusakan atau kecelakaan.</li>
        <li><span dir="ltr"> </span>Kendaraan hanya boleh  digunakan untuk dan dengan cara sebagai berikut:</li>
        <li><span dir="ltr"> </span>Untuk hal-hal yang  tidak bertentangan dengan hukum dan/atau tidak  melanggar peraturan lalu lintas, dan </li>
        <li><span dir="ltr"> </span>Menggunakan Pengemudi dari  MRENT atau pengemudi yang mampu mengemudikan Kendaraan dengan baik dan memiliki  SIM yang masih berlaku.</li>
      </ol>
      <p>Segala resiko  dan biaya yang timbul sebagai pelanggaran terhadap ketentuan ini akan  sepenuhnya menjadi tanggung jawab PELANGGAN. </p>
      <ol>
        <li><span dir="ltr"> </span>PELANGGAN harus  menyerahkan STNK Kendaraan yang diperlukan untuk diperpanjang maksimal 2 (dua)  minggu sebelum Tanggal STNK berakhir kepada MRENT setelah pemberitahuan dari MRENT. </li>
        <li><span dir="ltr"> </span>Apabila STNK hilang  atau rusak berat atau karena kelalaian PELANGGAN mengalami keterlambatan  perpanjangan maka PELANGGAN akan sepenuhnya bertanggung jawab atas biaya  penggantian atau pembaruan STNK tersebut, termasuk denda yang timbul sebagai  akibat dari kehilangan atau kerusakan atau keterlambatan tersebut (sesuai  ketentuan) dan harus membayar lunas terlebih dahulu sebelum diberikan kembali  STNK pengganti atas kehilangan tersebut.</li>
        <li><span dir="ltr"> </span>Apabila kunci Kendaraan,  aksesoris dan/atau perlengkapan Kendaraan lainnya, termasuk namun tidak  terbatas pada tape dan/atau tools set hilang atau mengalami kerusakan berat,  yang semata-mata timbul sebagai akibat dari kelalaian PELANGGAN, maka PELANGGAN  akan sepenuhnya bertanggung jawab atas biaya penggantian atau perbaikan atas  kehilangan atau kerusakan tersebut.</li>
        <li><span dir="ltr"> </span>PELANGGAN dengan  alasan apapun tidak diperbolehkan mengalihkan atau menyewakan lebih lanjut atau  memberikan hak dalam hal ini atau menjadikan Kendaraan sebagai agunan pada  pihak lain.</li>
        <li><span dir="ltr"> </span>PELANGGAN tidak boleh  melakukan suatu perubahan apapun terhadap bentuk semula dari  Kendaraan. Menambah atau meniadakan perlengkapan orisinal dari Kendaraan.</li>
        <li><span dir="ltr"> </span>PELANGGAN wajib  memberitahu MRENT bila terjadi hal-hal sebagai berikut:</li>
        <li><span dir="ltr"> </span>Bila PELANGGAN  bermaksud untuk mengganti nama dan/atau alamat;</li>
        <li><span dir="ltr"> </span>Bila terjadi  kehilangan, pencurian, penipuan atau klaim dari pihak ketiga berkenaan dengan Kendaraan;</li>
        <li><span dir="ltr"> </span>Bila ada sesuatu  perubahan didalam tujuan utama menggunakan Kendaraan. </li>
        <li><span dir="ltr"> </span>PELANGGAN dilarang  keras menggunakan Kendaraan untuk balapan, rally atau kampanye politik, tindak  kejahatan atau untuk suatu tujuan domestik dan sosial, dan dilarang  pula membawa penumpang dengan tujuan komersial.</li>
    </ol></td>
  </tr>
  <tr>
    <td width="329" align="left" valign="top"><p>&nbsp;</p></td>
    <td width="365" align="left" valign="top"><p>&nbsp;</p>
<p align="right"> <em>Paraf ____________</em></p></td>
  </tr>
  <tr>
    <td colspan="2" align="right" valign="top"><p>&nbsp;</p></td>
  </tr>
</table>
<p>Hal 1</p>
<table width="700" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td colspan="2" align="center" valign="top"><strong><img src="../images/l_logo.png" alt="mrent" width="159" height="87" hspace="12" align="left" />SYARAT DAN KETENTUAN  PERJANJIAN SEWA-MENYEWA KENDARAAN</strong></td>
  </tr>
  <tr>
    <td align="justify" valign="top"><ol>
      <li><span dir="ltr"> </span>PELANGGAN dilarang  keras mengemudikan Kendaraan dibawah pengaruh obat bius, alkohol, narkoba  dan/atau mengemudikannya di luar jalan yang wajar/layak untuk dilalui, dan  akibat dari pelanggaran tersebut maka PELANGGAN akan sepenuhnya bertanggung  jawab atas biaya dan akibat hukum yang ditimbulkan.</li>
      <li><span dir="ltr"> </span>PELANGGAN wajib  menyimpan Kendaraan di tempat yang layak dan aman.</li>
      <li><span dir="ltr"> </span>Segala bentuk  kelalaian/pelanggaran PELANGGAN yang menyebabkan PELANGGAN tidak dapat  mempergunakan baik kendaraannya untuk kegiatan operasional maupun kendaraan  pengganti yang diperjanjikan dalam Perjanjian (jika ada), maka MRENT tetap  dapat memberikan tagihan kepada PELANGGAN dan PELANGGAN tetap mempunyai kewajiban  untuk memenuhi pembayaran sewa.</li>
      <li><span dir="ltr"> </span>Ketentuan dalam ayat 3,5,6,7,8,10,11,  dan ayat 13 pasal ini tidak dapat dihapus keberlakuannya dengan cara apapun,  termasuk namun tidak terbatas pada dibuatnya kesepakatan untuk menghapus  ketentuan dimaksud dalam Perjanjian.</li>
    </ol>
      <p><strong>PASAL  10. PENGECEKAN FISIK KENDARAAN</strong><br />
        MRENT berhak  untuk melakukan pengecekan fisik kendaraan dengan pemberitahuan sebelumnya  kepada PELANGGAN dan PELANGGAN wajib menghadirkan dan/atau menginformasikan  keberadaan fisik Kendaraan sehingga MRENT dapat melakukan pengecekan atas fisik  Kendaraan.</p>
      <p><strong>Pasal 1</strong><strong>1</strong><strong>.  ASURANSI KENDARAAN</strong></p>
      <ol>
        <li><span dir="ltr"> </span>Kendaraan  diasuransikan kepada perusahaan asuransi yang ditunjuk oleh MRENT sesuai dengan  ketentuan yang tercantum dalam polis asuransi. </li>
        <li><span dir="ltr"> </span>Harga Sewa tidak termasuk biaya  klaim asuransi. </li>
        <li><span dir="ltr"> </span>Setiap klaim asuransi,  PELANGGAN wajib membayar resiko sendiri (own risk) sebesar  Rp. 1.000.000,- (satu juta rupiah). </li>
        <li><span dir="ltr"> </span>Ketentuan pengalihan  resiko kepada pihak asuransi akan tidak berlaku untuk :</li>
        <li><span dir="ltr"> </span>resiko-resiko  yang merupakan akibat dari kecelakaan/kehilangan Kendaraan yang diakibatkan  PELANGGAN tidak memenuhi kewajiban dan/atau ketentuan penggunaan Kendaraan yang  diatur dalam SKPSMK ini; atau</li>
        <li><span dir="ltr"> </span>kerugian  akibat kecelakaan/kehilangan Kendaraan yang tidak dapat ditanggung oleh pihak  asuransi (unclaimable), sehingga PELANGGAN wajib menanggung sepenuhnya total  biaya kerugian yang ditimbulkan.</li>
      </ol>
      <p>di  mana dalam hal tersebut di atas tanggung jawab atas kerugian akan sepenuhnya  ditanggung oleh PELANGGAN, termasuk di dalamnya segala biaya dan ongkos maupun  claim dari pihak ketiga yang timbul akibat terjadinya kecelakaan/kehilangan  Kendaraan tersebut.<br />
        <strong>Pasal 12. CEDERA  JANJI / WANPRESTASI</strong><br />
        Apabila PELANGGAN lalai, tidak melakukan dan/atau tidak  memenuhi kewajibannya sesuai dengan yang dituangkan dalam Perjanjian dan  kelalaian tersebut telah diperingatkan oleh MRENT secara tertulis sebanyak 2  (dua) kali berturut-turut dengan tenggang waktu 7 (tujuh) hari untuk  masing-masing surat namun kelalaian tersebut tetap tidak diperbaiki oleh PELANGGAN,  maka MRENT berhak untuk:</p>
      <ol>
        <li><span dir="ltr"> </span>Mengakhiri sewa-menyewa  secara sepihak dengan menyampaikan pemberitahuan tertulis sebelumnya kepada PELANGGAN.</li>
        <li><span dir="ltr"> </span>Menarik kembali Kendaraan  dari penguasaan PELANGGAN atau karyawan PELANGGAN atau pihak manapun yang  menguasai kendaraan  dan jika dianggap  perlu dengan pertolongan dan bantuan institusi atau lembaga yang berwenang dan  segala yang timbul dari tindakan MRENT tersebut akan dibebankan dan menjadi  tanggung jawab PELANGGAN. Tindakan Penarikan yang dimaksud tidak akan dianggap  sebagai tindakan pelanggaran MRENT dalam hal memasuki tanah milik orang lain  atau sebagai pelanggaran terhadap hak-hak PELANGGAN dan meminta pelunasan  pembayaran Harga Sewa yang telah terhutang dan/atau denda-denda atau biaya lain  yang terhutang berdasarkan Perjanjian..</li>
      </ol>
      <p><strong>Pasal 1</strong><strong>3</strong><strong>.  PERNYATAAN DAN JAMINAN</strong></p>
      <ol>
        <li><span dir="ltr"> </span>PELANGGAN dengan ini menyatakan dan  menjamin MRENT bahwa:</li>
        <li><span dir="ltr"> </span>PELANGGAN adalah pribadi  kodrati yang cakap dalam melakukan perbuatan hukum atau badan hukum yang  didirikan, disetujui, didaftarkan secara sah sebagai badan hukum di Indonesia  yang tunduk terhadap hukum Indonesia, yang dalam hal ini diwakili oleh wakilnya  yang sah dan berwenang, sehingga sah dan berwenang untuk menandatangani  Perjanjian dan SKPSMK ini.</li>
        <li><span dir="ltr"> </span>Dokumen-dokumen serta  kuasa (apabila ada) yang diberikan PELANGGAN kepada MRENT untuk meyakinkan MRENT  agar bersedia melakukan Perjanjian ini dengan PELANGGAN adalah sah dan apa yang  dinyatakan dalam dokumen-dokumen tersebut adalah benar adanya.</li>
        <li><span dir="ltr"> </span>PELANGGAN akan mentaati  semua syarat dan kewajiban yang tertuang dalam Perjanjian dan SKPSMK dan melaksanakan  keseluruhan dari isi Perjanjian dan SKPSMK dengan itikad baik dan penuh  tanggung jawab.</li>
        <li><span dir="ltr"> </span>MRENT dapat menyita  dan menjual barang yang menjadi aset kepemilikan PELANGGAN yang nilai besaran  harganya sebanding dengan jumlah/ total tagihan yang tertunggak, sebagai ganti  kerugian MRENT atas wanprestasi yang dilakukan PELANGGAN berdasarkan  Perjanjian.</li>
        <li><span dir="ltr"> </span>Penggunaan Kendaraan  oleh PELANGGAN merupakan pernyataan persetujuan PELANGGAN terhadap isi  Perjanjian dan SKPSMK dan selanjutnya untuk melaksanakan keseluruhan dari isi  Perjanjian dan SKPSMK dengan itikad baik dan penuh tanggung jawab.   </li>
        <li><span dir="ltr"> </span>MRENT dengan ini  menyatakan dan menjamin PELANGGAN bahwa:</li>
        <li><span dir="ltr"> </span>MRENT adalah pribadi  kodrati yang cakap dalam melakukan perbuatan hukum atau badan hukum yang  didirikan, disetujui, didaftarkan secara sah sebagai badan hukum di Indonesia  yang tunduk terhadap hukum Indonesia, yang dalam hal ini diwakili oleh wakilnya  yang sah dan berwenang, sehingga sah dan berwenang untuk menandatangani  Perjanjian dan SKPSMK ini.</li>
        <li><span dir="ltr"> </span>Kendaraan adalah milik  dan/atau dipegang haknya oleh MRENT dan MRENT akan senantiasa melindungi PELANGGAN  dari tuntutan dan/atau gugatan hukum dari pihak lain manapun yang dinyatakan  memiliki atau turut memiliki hak dan kepentingan atas Kendaraan tersebut.</li>
        <li><span dir="ltr"> </span>MRENT akan mentaati  semua syarat dan kewajiban yang tertuang dalam Perjanjian dan SKPSMK serta akan  melaksanakan keseluruhan dari isi Perjanjian dan SKPSMK dengan itikad baik dan  penuh tanggung jawab.</li>
      </ol>
      <p><strong>Pasal 1</strong><strong>4</strong><strong>.  PENYELESAIAN SENGKETA</strong></p>
      <ol>
        <li><span dir="ltr"> </span>Para  Pihak sepakat bahwa setiap sengketa yang terjadi karena atau dalam kaitannya  dengan Perjanjian akan diselesaikan melalui musyawarah untuk mencapai mufakat.</li>
        <li><span dir="ltr"> </span>Apabila  mufakat sebagaimana yang dimaksud dalam ayat 1 Pasal ini tidak tercapai, maka Para  Pihak sepakat untuk meyelesaikan sengketa tersebut di Pengadilan Negeri Jakarta  Selatan di Jakarta.</li>
    </ol>      <p>&nbsp;</p></td>
    <td align="justify" valign="top"><p><strong>Pasal </strong><strong>15</strong><strong>.  KETENTUAN LAIN-LAIN</strong></p>
      <ol>
        <li><span dir="ltr"> </span>Dalam hal terjadi  pertentangan / perbedaan pengaturan antara Perjanjian dan SKPSMK ini, maka yang  berlaku mutlak adalah ketentuan dalam Perjanjian, dengan pengecualian sebagaimana  yang ditentukan dalam Pasal 7 ayat 4 dan Pasal 8 ayat 3 SKPSMK  ini.</li>
        <li><span dir="ltr"> </span>Perubahan Perjanjian:</li>
        <li><span dir="ltr"> </span>Setiap syarat dan  ketentuan yang belum atau tidak cukup diatur atau dicantumkan dalam Perjanjian  dan/atau SKPSMK ini akan dibicarakan dan ditambahkan berdasarkan kesepakatan  bersama yang dibuat secara tertulis.</li>
        <li><span dir="ltr"> </span>Segala perubahan,  penambahan dan/atau perpanjangan terhadap Perjanjian tidak akan berlaku kecuali  disepakati secara tertulis dan ditandatangani oleh para pejabat yang berwenang  dari masing-masing pihak, kesepakatan mana dianggap satu kesatuan yang tidak  terpisahkan dari Perjanjian.</li>
        <li><span dir="ltr"> </span>Apabila terdapat  penambahan dan/atau pengurangan Kendaraan yang disewa PELANGGAN dari MRENT  selama berlakunya Perjanjian ini, maka hal tersebut akan dimuat dalam perubahan  Lampiran Perjanjian, sepanjang tidak ditentukan lain, perubahan Lampiran  Perjanjian tersebut tidak mengubah ketentuan-ketentuan yang telah disepakati  dalam Perjanjian ini.</li>
        <li><span dir="ltr"> </span>Dalam hal terjadi  perubahan pada Lampiran Perjanjian, maka yang berlaku dan mengikat Para  Pihak adalah Lampiran yang terakhir disepakati oleh  Para Pihak.</li>
        <li><span dir="ltr"> </span>Setiap korespondensi  baik permintaan atau yang lainnya akan disampaikan melalui pos tercatat, bisa  kurir atau diserahkan langsung (masing-masing wajib disertai dengan tanda  terima), dan dialamatkan ke alamat yang tercantum pada Perjanjian atau kepada  alamat lain seperti yang dinyatakan secara tertulis oleh salah satu pihak.  Setiap pemberitahuaan/korespondensi melalui pos tercatat atau jasa kurir  dianggap telah diterima pada hari ke-lima hari kerja setelah tanggal pengiriman  dan pemberitahuan dengan penyerahan langsung akan dianggap telah diterima pada  saat diserahkan.</li>
        <li><span dir="ltr"> </span>Apabila satu atau  lebih ketentuan yang terdapat dalam Perjanjian dan/atau SKPSMK ini dinyatakan  tidak berlaku atau tidak dapat dilaksanakan oleh pengadilan yang berwenang atau  dianggap bertentangan dengan ketentuan atau peraturan yang berlaku maka  ketentuan-ketentuan lainnya yang terdapat dalam Perjanjian dan/atau SKPSMK akan  tetap berlaku dan mengikat Para Pihak.</li>
        <li><span dir="ltr"> </span>Setiap lampiran merupakan bagian yang integral dan menjadi  satu kesatuan yang tidak dapat dipisahkan dari Perjanjian dan SKPSMK ini. </li>
        <li><span dir="ltr"> </span>Apabila terjadi suatu  pengakhiran atau pemutusan terhadap Perjanjian sepanjang telah mengikuti  ketentuan-ketentuan dalam SKPSMK ini, maka Para Pihak sepakat untuk mengabaikan  berlakunya atau mengesampingkan Pasal 1266 KUHPerdata Republik Indonesia,  sepanjang dipersyaratkannya persetujuan pengadilan untuk mengakhiri atau  memutus Perjanjian. </li>
        <li><span dir="ltr"> </span>Perjanjian ini, maupun  setiap hak dan kewajiban berdasarkan Perjanjian ini dapat dialihkan oleh MRENT dengan persetujuan  dan/atau pemberitahuan kepada PELANGGAN.  </li>
        <li><span dir="ltr"> </span>Perjanjian dan  pelaksanaan daripadanya akan diatur dalam semua aspek oleh dan diinterpretasikan  sesuai dengan hukum Republik Indonesia.</li>
        <li><span dir="ltr"> </span>Perjanjian  dilaksanakan dengan menggunakan bahasa Indonesia yang merupakan bahasa yang sah  terlepas dari terjemahan dalam sesuatu bahasa yang lain.</li>
      </ol>
      <p>&nbsp;</p>
    <p align="center"> ----------********----------</p></td>
  </tr>
  <tr>
    <td width="329" align="left" valign="top"><p>&nbsp;</p></td>
    <td width="365" align="left" valign="top"><p>&nbsp;</p>
      <p align="right"> <em>Paraf ____________</em></p></td>
  </tr>
  <tr>
    <td colspan="2" align="right" valign="top"><p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html>