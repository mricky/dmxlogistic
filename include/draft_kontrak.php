<?php require_once('../connections/con_gl.php'); ?>
<?php
//echo 'dodol';
//echo $_POST[norek];
//echo $_GET[noreferensi];
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
$query_lkend = "select d.jeniskendaraan, b.nopolisi, c.tipekendaraan, b.tahun, b.nomesin, b.norangka from gl_dkontrak a, gl_masterkendaraan b, gl_tipekendaraan c, gl_jeniskendaraan d where a.kontrak='$_GET[referensi]' AND a.kendaraan = b.id AND b.tipekendaraan = c.id and b.jeniskendaraan = d.id order by a.id";
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
	font-size:10px;
	font-weight:bold;
	text-align:center;
	border:none;
}
</style>
</head>

<body>
<table width="710" border="0" align="center" cellpadding="8" cellspacing="0" style="border:solid 1px #000000;">
  <tr>
    <td colspan="3" align="center" valign="top" style="border-bottom:solid 1px #000;"><h2>PERJANJIAN SEWA MENYEWA KENDARAAN</h2><br /><strong>NOMOR : </strong><?php echo $_GET['referensi'];?></td>
  </tr>
  <tr>
    <td colspan="3" align="justify" valign="top">Yang bertanda tangan di bawah ini :<ol>
      <li><strong><?php echo $row_gudang['pajak_pt']; ?></strong> berkedudukan di Bandung, berkantor pusat di <?php echo $row_company['alamat']; ?>, yang dalam hal ini diwakili oleh
        <strong><?php echo $row_gudang['sign_kontrak'];?></strong> berdasarkan jabatannya sebagai <strong>DIREKTUR</strong> oleh karenanya berhak dan berwenang bertindak untuk dan atas nama <strong><?php echo $row_gudang['pajak_pt'];?></strong> beralamat di <strong><?php echo $row_gudang['keterangan']; ?></strong>, yang selanjutnya disebut sebagai <strong>PIHAK PERTAMA </strong>----</li>
      <li><strong><?php echo $row_kontrak['nama'];?></strong> beralamat <?php echo $row_kontrak['alamat'];?> , yang dalam hal ini diwakili oleh  <strong><?php echo $row_kontrak['nama2'];?></strong> sebagai  <?php echo $row_kontrak['jabatan2'];?>
       , karenanya berhak dan berwenang bertindak untuk dan atas nama<strong> <?php echo $row_kontrak['nama'];?></strong>, yang selanjutnya disebut sebagai <strong>PIHAK KEDUA </strong>----</li>
    </ol>PIHAK PERTAMA dan PIHAK KEDUA secara bersama – sama disebut para pihak<br />
    <br />
    PARA PIHAK terlebih dahulu menerangkan hal-hal sebagai berikut : <ul style="list-style:square;paddings:4px;margin:5px;">
      <li>Bahwa PIHAK PERTAMA merupakan badan hukum yang bergerak dibidang Jasa  persewaan kendaraan ( rental car) yang didirikan  Berdasarkan akta Notaris Ir. Sari Wahjuni, M.Sc., S.H., M.H., M.Kn. No. AHU-00359.AH.02.02 Tahun 2014</li>
      <li>Bahwa PIHAK KEDUA merupakan sebuah perusahaan yang membutuhkan sewa kendaraan.</li>
    </ul>    
    Bahwa pada tanggal <strong><?php tanggal($row_kontrak['tgl'],"tampilkan"); ?></strong> bertempat di Bandung. Para pihak tersebut diatas telah setuju dan sepakat untuk melakukan suatu perjanjian sewa menyewa kendaraan (selanjutnya disebut dengan Perjanjian) yang dalam perjanjian ini di sebut sebagai objek perjanjian, dengan ketentuan – ketentuan dan syarat – syarat sebagai berikut :</td>
  </tr>
  <tr>
    <th colspan="3" align="center" valign="top">PASAL 1<br />
    PENGERTIAN dan ISTILAH</th>
  </tr>
  <tr>
    <td colspan="3" align="justify" valign="top"><ol>
      <li><strong>Dokumen Pendukung</strong> adalah dokumen  yang diperlukan untuk pelaksanaan perjanjian. Dalam hal pihak Kedua atas nama  perusahaan dokumen pendukung adalah berupa : fotocopy akta pendirian perusahaan  , fotocopy  Surat Ijin Usaha (SIUP) dan  fotocopy  Tanda daftar perusahaan ( TDP  ), fotocopy NPWP, fotocopy KTP dan SIM pemohon, Purchase Order ( PO ) sewa  kendaraan dari PIHAK KEDUA  yang  dibutuhkan oleh PIHAK PERTAMA. Dalam hal pihak Kedua atas nama pribadi, dokumen  yang dibutuhkan adalah : fotocopy Kartu Keluarga , fotocopy  PBB/Rek listrik/tlp, fotocopy KTP dan SIM  pemohon, fotocopy KTP penjamin dan surat pernyataan  penjamin dari PIHAK KEDUA  yang dibutuhkan oleh PIHAK PERTAMA</li>
      <li><strong>Masa sewa </strong>adalah jangka waktu  pelaksanaan perjanjian sejak di tandatanganinya Perjanjian oleh para pihak  sampai dengan batas waktu yang telah ditentukan sesuai dengan Perjanjian.</li>
      <li><strong>Biaya sewa </strong>adalah<strong> </strong>biaya  yang harus dibayar oleh PIHAK KEDUA kepada PIHAK PERTAMA atas pemakaian  kendaraan sewa sesuai dengan masa sewa.</li>
      <li><strong>Kendaraan Sewa</strong> adalah kendaraan  milik PIHAK PERTAMA yang di sewa oleh PIHAK KEDUA sesuai dengan perjanjian dan  Berita Acara Serah Terima Kendaraan Sewa (BASTEKS) yang merupakan objek  perjanjian.</li>
      <li><strong>Kendaraan Pengganti </strong>adalah  kendaraan sewa yang diserahkan oleh PIHAK PERTAMA kepada PIHAK KEDUA untuk  menggantikan sementara kendaraan sewa yang mengalami kerusakan berat.</li>
      <li><strong>Deposit  atas risiko sendiri </strong>adalah  sejumlah  uang yang ditetapkan oleh PIHAK  PERTAMA yang dibayar oleh PIHAK KEDUA sebagai jaminan apabila terjadi kerusakan  yang diakibatkan oleh PIHAK KEDUA selama masa sewa berlangsung. Deposit  dikembalikan pada saat akhir masa sewa apabila PIHAK KEDUA dapat memenuhi  tentang kondisi kendaraan pada saat dikembalikan sesuai dengan data chek list  kendaraan. </li>
      <li><strong>Jaminan Sewa </strong>adalah  sejumlah  uang yang ditetapkan oleh PIHAK  PERTAMA yang dibayar oleh PIHAK KEDUA kepada PIHAK PERTAMA. Sebagai jaminan  apabila terjadi tunggakan, yang akan dikembalikan pada saat akhir masa sewa  oleh PIHAK PERTAMA kepada PIHAK KEDUA, apabila PIHAK KEDUA dapat memenuhi  seluruh persyaratan/kondisi yang tercantum dalam perjanjian.</li>
      <li><strong>Denda Sewa </strong>adalah sejumlah  uang yang harus dibayar oleh PIHAK KEDUA sehubungan dengan keterlambatan  pembayaran sewa kendaraan dan atau keterlambatan pengembalian <strong>kendaraan sewa</strong>.</li>
      <li><strong>Biaya Administrasi </strong>adalah sejumlah  uang yang ditetapkan oleh PIHAK PERTAMA kepada PIHAK KEDUA yang mencakup biaya  survey, biaya pengiriman/pengembalian kendaraan, dan materai.</li>
      <li><strong>PIHAK KEDUA</strong> adalah termasuk selain yang menandatangani perjanjian ini, yaitu  pengendara / supir, orang suruhan, bawahan, atasan di perusahaan / pribadi yang  bertalian dengan orang yang menandatangi perjanjian ini.</li>
      <li><strong>Additional Charge </strong>adalah sejumlah  uang yang ditetapkan PIHAK PERTAMA untuk dibayarkan oleh PIHAK KEDUA kepada  PIHAK PERTAMA sehubungan  dengan adanya  permintaan dari PIHAK KEDUA kepada PIHAK PERTAMA untuk pengurusan kecelakaan,  biaya pengurusan Berkas Berita Acara dari pihak kepolisian sebagai syarat untuk  klaim asuransi kehilangan akibat pencurian, service/ maintenance kendaraan sewa  diluar service/maintenance berkala yang menjadi kewajiban PIHAK PERTAMA ke  tempat yang ditetapkan PIHAK KEDUA.</li>
    </ol></td>
  </tr>
  <tr>
    <th colspan="3" align="center" valign="top">PASAL 2<br />RUANG LINGKUP</th>
  </tr>
  <tr>
    <td colspan="3" align="left" valign="top"><p>Perjanjian ini mengatur pelaksanaan sewa menyewa kendaraan yang  disewakan oleh PIHAK PERTAMA kepada PIHAK KEDUA dengan ruang lingkup sebagai  berikut :</p>
      <ol start="1" type="1">
        <li>Jenis /       Type  dan Spesifikasi Kendaraan<br />
          <table width="100%" border="1" cellspacing="0" cellpadding="4">
            <tr>
              <th width="5%">NO</th>
              <th>Tipe Kendaraan</th>
              <th width="10%">Tahun</th>
              <th width="12%">No. Polisi</th>
              <th width="20%">No. Rangka</th>
              <th width="20%">No Mesin</th>
            </tr>
            <?php $no=1; do { ?>
            <tr valign="top">
              <td align="right"><?php echo $no;$no++;?>.</td>
              <td><?php echo $row_lkend['tipekendaraan'];?></td>
              <td align="center"><?php echo $row_lkend['tahun'];?></td>
              <td align="center"><?php echo $row_lkend['nopolisi'];?></td>
              <td align="center"><?php echo $row_lkend['norangka'];?></td>
              <td align="center"><?php echo $row_lkend['nomesin'];?></td>
            </tr>
            <?php }while($row_lkend = mysql_fetch_assoc($lkend)); ?>
          </table>
        </li>
        <li>Penggunaan       dan Area / Daerah Penggunaan Kendaraan
          <ol>
            <li>PIHAK  KEDUA akan menggunakan kendaraan sewa sesuai dengan ijin peruntukannya. </li>
            <li>Area  / Daerah penggunaan kendaraan sewa adalah hanya mencakup daerah yang telah disepakati.</li>
          </ol>
        </li>
    </ol>    Apabila PIHAK KEDUA menggunakan  kendaraan diluar area/ daerah penggunaan, maka  PIHAK KEDUA wajib memberitahukan kepada PIHAK PERTAMA paling lambat 1 (satu)  hari sebelum PIHAK KEDUA merubah area/daerah penggunaan.</td>
  </tr>
  <tr>
    <th colspan="3" align="center" valign="top">PASAL 3<br />
      HAK &amp; KEWAJIBAN</th>
  </tr>
  <tr>
    <td colspan="3" align="justify" valign="top"><ol>
      <li>PIHAK  PERTAMA menyerahkan kendaraan  untuk disewa oleh PIHAK KEDUA dan PIHAK KEDUA menerima kendaraan sewa dari  PIHAK PERTAMA yang dibuktikan dengan Berita Acara Serah Terima Kendaraan dan  Check list Kendaraan. </li>
      <li>PIHAK  PERTAMA menyediakan kendaraan pengganti dalam kondisi baik untuk PIHAK KEDUA  apabila kendaraan sewa mengalami kerusakan yang bukan diakibatkan oleh PIHAK  KEDUA, yang membutuhkan waktu perbaikan minimal 4 (empat) jam. Dan PIHAK KEDUA  wajib mengembalikan kendaraan pengganti pada saat kendaraan yang disewa PIHAK  KEDUA selesai diperbaiki. </li>
      <li>Apabila  kerusakan kendaraan sewa diakibatkan oleh kelalaian PIHAK KEDUA, maka biaya  perbaikan dan biaya inap kendaraan   selama kendaraan tidak bisa dioperasikan, akan menjadi tanggung jawab  PIHAK KEDUA. Besarnya biaya inap kendaraan dihitung berdasarkan rata-rata tarif  sewa bulanan. </li>
      <li>Pembayaran  biaya yang tercantum pada pasal 3 ayat 3, dilakukan dimuka sesuai dengan  perkiraan waktu perbaikan dari pihak bengkel. </li>
      <li>PIHAK  PERTAMA bertanggung jawab untuk memperpanjang STNK/KIR kendaraan sewa  selambat-lambatnya 2 ( dua ) Minggu sebelum berakhirnya masa  berlaku STNK/KIR kendaraan dan seluruh biaya perpanjangan STNK/KIR tersebut  akan ditanggung oleh PIHAK PERTAMA. Apabila STNK/KIR kendaraan hilang dan atau  terjadinya keterlambatan pengurusan perpanjangan STNK/KIR karena kesalahan  PIHAK KEDUA maka biaya-biaya yang timbul akibat keterlambatan tersebut akan  ditanggung oleh PIHAK KEDUA. Dan PIHAK KEDUA wajib memberitahukan PIHAK PERTAMA  tentang hal STNK/KIR atau kepentingan/kejadian/kondisi yang dimaksud ayat ini  kepada PIHAK PERTAMA. </li>
      <li>PIHAK  PERTAMA menanggung semua biaya perbaikan/perawatan rutin kendaraan yang  diperlukan yang disebabkan oleh kemunduran fungsi dan atau kerusakan karena  usia, baik yang dilakukan secara periodik maupun insidentil, dan akan dilakukan  di bengkel yang ditentukan oleh PIHAK PERTAMA.</li>
      <li>PIHAK  PERTAMA akan melakukan service secara teratur, sebagaimana perbaikan dan  perawatan yang diakibatkan karena pemakaian yang wajar. PIHAK KEDUA wajib  menghubungi PIHAK PERTAMA untuk pengaturan perawatan atau pemeriksaan secara  teratur setiap perjalanan 3000 - 5000 KM. PIHAK KEDUA bertanggung jawab untuk  semua biaya perbaikan jika PIHAK KEDUA gagal memenuhi semua pemeriksaan  perawatan seperti yang telah ditentukan diatas.</li>
      <li>PIHAK  KEDUA wajib memeriksa kondisi normal dari olie mesin, minyak rem, minyak power  starring, air radiator serta memperhatikan kondisi normal indikator temperatur  mesin, BBM dan tekanan ban setiap hari sebelum menghidupkan mesin dan  mengoperasikan kendaraan untuk menjamin keamanan dan kenyamanan berkendara  PIHAK KEDUA wajib memberitahukan PIHAK PERTAMA apabila terdapat kondisi  abnormal untuk dilakukan perbaikan oleh PIHAK PERTAMA. </li>
      <li>Jika  PIHAK KEDUA tidak melaporkan kondisi abnormal yang dimaksud dalam pasal 3 ayat  8, yang dapat mengakibatkan kerusakan kendaraan jika dioperasikan, maka  kerusakan kendaraan dalam pengoperasiannya merupakan kesalahan PIHAK KEDUA. Dan  PIHAK KEDUA bertanggung jawab dan menanggung resiko yang timbul kemudian akibat  kesalahan tersebut.</li>
      <li>PIHAK KEDUA wajib memelihara kondisi  kendaraan sewa milik PIHAK PERTAMA secara rutin sesuai dengan petunjuk service  kendaraan, sehingga selama masa sewa dan masa perpanjangannya, kendaraan sewa  tetap berada dalam kondisi yang baik dan siap untuk digunakan. </li>
      <li>PIHAK KEDUA bertanggung jawab untuk  menanggung seluruh biaya yang timbul atas suatu peristiwa terjadinya kecelakaan  lalu lintas dan atau sesuatu klaim kerugian dari PIHAK KETIGA. </li>
      <li>PIHAK  KEDUA bertanggung jawab untuk menanggung seluruh biaya yang timbul akibat  kehilangan kendaraan sewa milik PIHAK PERTAMA, yang mencakup biaya-biaya:
        <ol>
          <li>Biaya pengurusan surat-surat kehilangan  kendaraan mulai dari tingkat Polisi Sektor sampai tingkat Kepolisian Daerah  setempat, dibayarkan di muka</li>
<li>Biaya resiko sendiri  yang tercantum pada ketentuan Asuransi, dibayarkan di muka</li>
<li>Biaya kehilangan kendaraan sebesar 10% (sepuluh  persen) dari nilai pertanggungan yang tercantum pada ketentuan Asuransi,  dibayar setelah mendapat keputusan penggantian dari pihak Asuransi yang berlaku  untuk Asuransi Allrisk. (disesuaikan perjanjian awal Allrisk /TLO)</li>
<li>Apabila klaim kehilangan   tidak disetujui oleh pihak Asuransi,  maka PIHAK KEDUA wajib melakukan penggantian 100% (seratus persen) dari nilai  pertanggungan yang ditetapkan oleh pihak Asuransi.</li>
<li>Dalam hal ini apabila PIHAK KEDUA  menggunakan kendaraan tanpa menggunakan jasa DRIVER  yang telah disediakan oleh PIHAK PERTAMA dan  apabila kehilangan kendaraan terjadi di lingkungan kantor PIHAK KEDUA setelah  DRIVER yang telah disediakan PIHAK PERTAMA menyerahkan kunci kendaraan kepada  PIHAK KEDUA. </li>
        </ol>
      </li>
      <li>PIHAK KEDUA bertanggung jawab atas biaya  kerusakan dan perbaikan kendaraan yang diakibatkan karena penggunaan beban,  tonase dan muatan kendaraan yang berlebihan/tidak sesuai spesifikasi kapasitas  kendaraan.</li>
      <li>PIHAK KEDUA wajib menggunakan kendaraan  hanya untuk kepentingan pribadi atau perusahaan dengan pengemudi yang terampil  dan memiliki SIM yang berlaku. Dalam hal PIHAK KEDUA menggunakan pengemudi yang  tidak terampil atau tidak memiliki SIM maka PIHAK KEDUA akan sepenuhnya  bertanggung jawab untuk setiap kerusakan, kehilangan, kecelakaan lalu lintas  dan atau klaim kerugian dari PIHAK KETIGA.</li>
      <li>PIHAK KEDUA wajib membayar denda  sehubungan dengan keterlambatan pengembalian kendaraan sewa dengan perhitungan  tarif sewa harian, setiap hari keterlambatan.</li>
      <li>Pada saat berakhirnya perjanjian PIHAK  KEDUA wajib mengembalikan kendaraan sewa sesuai  dengan   Berita Acara Serah Terima Kendaraan Sewa dan check list kendaraan pada  saat awal serah terima.</li>
      <li>PIHAK PERTAMA akan mengembalikan biaya  deposit sewa kendaraan kepada PIHAK KEDUA paling lambat 30 (tigapuluh) hari  kalender terhitung setelah tanggal perjanjian berakhir. Pembayaran tersebut  setelah PIHAK PERTAMA melakukan pengecekan kondisi keutuhan kendaraan pada saat  diserahkan harus sama dengan pada saat diterima oleh PIHAK KEDUA, dan  pengecekan administrasi serta setelah memperhitungkan beban kerugian PIHAK  PERTAMA yang diakibatkan oleh kesalahan PIHAK KEDUA yang menjadi tanggung jawab  PIHAK KEDUA ( jika ada ) sesuai dengan perjanjian ini.</li>
      <li>PIHAK KEDUA wajib membayar kepada PIHAK  PERTAMA apabila ada kekurangan pembayaran atau tunggakan maka akan ditagih  terpisah</li>
      <li>PARA PIHAK  tidak diperkenankan untuk mempergunakan  data-data Dokumen Pendukung yang diperoleh dari perjanjian sewa kendaraan untuk  kepentingan lain.</li>
    </ol>
    PIHAK KEDUA dilarang menggunakan kendaraan yang  tidak sesuai dengan perundangan – undangan yang berlaku dan beban tonase/muatan  yang berlebihan sehingga mengakibatkan kerusakan kendaraan.</td>
  </tr>
  <tr>
    <th colspan="3" align="center" valign="top">PASAL 4<br />
    MASA BERLAKU PERJANJIAN</th>
  </tr>
  <tr>
    <td colspan="3" align="justify" valign="top"><ol>
      <li>Masa  berlaku perjanjian ini selama <?php echo $row_kontrak['durasi'];?> Bulan dengan periode sewa
<?php tanggal($row_kontrak['mulai'],"tampilkan"); ?>
       sampai dengan 
      <?php tanggal($row_kontrak['sampai'],"tampilkan"); ?>
</li>
      <li>Para  Pihak sepakat bahwa jangka waktu perjanjian dapat diperpanjang sesuai dengan  kesepakatan para pihak.</li>
    </ol>
    Jika PIHAK KEDUA akan memperpanjang perjanjian  sewa menyewa kendaraan, maka akan dibuat perjanjian baru dengan syarat-syarat  dan ketentuan – ketentuan yang disepakati oleh para pihak</td>
  </tr>
  <tr>
    <th colspan="3" align="center" valign="top">PASAL 5<br />
    BERAKHIRNYA PERJANJIAN</th>
  </tr>
  <tr>
    <td colspan="3" align="justify" valign="top"><ol>
      <li>Para Pihak atau salah satu pihak dapat  mengakhiri atau memperpanjang perjanjian ini dengan ketentuan bahwa pihak yang  menghendaki pengakhiran atau perpanjangan ini harus terlebih dahulu  menyampaikan pemberitahuan secara tertulis kepada pihak lainnya 7 (tujuh) hari  sebelumnya. </li>
      <li>Bahwa  perjanjian ini berakhir dengan sendirinya ketika masa sewa yang telah  disepakati terlampaui.</li>
      <li>Jika  PIHAK KEDUA tidak melaksanakan isi dari Perjanjian.</li>
      <li>Jika  PIHAK KEDUA dikemudian hari terbukti memberikan data legalitas yang dipalsukan.</li>
      <li>PIHAK  KEDUA terlibat pelanggaran hukum positif yang berlaku. </li>
      <li>Dengan  berakhirnya atau diakhirinya Perjanjian ini tidak menghapuskan tanggung jawab  masing-masing pihak sebagai akibat dari pelaksanaan perjanjian ini sehingga  PARA PIHAK wajib melaksanakan segala hal yang masih harus diselesaikan sebagai  akibat dari pelaksanaan Perjanjian ini.</li>
      <li>Untuk  pengakhiran Perjanjian ini, PARA PIHAK dengan ini mengesampingkan ketentuan  Pasal 1266  dan 1267 Kitab Undang-Undang  Hukum Perdata Indonesia, sehingga pengakhiran perjanjian secara sah cukup  dilakukan dengan pemberitahuan tertulis dari Para Pihak sebagaimana ditentukan  dalam pasal ini.</li>
      <li>Jika PIHAK KEDUA  sewaktu-waktu mengembalikan kendaraan sebelum masa sewa berakhir, maka PIHAK  KEDUA akan dikenakan <em>Denda </em>sebesar 25%  ( dua puluh lima persen) dari sisa nilai kontrak sewa.</li>
    </ol></td>
  </tr>
  <tr>
    <th colspan="3" align="center" valign="top">PASAL 6<br />
    PENARIKAN KENDARAAN SEWA</th>
  </tr>
  <tr>
    <td colspan="3" align="justify" valign="top"><ol>
      <li>PIHAK  KEDUA wajib mengembalikan kendaraan sewa kepada PIHAK PERTAMA seketika pada  saat Perjanjian telah berakhir.</li>
      <li>PIHAK  PERTAMA akan menarik kendaraan sewa dari PIHAK KEDUA Apabila PIHAK KEDUA belum  mengembalikan kendaraan sewa tersebut pada saat masa sewa kendaraan berakhir,  berikut beban biaya operasional   penarikan serta denda keterlambatan pengembalian menjadi tanggung jawab  PIHAK KEDUA. </li>
    </ol>
    PIHAK KEDUA dikemudian hari terbukti memindah  tangankan kendaraan sewa kepada Pihak Lain dengan alasan apapun, maka PIHAK  PERTAMA akan menarik kendaraan tersebut beserta membebankan biaya penarikan dan  biaya – biaya lain yang timbul sebagai akibat pengurusan kendaraan sewa  tersebut disertai dengan proses hukum yang berlaku</td>
  </tr>
  <tr>
    <th colspan="3" align="center" valign="top">PASAL 7<br />
    HARGA SEWA KENDARAAN</th>
  </tr>
  <tr>
    <td colspan="3" align="justify" valign="top"><ol>
      <li>Harga sewa kendaraan yang harus dibayar  PIHAK KEDUA kepada PIHAK PERTAMA dengan rincian sebagai berikut :<br />
        <table width="100%" border="1" cellspacing="0" cellpadding="4">
        <?php do { ?>
          <tr>
            <td width="30%" align="left"><?php echo $row_slkend['jeniskendaraan'];?> <?php echo $row_slkend['tipekendaraan'];?></td>
            <td>Rp. <?php echo number_format($row_invoice['harga'],0,',','.');?>,-  / Bulan</td>
          </tr>
          <?php }while($row_slkend = mysql_fetch_assoc($slkend)); ?>
          <tr>
            <td align="left">Diskon</td>
            <td>Rp. 0,-</td>
          </tr>
          <tr>
            <td align="left">Biaya Tambahan</td>
            <td>Rp. <?php echo number_format($row_stotal['salary_driver'],0,',','.');?>,-</td>
          </tr>
          <tr>
            <td align="left">PPN (10%)</td>
            <td>Rp. <?php echo number_format($row_invoice['ppnunit'],0,',','.');?>,- / Bulan</td>
          </tr>
          <tr valign="top">
            <td align="left">PPH 23 (2%)</td>
            <td>&nbsp;</td>
          </tr>
          <tr valign="top">
            <td align="right">Total :<br />
              <br />
              Terbilang :</td>
            <td>Rp. <?php echo number_format($row_stotal['total'],0,',','.');?>,- / <?php echo $row_kontrak['durasi'];?> bulan<br />
              <br />
              <i><?php echo ucwords(Terbilang($row_stotal['total']));?> Rupiah</i></td>
          </tr>
        </table>
      </li>
      <li>Harga tersebut sudah termasuk biaya  perawatan dan perbaikan kendaraan yang diperlukan, disebabkan oleh kemunduran  fungsi dan faktor usia, biaya perpanjangan STNK dan KIR ( untuk Mbl Box ).</li>
    </ol>Jumlah harga tersebut belum termasuk  biaya-biaya/ denda-denda yang harus dibayar oleh PIHAK KEDUA kepada PIHAK PERTAMA  yang mungkin terjadi dalam masa sewa,  yaitu berupa denda / biaya kendaraan  pengganti, biaya administrasi, dan additional charge yang menjadi tanggung  jawab PIHAK KEDUA.</td>
  </tr>
  <tr>
    <th colspan="3" align="center" valign="top">PASAL 8<br />
    CARA PEMBAYARAN</th>
  </tr>
  <tr>
    <td colspan="3" align="justify" valign="top"><ol>
      <li>Pembayaran  sewa kendaraan dilakukan oleh PIHAK KEDUA di depan setelah invoice diterima dan  atau sesuai kesepakatan para pihak .Apabila pembayaran melalui transfer  bank,  pembayaran disetor ke rekening, <strong>No. Rek. <?php echo $row_gudang[bank];?> - <?php echo $row_gudang[norek];?> Atas Nama : <?php echo $row_gudang[atasnama];?></strong>.<strong></strong></li>
      <li>Apabila PIHAK KEDUA terlambat melakukan  pembayaran sesuai batas waktu yang sudah ditentukan, maka PIHAK KEDUA harus  membayar denda keterlambatan sebesar 0,1 % setiap hari dari total tagihan yang  harus dibayarkan kepada PIHAK PERTAMA, apabila keterlambatan pembayaran  tersebut lebih dari 7 hari maka PIHAK PERTAMA akan menarik kendaraan yang  disewa oleh PIHAK KEDUA.<strong></strong></li>
    </ol>
    Apabila PIHAK KEDUA melakukan pembayaran melalui  transfer bank dan setelah jumlah uang tersebut efektif masuk ke rekening <strong>No. Rek. <?php echo $row_gudang[bank];?> - <?php echo $row_gudang[norek];?> Atas Nama : <?php echo $row_gudang[atasnama];?></strong>.<strong></strong>, maka pengambilan atau penyerahan kendaraan sewa dapat dilakukan  setelah PIHAK KEDUA menyerahkan bukti setor sejumlah uang tersebut untuk  pembayaran sewa kendaraan sesuai dengan perjanjian.</td>
  </tr>
  <tr>
    <th colspan="3" align="center" valign="top">PASAL 9<br />
    PERNYATAAN DAN JAMINAN</th>
  </tr>
  <tr>
    <td colspan="3" align="justify" valign="top"><ol>
      <li>PARA  PIHAK<strong> </strong>dengan ini menyatakan dan  menjamin  bahwa :
        <ol>
          <li>Masing-masing  pihak dapat melakukan tindakan hukum dan sah karenanya mempunyai wewenang untuk  mengadakan perjanjian ini.</li>
          <li>PARA  PIHAK memiliki setiap izin yang disyaratkan undang-undang dan peraturan lainnya  yang berlaku untuk melaksanakan kegiatannya.</li>
          <li>Pihak  yang bertandatangan pada Perjanjian ini merupakan pihak yang sah dan berwenang  mewakili PARA PIHAK berdasarkan anggaran dasarnya atau atas dasar diri /  pribadi masing-masing pihak.</li>
          <li>PARA  PIHAK tidak akan mengambil keuntungan dari adanya kesalahan atau kekeliruan  ketentuan dan syarat-syarat dalam Perjanjian ini.</li>
          <li>PARA  PIHAK tidak sedang berada dalam keadaan lalai untuk melaksanakan kewajiban  apapun baik kepada pihak ketiga maupun pihak lainnya, kewajiban mana dapat  mempengaruhi pelaksanaan Perjanjian ini. </li>
          <li>PARA  PIHAK sepakat untuk tidak memberikan informasi mengenai isi Perjanjian kepada PIHAK KETIGA manapun tanpa persetujuan tertulis dari Pihak  lainnya kecuali dalam rangka memenuhi kewajiban berdasarkan peraturan  perundang-undangan yang berlaku.</li>
          </ol>
      </li>
      <li>PIHAK  PERTAMA menyatakan dan menjamin bahwa kendaraan sewa memiliki surat tanda  kendaraan yang sah ( STNK / KIR ) yang siap digunakan.</li>
      <li>PIHAK  KEDUA menyatakan dan menjamin bahwa :
        <ol>
          <li>Pembayaran  dengan cek / Bilyet Giro yang diserahkan kepada PIHAK PERTAMA tidak akan kosong  ketika dicairkan, sesuai dengan tanggal jatuh tempo. Jika ternyata cek dan  Bilyet Giro tersebut kosong, maka akan diganti pada saat itu juga dengan uang  tunai sejumlah pembayaran tersebut.</li>
          <li>Semua  data /informasi yang berupa foto copy / salinan dokumen pendukung yang  diserahkan oleh PIHAK KEDUA kepada PIHAK PERTAMA adalah benar sesuai dengan  keadaan yang sebenarnya dan apabila dikemudian hari dari ternyata tidak benar  PIHAK KEDUA bersedia dituntut dimuka Pengadilan.</li>
          <li>PIHAK  KEDUA telah melaksanakan segala tindakan yang menurut ketentuan hukum  berdasarkan anggaran dasarnya / diri pribadi yang diperlukan untuk  melangsungkan, menjalankan dan melaksanakan segala kewajibannya berdasarkan  Perjanjian ini dan orang-orang yang menandatangani Perjanjian ini atas nama  PIHAK KEDUA berkuasa atau telah dikuasakan secara sah untuk melakukan.</li>
          <li>PIHAK  KEDUA akan memberitahukan secara tertulis kepada PIHAK PERTAMA bilamana terjadi  perubahan pada alamat, no. telepon, penanggung jawab dan perubahan lain yang  dapat mempengaruhi pelaksanaan perjanjian.</li>
        </ol>
      </li></ol></td>
  </tr>
  <tr>
    <th colspan="3" align="center" valign="top">PASAL 10<br />
    LARANGAN - LARANGAN</th>
  </tr>
  <tr>
    <td colspan="3" align="justify" valign="top"><ol>
      <li>PIHAK  PERTAMA tidak diperkenankan untuk mempergunakan data-data Dokumen Pendukung  yang diperoleh dari PIHAK KEDUA dalam pelaksanaan sewa menyewa kendaraan untuk  kepentingan lain dan/atau kepentingan pihak lain tanpa persetujuan tertulis  PIHAK KEDUA.</li>
      <li>PIHAK  KEDUA menjamin sepenuhnya bahwa <strong>kendaraan yang disewa</strong> tidak akan  dipindah tangankan dengan alasan apapun kepada pihak lain.<strong></strong></li>
      <li>PIHAK  KEDUA dilarang melakukan suatu perubahan apapun terhadap bentuk semula dari  kendaraan sewa tersebut, menambah dan atau meniadakan perlengkapan orisinil  dari <strong>kendaraan sewa</strong>.<strong></strong></li>
      <li>PIHAK  KEDUA dilarang mengendarai kendaraan dalam pengaruh obat bius, alkohol, kondisi  mengantuk serta mengemudikan kendaraan di luar jalan yang wajar atau tidak  layak dilalui.<strong></strong></li>
      <li>PIHAK  KEDUA dilarang menggunakan kendaraan untuk balapan, rally, kampanye, tindak  pidana  dan dilarang dipergunakan untuk  pengangkutan penumpang dengan tujuan komersial.<strong></strong></li>
      <li>PIHAK  KEDUA dilarang menggunakan kendaraan dengan beban tonase/muatan yang berlebihan  sehingga mengakibatkan kerusakan kendaraan.<strong></strong></li>
    </ol>
    PIHAK KEDUA dilarang menggunakan kendaraan  diluar area/daerah yang disepakati<strong>.</strong></td>
  </tr>
  <tr>
    <th colspan="3" align="center" valign="top">PASAL 11<br />
    PEMBERITAHUAN dan KOMUNIKASI</th>
  </tr>
  <tr>
    <td colspan="3" align="justify" valign="top"><ol>
      <li>Setiap pemberitahuan, surat menyurat dan atau  permintaan data atau dokumen sehubungan dengan Perjanjian ini harus dibuat  secara tertulis dan dapat dikirimkan melalui   : (1) kurir, (2) surat tercatat atau (3) faksimili dengan alamat sebagai  berikut :<br />
        <table width="100%" border="0" cellspacing="0" cellpadding="4">
          <tr>
            <th width="30%">PIHAK PERTAMA</th>
            <td><strong><?php echo $row_gudang['pajak_pt']; ?></strong></td>
            </tr>
          <tr>
            <td align="right" valign="top">NPWP :</td>
            <td valign="top"><?php echo $row_gudang['pajak_npwp']; ?></td>
          </tr>
          <tr>
            <td align="right" valign="top">Alamat :</td>
            <td valign="top"><?php echo $row_gudang['keterangan']; ?></td>
          </tr>
          <tr>
            <td align="right" valign="top">No. Telp :</td>
            <td valign="top"><?php echo $row_gudang['tlp']; ?></td>
          </tr>
          <tr>
            <td align="right" valign="top">Fax :</td>
            <td valign="top"><?php echo $row_company['fax']; ?></td>
            </tr>
          <tr>
            <th>PIHAK KEDUA</th>
            <td><strong><?php echo $row_kontrak['nama'];?></strong></td>
          </tr>
          <tr>
            <td align="right" valign="top">NPWP :</td>
            <td valign="top"><?php echo $row_kontrak['npwp'];?></td>
          </tr>
          <tr>
            <td align="right" valign="top">Alamat :</td>
            <td valign="top"><?php echo $row_kontrak['alamat'];?></td>
          </tr>
          <tr>
            <td align="right" valign="top">No. Telp :</td>
            <td valign="top"><?php echo $row_kontrak['tlp'];?></td>
          </tr>
          <tr>
            <td align="right" valign="top">Email :</td>
            <td valign="top"><?php echo $row_kontrak['email'];?></td>
          </tr>
          </table>
      </li>
    </ol></td>
  </tr>
  <tr>
    <th colspan="3" align="center" valign="top">PASAL 12<br />
    FORCE MAJEURE</th>
  </tr>
  <tr>
    <td colspan="3" align="justify" valign="top"><ol>
<li>Dalam hal PARA PIHAK tidak dapat melaksanakan  kewajiban-kewajiban berdasarkan Perjanjian  ini, baik sebagian maupun keseluruhan karena terjadinya force majeure  maka segala kegagalan atau keterlambatan  tersebut tidak dianggap sebagai kesalahan Para Pihak sehingga Para Pihak tidak  dapat dikenakan sanksi atau denda.</li>
<li>Yang dimaksud  dengan force majeure dalam Perjanjian ini adalah kejadian-kejadian yang terjadi  diluar kemampuan dan kekuasaan PARA  PIHAK sehingga mempengaruhi pelaksanaan Perjanjian ini, yaitu : bencana  alam, perang dan huru hara massa.</li>
<li>Dalam  hal terjadi kejadian force majeure maka pihak yang mengalami keadaan force  majeure berkewajiban untuk memberitahukan  secara tertulis kepada pihak lainnya selambat-lambatnya 1x24 jam terhitung  sejak terjadinya keadaan force majeure tersebut untuk diselesaikan  secara musyawarah.</li>
<li>Apabila  pihak yang mengalami keadaan force majeure tersebut lalai untuk memberitahukan  kepada pihak lainnya dalam kurun waktu sebagaiman ditentukan pada ayat (3)  Pasal ini, maka keadaan sebagaimana pada ayat (2) tersebut diatas dianggap  tidak pernah terjadi sehingga seluruh kerugian, resiko dan konsekwensi yang  mungkin timbul menjadi beban dan tanggung jawab pihak yang mengalami force  majeure.</li>
<li>Keadaan  force majeure ini dapat diterima oleh PARA PIHAK apabila ada pernyatan secara  resmidari pemerintah atau instansi yang berwenang.</li>
    </ol>
    Setelah berakhir atau dapat diatasinya keadaan  force majeure, pihak yang mengalami force majeure wajib segera melaksanakan  kewajiban­kewajibannya yang  tertunda.</td>
  </tr>
  <tr>
    <th colspan="3" align="center" valign="top">PASAL 13<br /> 
    ASURANSI
</th>
  </tr>
  <tr>
    <td colspan="3" align="justify" valign="top"><ol>
      <li>Pihak Pertama mengasuransikan kendaraan yang  akan disewa oleh Pihak Kedua.</li>
      <li>Pihak Kedua wajib memberitahukan kepada Pihak  Pertama apabila terjadi kecelakaan, kehilangan, dan lainnya paling lambat 1 x  24 jam</li>
      <li>Biaya klaim asuransi akan dibebankan kepada  pihak kedua sesuai dengan aturan main pihak rekanan asuransi.</li>
    </ol>
  </tr>
  <tr>
    <th colspan="3" align="center" valign="top">PASAL 14<br />
    FULL MAINTENANCE</th>
  </tr>
  <tr>
    <td colspan="3" align="justify" valign="top"><ol>
      <li>Pihak Pertama akan melakukan perawatan  berkala kendaraan kepada Pihak Kedua setiap  5000 KM dan seterusnya</li>
      <li>Kerusakan dikarenakan kelalaian oleh Pihak  Kedua, akan menjadi tanggung jawab Pihak Kedua</li>
    </ol>
  </tr>
  <tr>
    <th colspan="3" align="center" valign="top">PASAL 15<br />
    KERAHASIAAN</th>
  </tr>
  <tr>
    <td colspan="3" align="justify" valign="top"><ol>
      <li>PARA  PIHAK wajib menjaga, mencegah pengungkapan, penggunaan dan/atau penyebaran  setiap informasi, dokumen-dokumen rahasia sewa-menyewa, rahasia-rahasia usaha  dan rencana-rencana usaha masing-masing pihak tanpa persetujuan tertulis  terlebih dahulu dari satu Pihak kepada Pihak lainnya maupun sebaliknya, PARA  PIHAK mengakui bahwa semua informasi dan dokumen berdasarkan Perjanjian ini  dipersiapkan khusus oleh PARA PIHAK hanya untuk kepentingan dan pelaksanaan  Perjanjian ini.</li>
      <li>Selama  berlakunya Perjanjian ini dan pada setiap waktu sesudahnya, kecuali bila  disyaratkan lain oleh hukum, maka PARA PIHAK wajib merahasiakan setiap  informasi atau data apapun yang diperoleh/diketahui PARA PIHAK berkaitan dengan  pelaksanaan Perjanjian ini kepada pihak ketiga dan tidak akan menggunakannya  untuk kepentingan pribadi PARA PIHAK atau pihak manapun.</li>
      <li>Ketentuan pada ayat (1) dan (2) pasal ini tidak berlaku  pada :</li>
      <ol>
        <li>informasi yang telah diketahui umum;</li>
        <li>informasi yang telah diketahui oleh pihak penerima  informasi;</li>
        <li>informasi yang dibuka kepada pihak ketiga tanpa  pembatasan oleh PARA PIHAK; dan</li>
        <li>informasi yang dibuka karena ketentuan hukum atau  perintah peraturan perundang-undangan.</li>
      </ol>
      <li>Ketentuan-ketentuan tentang kerahasiaan di atas tetap  berlaku sekalipun Perjanjian ini berakhir atau putus karena sebab apapun juga  dan akan tetap berkekuatan hukum dan berlaku penuh.</li>
    </ol></td>
  </tr>
  <tr>
    <th colspan="3" align="center" valign="top">PASAL 16<br />
    PENYELESAIAN PERSELISIHAN</th>
  </tr>
  <tr>
    <td colspan="3" align="justify" valign="top">Bahwa jika timbul perselisihan sebagai akibat dari tidak terlaksananya  dengan baik isi dari Perjanjian ini dan atau salah menafsirkan dalam hal  pelaksanaannya. Para Pihak sepakat untuk menyelesaikan secara musyawarah  mufakat, jika tidak tercapai kesepakatan diantara para pihak maka akan di  daftarkan melalui  Pengadilan Negeri.</td>
  </tr>
  <tr>
    <th colspan="3" align="center" valign="top">PASAL 17<br />
    ADDENDUM</th>
  </tr>
  <tr>
    <td colspan="3" align="left" valign="top">Hal – hal yang belum cukup diatur didalam isi Perjanjian ini, namun para  pihak memandang perlu untuk mengaturnya maka akan dibicarakan oleh para pihak  dan merupakan bagian yang tidak terpisahkan dari isi Perjanjian ini.<strong></strong></td>
  </tr>
  <tr>
    <th colspan="3" align="center" valign="top">PASAL 18<br />
    KETENTUAN LAIN</th>
  </tr>
  <tr>
    <td colspan="3" align="justify" valign="top"><ol>
  <li>Perjanjian  ini mengikat PARA PIHAK atau wakil-wakil mereka yang sah, para pengganti atau  pihak-pihak yang menerima hak dan kewajiban dari masing-masing pihak karena  sebab apapun dengan memperhatikan peraturan perundang-undangan dan kebijakan  Pemerintah yang berlaku. Perjanjian ini tidak akan berakhir apabila terjadi  perubahan nama, alamat, no. telepon, susunan pemegang saham dan/atau perubahan  susunan pengurus salah satu pihak selama dalam jangka waktu Perjanjian.<br />
    <br />
  </li>
  <li>Apabila  karena suatu perubahan peraturan perundang-undangan atau kebijakan pemerintah  atau keputusan badan peradilan atau arbitrase atau karena alasan apapun, salah  satu atau lebih dari ketentuan dalam Perjanjian ini menjadi atau dinyatakan  tidak sah, tidak mengikat atau tidak dapat dilaksanakan, maka PARA PIHAK setuju  untuk menggantikan ketentuan tersebut dengan ketentuan yang sah, mengikat dan  dapat dilaksanakan yang dari segi tujuan Perjanjian ini dan aspek komersialnya  mempunyai kesamaan dengan ketentuan yang menjadi atau dinyatakan sebagai tidak  sah, tidak mengikat atau tidak dapat dilaksanakan tersebut, hal mana akan  ditetapkan atas persetujuan PARA PIHAK.<br />
    <br />
  </li>
  <li>Setiap lampiran Perjanjian ini merupakan bagian yang integral dan menjadi satu kesatuan  yang tidak dapat dipisahkan dari Perjanjian ini. </li>
    </ol>
<p>Demikian Perjanjian ini dibuat dan ditandatangani oleh  para pihak dalam keadaan sehat jasmani dan rohani, serta tanpa adanya paksaan  dari pihak manapun. Dibuat rangkap 2 (dua) bermaterai cukup serta masing-masing  mempunyai nilai keaslian dan kekuatan hukum yang sama.</p></td>
  </tr>
  <tr>
    <th align="center" valign="top">PIHAK PERTAMA</th>
    <th align="center" valign="top">&nbsp;</th>
    <th align="center" valign="top">PIHAK KEDUA</th>
  </tr>
  <tr>
    <td align="center" valign="top"><strong><?php echo $row_company['perusahaan']; ?></strong></td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top"><strong><?php echo $row_kontrak['nama'];?></strong></td>
  </tr>
  <tr>
    <td align="center" valign="top"><p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    <p><strong><?php echo $row_gudang['sign_kontrak'];?></strong></p></td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top"><p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p><strong><?php echo $row_kontrak['nama2'];?></strong><br />
      </p>      </tr>
  <tr>

    <td align="center" valign="top"><strong>Direktur</strong></td>

    <td width="2%" align="center" valign="top">&nbsp;</td>

    <td align="center" valign="top"><strong><?php echo $row_kontrak['jabatan2'];?></strong></td>

  </tr>
</table>
</body>
</html>