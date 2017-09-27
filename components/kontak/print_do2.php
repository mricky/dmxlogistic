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

if($_REQUEST['tipecust']=='R'){
//Ini untuk query cust. retail
mysql_select_db($database_con_gl, $con_gl);
$query_status = "select * from v_kasir where no_ref = '$_GET[noreferensi]'";
$status = mysql_query($query_status, $con_gl) or die(mysql_error());
$row_status = mysql_fetch_assoc($status);

$query_brg = "SELECT gl_masterkendaraan.nopolisi, gl_merkkendaraan.merk, gl_tipekendaraan.tipekendaraan,gl_detailtrans.ppn,gl_detailtrans.pph, gl_detailtrans.hargasatuan, gl_detailtrans.diskon, gl_detailtrans.diskonamount FROM gl_detailtrans, gl_masterkendaraan, gl_tipekendaraan, gl_merkkendaraan WHERE gl_detailtrans.no_ref='$_GET[noreferensi]' AND gl_detailtrans.kendaraan = gl_masterkendaraan.nopolisi AND gl_merkkendaraan.id = gl_masterkendaraan.merk AND gl_tipekendaraan.id = gl_masterkendaraan.tipekendaraan";
printf($query_brg);
$brg = mysql_query($query_brg, $con_gl) or die(mysql_error());

$row_brg = mysql_fetch_assoc($brg);
$jumlah = $row_brg['jumlah']; if($jumlah == 0) $jumlah=1;
$totalRows_brg = mysql_num_rows($brg);

$query_data = "select a.id, a.tgl, a.noref, a.info, g.nama, b.nopolisi, b.tahun, b.norangka, b.nomesin, c.tipekendaraan, d.jmlhr, d.jmlwkt, f.barang, e.merk, d.tujuan, d.kontak, d.checkin, d.waktucheckin, d.checkout, d.waktucheckout, d.bbm, d.tol, d.supir, d.parkir, d.akomod, d.other, h.hargasatuan, h.diskon, h.diskonamount, h.ppn from gl_kkeluar a, gl_masterkendaraan b, gl_tipekendaraan c, gl_retailtrans d, gl_merkkendaraan e, gl_barang f, gl_kontak g, gl_detailtrans h where a.id='$_GET[id]' AND a.kendaraan = b.nopolisi AND b.tipekendaraan = c.id AND b.merk = e.id AND a.noref = d.no_ref AND f.id=d.barang AND g.id=a.driver AND. d.no_ref=h.no_ref AND f.id=h.barang";
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

<table width="821" border="1" align="center" cellpadding="6" cellspacing="0" style="border:solid 1px #000000;">

  <tr>
    <td width="805" colspan="5" align="center" valign="top"><h5>MOTORAVE CAR RENTAL</h5>
      <h5>SURAT PERINTAH JALAN (SPJ) </h5></td>
  </tr>
  <tr>
    <td colspan="5" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td colspan="4"><p>KENDARAAN KELUAR</p></td>
        <td colspan="4" >KENDARAAN MASUK  </td>
        </tr>
      <tr>
        <td width="15%">Fuel</td>
        <td width="1%" align="center">:</td>
        <td colspan="2" valign="top"> <input name="ada" type="checkbox" id="ada" value="" />
          E  
             <input name="ada2" type="checkbox" id="ada2" value="" />
          1/8 
          <input name="ada3" type="checkbox" id="ada3" value="" /> 
          1/4 
          <input name="ada4" type="checkbox" id="ada4" value="" /> 
          1/2 
          <input name="ada5" type="checkbox" id="ada5" value="" /> 
          3/4 
          <input name="ada6" type="checkbox" id="ada6" value="" /> 
          F </td>
        <td width="17%" valign="top">Fuel</td>
        <td width="1%" valign="top">:</td>
        <td colspan="2" valign="top"><input name="ada7" type="checkbox" id="ada7" value="" />
          E 
            <input name="ada8" type="checkbox" id="ada8" value="" /> 
          1/8 
          <input name="ada9" type="checkbox" id="ada9" value="" /> 
          1/4 
          <input name="ada10" type="checkbox" id="ada10" value="" /> 
          1/2 
          <input name="ada11" type="checkbox" id="ada11" value="" /> 
          3/4 
          <input name="ada12" type="checkbox" id="ada12" value="" /> 
          F </td>
      </tr>
      
      <tr>
        <td>KM</td>
        <td align="center">:</td>
        <td colspan="2" valign="top"><input name="kmawal" type="text" id="kmawal" size="10" maxlength="10" /></td>
        <td valign="top">KM</td>
        <td valign="top">:</td>
        <td colspan="2" valign="top"><input name="kmakhir" type="text" id="kmakhir" size="10" maxlength="10" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td colspan="2" valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
        <td colspan="2" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="8"><div align="center"><strong>INFORMASI DATA PELANGGAN</strong></div></td>
        </tr>
      <tr>
        <td>Nama</td>
        <td align="center">:</td>
        <td colspan="2" valign="top"><?php echo $row_cust['nama'];?></td>
        <td valign="top">Pekerjaan  </td>
        <td valign="top">:</td>
        <td colspan="2" valign="top">&nbsp;</td>
        </tr>
      <tr>
        <td>Alamat</td>
        <td align="center">:</td>
        <td colspan="2" valign="top"><?php echo $row_cust['alamat'];?></td>
        <td valign="top">Kota Tujuan </td>
        <td valign="top">:</td>
        <td colspan="2" valign="top"><?php echo $row_data['tujuan'];?></td>
        </tr>
      <tr>
        <td>No. Telp</td>
        <td align="center">:</td>
        <td colspan="2" valign="top"><?php echo $row_cust['tlp'];?></td>
        <td valign="top">&nbsp;</td>
        <td valign="top">:</td>
        <td colspan="2" valign="top">&nbsp;</td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="8"><strong>DALAM KEADAAN DARURAT SIAPA YANG DAPAT/HARUS DIHUBUNGI SELAIN KELUARGA SERUMAH (WAJIB DIISI) </strong></td>
      </tr>
      <tr>
        <td>Nama</td>
        <td align="center">:</td>
        <td colspan="2"><?php echo $row_cust['nama1'];?></td>
        <td>Nama</td>
        <td>:</td>
        <td colspan="2"><?php echo $row_cust['nama2'];?></td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td align="center">:</td>
        <td colspan="2"><?php echo $row_cust['alamat1'];?></td>
        <td>Alamat</td>
        <td>:</td>
        <td colspan="2"><?php echo $row_cust['alamat2'];?></td>
      </tr>
      <tr>
        <td>Telepon</td>
        <td align="center">:</td>
        <td colspan="2"><?php echo $row_cust['tlp1'];?></td>
        <td>Telepon</td>
        <td>:</td>
        <td colspan="2"><?php echo $row_cust['tlp2'];?></td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4"><div align="center"><strong>DIISI OLEH BAGIAN MARKETING</strong></div></td>
        <td colspan="4"><div align="center"><strong>PERINCIAN BIAYA</strong></div></td>
        </tr>
      <tr>
        <td>Paket Sewa</td>
        <td align="center">:</td>
        <td colspan="2" valign="top"><?php echo $row_data['barang'];?></td>
        <td valign="top">Sewa Kendaraan </td>
        <td valign="top">:</td>
        <td width="22%" valign="top"><div align="right"><?php echo number_format ($row_data['hargasatuan'] * $row_data['jmlhr'],0,',','.');?>,-</div></td>
        <td width="11%" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td>Tipe</td>
        <td align="center">:</td>
        <td colspan="2" valign="top"><?php echo $row_data['tipekendaraan'];?></td>
        <td valign="top">Discount</td>
        <td valign="top">:</td>
        <td valign="top"><div align="right"><?php echo number_format ($row_data['diskonamount'],0,',','.');?>,-</div>
          </div></td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td>Merk</td>
        <td align="center">:</td>
        <td colspan="2" valign="top"><?php echo $row_data['merk'];?></td>
        <td valign="top">Biaya Oprasional</td>
        <td valign="top">:</td>
        <td valign="top"><div align="right"><?php echo number_format($row_getopr['biayaops'],0,',','.');?>,- </div></td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td>No. Polisi</td>
        <td align="center">:</td>
        <td colspan="2" valign="top"><?php echo $row_data['nopolisi'];?></td>
        <td valign="top">Deposit</td>
        <td>:</td>
        <td><div align="right">0,-</div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Nama Supir </td>
        <td align="center">:</td>
        <td colspan="2"><?php echo $row_data['nama'];?></td>
        <td valign="top">Uang Muka </td>
        <td>:</td>
        <td><div align="right">0,-</div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Lama Sewa </td>
        <td align="center">:</td>
        <td colspan="2" valign="top"><?php echo $row_data['jmlhr'];?>hari - <?php echo $row_data['jmlwkt'];?> jam </td>
        <td valign="top">Denda</td>
        <td valign="top">:</td>
        <td valign="top"><div align="right">0,-</div></td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td>Tanggal Sewa </td>
        <td align="center">:</td>
        <td colspan="2" valign="top"><?php tanggal($row_data['checkin'],"tampilkan"); ?>
          - 
          <?php tanggal($row_data['checkout'],"tampilkan"); ?></td>
        <td valign="top">PPN</td>
        <td valign="top">:</td>
        <td valign="top"><div align="right">
        <div align="right"><?php echo number_format($row_data['ppn'],0,',','.');?>,-</div>
        </div></td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td>Keluar Jam </td>
        <td align="center">:</td>
        <td valign="top"><?php echo $row_data['waktucheckout'];?></td>
        <td width="17%" valign="top">&nbsp;</td>
        <td valign="top">TOTAL TAGIHAN</td>
        <td valign="top">:</td>
        <td valign="top"><div align="right"><?php  echo number_format($row_status['totalsewa'],0,',','.');?>,-</div></td>
        <td valign="top">&nbsp;</td>
      </tr>
      
      <tr>
        <td colspan="8">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="8">1. DENDA KETERLAMBATAN  : A. CHARTER  10% PERJAM&nbsp;&nbsp;&nbsp; B. RENTAL 3% PERHARI</td>
      </tr>
      <tr>
        <td colspan="8">2. PEMBATALAN  PESANA : A. DENGAN UANG MUKA, MAKA UANG MUKA YANG SUDAH  DIBAYARKAN TIDAK DAPAT DIKEMBALIKAN TAPI AKAN DIGANTI DENGAN VOUCER ATAU DENDA  25%</td>
      </tr>
      <tr>
        <td colspan="3">1. DENDA KETERLAMBATAN</td>
        <td colspan="5">A. CHARTER  10% PERJAM&nbsp;&nbsp;&nbsp; B. RENTAL 3% PERHARI</td>
        </tr>
      <tr>
        <td colspan="3">2. PEMBATALAN PESANAN</td>
        <td colspan="5">A. DENGAN UANG MUKA, MAKA UANG MUKA YANG SUDAH  DIBAYARKAN TIDAK DAPAT</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td width="16%">&nbsp;</td>
        <td colspan="5">DIBAYARKAN  TIDAK DAPAT DIKEMBALIKAN TAPI AKAN DIGANTI DENGAN VOUCER ATAU DENDA 25%</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="5">B. TANPA  UANG MUKA MAKA AKAN DIKENAKAN DENDA SEBESAR Rp. 100.00,- (SERATUS RIBU RUPIAH)</td>
        </tr>
      
      <tr>
        <td colspan="8">3. DALAM  KEADAAN DARURAT PIHAK MRENT DAPAT MENUKAR KENDARAAN YANG TELAH DIPESAN  DENGAN KENDARAAN PENGGANTI TANPA PEMBERITAHUAN TERLEBIH DAHULU</td>
      </tr>
      <tr>
        <td colspan="8">4. KLAIM  KERUGIAN YANG DIAKIBATKAN OLEH KERUSAKAN KENDARAAN MAKSIMAL SENILAI HARGA  SEWA/SISA SEWA</td>
      </tr>
      <tr>
        <td colspan="8">5. KEHILANGAN  / KERUSAHAKAN BARANG SELAMA DALAM PERJALANAN DILUAR TANGGUNG JAWAB MOTORAVE CAR RENT</td>
      </tr>
      <tr>
        <td colspan="8">6. SELURUH  PENUMPANG TELAH DIASURANSIKAN PADA PT ASURANSI JASA RAHARJA PUTERA</td>
      </tr>
      <tr>
        <td colspan="8">7. DRIVER  / PIHAK MRENT BERHAK UNTUK MEMBATALKAN SEWA, APABILA KONSUMEN DIANGGAP  TIDAK MEMENUHI SYARAT</td>
      </tr>
      <tr>
        <td colspan="8">8. PENYEWA  DILARANG MEMBERI APAPUN KEPADA DRIVER, KECUALI BIAYA SEWA DIATAS DAN UANG TIP</td>
      </tr>
      <tr>
        <td colspan="8">9. PENYEWA  TIDAK DIBERNARKAN MERUBAH KOTA TUJUAN / MEMPERPANJANG WAKTU SEWA YANG TELAH  DISEPAKATI BERSAMA</td>
      </tr>
      <tr>
        <td colspan="8">10.UANG  SEWA WAJIB DIBAYAR 100% DIMUKA, DAPAT DIBAYARKAN LANGSUNG KEPADA DRIVER ATAU  DITRANSFER MELALUI PT. GLOBAL MANDIRI AUTONUSA</td>
      </tr>
      
      <tr>
        <td colspan="8">&nbsp;</td>
        </tr>
      
    </table></td>
  </tr>
  <tr>
    <td colspan="5" align="left" valign="top"><table width="100%" border="1" cellspacing="0" cellpadding="2">
      <tr>
        <td width="24%" align="center"><strong>Penerima / Penyewa</strong></td>
        <td width="26%" align="center"><strong>Admin Staff</strong></td>
        <td width="24%" align="center"><strong>Branch Manager</strong></td>
        <td width="26%" align="center"><strong>Driver</strong></td>
      </tr>
      <tr align="center" valign="bottom">
        <td height="65"><?php echo $row_cust['nama'];?></td>
        <td height="65"><?php echo $_SESSION[nama];?></td>
        <td height="65">&nbsp;</td>
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