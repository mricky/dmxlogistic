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

mysql_select_db($database_con_gl, $con_gl);
$query_adendum = "SELECT * FROM v_adendum_replacement where no ='$_GET[noadendum]'";
$adendum = mysql_query($query_adendum, $con_gl) or die(mysql_error());
$row_adendum = mysql_fetch_assoc($adendum);
//printf($query_adendum);
// get company
mysql_select_db($database_con_gl, $con_gl);
$query_gudang = "SELECT * FROM gl_gudang where id = '$row_adendum[cabang]'";
$gudang = mysql_query($query_gudang, $con_gl) or die(mysql_error());
//print_r($query_gudang);
$row_gudang = mysql_fetch_assoc($gudang);


mysql_select_db($database_con_gl, $con_gl);
$query_kkeluar = "SELECT * FROM gl_kkeluar a where a.noref ='$_GET[kontrak]'";
$kkeluar = mysql_query($query_kkeluar, $con_gl) or die(mysql_error());
$row_kkeluar = mysql_fetch_assoc($kkeluar);

//echo $row_gudang[atasnama];
/*


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
*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Draft Adendum <?php echo $_GET['referensi'];?></title>
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
    <td colspan="4" align="center" valign="top" style="border-bottom:solid 1px #000;"><img src="../images/l_logo.png" alt="mrent" width="148" height="84" hspace="12" align="left" /></td>
    <td align="left" valign="top" style="border-bottom:solid 1px #000;"><p><strong>PT. GLOBAL INDOTRADA</strong> </p>
      <p> Jl. Kyai  Maja No. 7, Mayestik - Kebayoran Baru <br />
        Jakarta Selatan 12130</p>
    <p>Telp: (62-21) 720 4708,  Fax: (62-21) 720 4762</p></td>
  </tr>
  <tr>
    <td colspan="5" align="center" valign="top" style="border-bottom:solid 1px #000;"><strong>PERGANTIAN UNIT SEMENTARA</strong><br />
        NOMOR :<?php echo $_GET['noadendum'];?></td>
  </tr>
  <tr>
    <td colspan="5" align="justify" valign="top">Pada hari ini Jumat 
      <?php   hari(date("l", strtotime($row_kontrak['tgl']))); ?>
      , tanggal 
      <?php tanggal($row_kontrak['tgl'],"tampilkan"); ?>, 
      telah dibuat dan ditandatangani suatu perjanjian Sewa Kendaraan oleh dan antara :
      <ol>
      <li><strong></strong> <?php echo $row_gudang[atasnama];;?> berkedudukan di Bandung, berkantor pusat di  Jakarta Selatan, berkantor cabang di <?php echo $row_gudang[keterangan];?>, yang dalam hal ini diwakili oleh <strong><?php echo $row_gudang['sign_kontrak'];?></strong>, berdasarkan surat Kuasa Direktur utama <?php echo $row_gudang[atasnama];;?>   karenanya berhak dan berwenang bertindak untuk dan atas nama <?php echo $row_gudang[atasnama];;?> nama <?php echo $row_gudang[atasnama];?> yang selanjutnya disebut sebagai <strong>PIHAK PERTAMA</strong>--------------------------------------------------------------------------------------------------------------</li>
      <li><strong></strong><?php echo $row_adendum[atasnama];?>  beralamat <?php echo $row_adendum[alamat];?>, yang dalam hal ini diwakili oleh <?php echo $row_adendum[atasnama];?>  sebagai DIREKTUR , karenanya berhak dan berwenang bertindak untuk dan atas nama <?php echo $row_adendum[atasnama];?>, yang selanjutnya disebut sebagai <strong>PIHAK KEDUA</strong>---------------------------------------------------------------------- </li>
    </ol>
      <p><strong>PIHAK  PERTAMA</strong> dan <strong>PIHAK KEDUA</strong>  (untuk   selanjutnya dalam perjanjian ini di sebut &ldquo;<strong>PARA PIHAK&rdquo;</strong><strong> </strong>) <strong></strong></p>
     
      <ol>
        <li><strong></strong>Bahwa PARA PIHAK tersebut diatas menyetujui untuk membuat Perjanjian Penggantian Unit Sewa Kendaraan (yang selanjutnya disebut sebagai ADENDUM) berdasarkan Perjanjian Sewa Kendaraan yang dibuat antara PT. GLOBAL INDOTRADA dengan <?php echo $row_adendum[atasnama];?> No. <?php echo $row_adendum[no];?> pada tanggal 
          <?php echo $row_adendum['tgl']; ?>
, dengan detail informasi unit kendaraan sebagai berikut :</li>
    </ol></td>    
  </tr>
  <tr>
    <td colspan="5" align="left" valign="top"> <ol start="1" type="1">
        <li>Unit Kendaraan Lama<br />
          <table width="100%" border="1" cellspacing="0" cellpadding="4">
            <tr>
              <th width="5%">NO</th>
              <th>Tipe Kendaraan</th>
              <th width="10%">Tahun</th>
              <th width="12%">No. Polisi</th>
              <th width="20%">No. Rangka</th>
              <th width="20%">No Mesin</th>
              <th width="20%">Keterangan</th>
            </tr>
            <?php $no=1; do { ?>
            <tr valign="top">
              <td align="right"><?php echo $no;$no++;?>.</td>
              <td><?php echo $row_adendum['oldtipe'];?></td>
              <td align="center"><?php echo $row_adendum['oldtahun'];?></td>
              <td align="center"><?php echo $row_adendum['oldnopolisi'];?></td>
              <td align="center"><?php echo $row_adendum['oldnorangka'];?></td>
              <td align="center"><?php echo $row_adendum['oldnomesin'];?></td>
              <td align="left">Telah diserahterimakan  sesuai dengan <strong>BASTK</strong> tanggal <?php echo $row_kkeluar['tgl'];?> Unit <strong><?php echo $row_kkeluar['kendaraan'];?></strong></td>
            </tr>
            <?php }while($row_lkend = mysql_fetch_assoc($lkend)); ?>
          </table>
        </li>
        <li>Unit Kendaraan Baru
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
                <td><?php echo $row_adendum['newtipe'];?></td>
                <td align="center"><?php echo $row_adendum['newtahun'];?></td>
                <td align="center"><?php echo $row_adendum['newnopolisi'];?></td>
                <td align="center"><?php echo $row_adendum['newnorangka'];?></td>
                <td align="center"><?php echo $row_adendum['newnomesin'];?></td>
              </tr>
              <?php }while($row_lkend = mysql_fetch_assoc($lkend)); ?>
          </table>
        </li>
      </ol>
      <p>Selain dari penggantian unit kendaraan, hal-hal lain tetap merujuk kepada surat Perjanjian sewa kendaraan NOMOR : <span style="border-bottom:solid 1px #000;"><?php echo $_GET['kontrak'];?></span><br />
        antara <?php echo $row_adendum[atasnama];?> dalam hal ini bertindak sah atas nama <?php echo $row_gudang[atasnama];;?> dengan DENI APRIANSYAH, dalam hal ini bertindak sah atas nama <?php echo $row_adendum[atasnama];?>. </p>
      <p>Demikian ADDENDUM ini dibuat dan ditandatangani oleh PARA PIHAK sebagai bagian yang tak terpisahkan dari isi Perjanjian Kontrak Sewa Kendaraan sebelumnya.<br />
      </p></td>
  </tr>
  <tr>
    <th colspan="5" align="center" valign="top">&nbsp;</th>
  </tr>
  <tr>
    <th colspan="2" align="center" valign="top">PIHAK PERTAMA</th>
    <th align="center" valign="top">&nbsp;</th>
    <th colspan="2" align="center" valign="top">PIHAK KEDUA</th>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top"><?php echo $row_gudang[atasnama];;?></td>
    <td align="center" valign="top">&nbsp;</td>
    <td colspan="2" align="center" valign="top"><strong><?php echo $row_kontrak['nama'];?></strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top"><p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p><strong><?php echo $row_gudang['sign_kontrak'];?></strong></p>
      <p><?php echo $row_gudang['jabatan'];?></p>
      
    </p></td>
    <td align="center" valign="top">&nbsp;</td>
    <td colspan="2" align="center" valign="top"><p><br />
      <br />
      <br />
      <br />
      </p>
      <p>&nbsp;</p>
      <p><?php echo $row_adendum[nama];?><br />
      </p>      </tr>
  <tr>

    <td width="18%" align="center" valign="top">&nbsp;</td>

    <td width="20%" align="center" valign="top">&nbsp;</td>

    <td width="2%" align="center" valign="top">&nbsp;</td>

    <td width="2%" align="center" valign="top">&nbsp;</td>

    <td width="58%" align="center" valign="top">&nbsp;</td>

  </tr>
</table>
</body>
</html>