<?php require_once('../connections/con_gl.php'); ?>

<?php

//session_start();

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

// get company
mysql_select_db($database_con_gl, $con_gl);
$query_gudang = "SELECT * FROM gl_gudang where id = '$_SESSION[cabang_id]'";
$gudang = mysql_query($query_gudang, $con_gl) or die(mysql_error());
$row_gudang = mysql_fetch_assoc($gudang);


// get STT
mysql_select_db($database_con_gl, $con_gl);
$query_stt = "SELECT * FROM v_detailstt a inner join customer b on(a.IDCUSTOMER = b.IDCUSTOMER) where IDSTT = '$_GET[id]'";
$stt = mysql_query($query_stt, $con_gl) or die(mysql_error());
$row_stt = mysql_fetch_assoc($stt);
//printf($query_stt);




?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Faktur Pajak No Referensi : <?php echo $_GET[referensi];?></title>

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

</style>

</head>



<body>

<table width="710" border="0" align="center" cellpadding="4" cellspacing="0">

  <tr valign="top">

    <td width="4%">&nbsp;</td>

    <td width="70%" align="right">Lembar ke 1 : <br /></td>

    <td width="26%">Untuk Penjual BKP / Pemberi JKP <br />

    Sebagai bukti Pajak Keluaran </td>

  </tr>

  <tr>

    <td colspan="3" align="center"><h3>Faktur Pajak </h3></td>

  </tr>

  <tr>

    <td colspan="3">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="3" style="border:solid 1px #000000;border-bottom:none;">Kode dan Nomor Seri Faktur Pajak : </td>

  </tr>

  <tr>

    <td colspan="3" style="border:solid 1px #000000;border-bottom:none;">Pengusaha Kena Pajak : </td>

  </tr>

  <tr>

    <td colspan="3" style="border:solid 1px #000000;border-bottom:none;"><table width="100%" border="0" cellspacing="0" cellpadding="2">

      <tr>

        <td width="15%" align="left" valign="top">Nama</td>

        <td width="2%" align="center" valign="top">:</td>

        <td width="83%" valign="top"><?php echo $row_gudang['pajak_pt']; ?></td>

      </tr>

      <tr>

        <td align="left" valign="top">Alamat </td>

        <td align="center" valign="top">:</td>

        <td valign="top"><?php echo $row_gudang['pajak_alamat']; ?></td>

      </tr>

      <tr>

        <td align="left" valign="top">NPWP </td>

        <td align="center" valign="top">:</td>

        <td valign="top"><?php echo $row_gudang['pajak_npwp']; ?></td>

      </tr>

    </table></td>

  </tr>

  <tr>

    <td colspan="3" style="border:solid 1px #000000;border-bottom:none;">Pembeli Barang Kena Pajak / Penerima Jasa Kena Pajak : </td>

  </tr>

  <tr>

    <td colspan="3" style="border:solid 1px #000000;border-tops:none;"><table width="100%" border="0" cellspacing="0" cellpadding="2">

      <tr>

        <td width="15%" align="left" valign="top">Nama</td>

        <td width="2%" align="center" valign="top">:</td>

        <td width="83%" valign="top"><?php echo $row_stt['NAMACUSTOMER']; ?></td>
      </tr>

      <tr>

        <td align="left" valign="top">Alamat </td>

        <td align="center" valign="top">:</td>

        <td valign="top"><?php echo $row_stt['ALAMAT']; ?></td>
      </tr>

      <tr>

        <td align="left" valign="top">NPWP </td>

        <td align="center" valign="top">:</td>

        <td valign="top"><?php echo ""; ?></td>
      </tr>

    </table></td>

  </tr>

  <tr align="center" valign="middle">

    <td style="border:solid 1px #000000;border-top:none;">NO Urut </td>

    <td style="border:solid 1px #000000;border-top:none;border-left:none;">Nama Barang Kena Pajak / Jasa Kena Pajak </td>

    <td style="border:solid 1px #000000;border-top:none;border-left:none;">Harga Jual / Penggantian / Uang Muka / Termin (Rp) </td>

  </tr>

  <tr valign="top" style="height:325px;">

    <td style="border:solid 1px #000000;border-top:none;"><ul style="list-style:none;margin:0;padding:0;">

      <li style="padding-left:15px;line-height:15px;">1</li></ul></td>

    <td style="border:solid 1px #000000;border-top:none;border-left:none;">Pengiriman Barang dengan Layanan <?php echo $row_stt['NAMALAYANAN']; ?> Armada <?php echo $row_stt['NAMAJNSKIRIM']; ?> ASAL <?php echo $row_stt['KOTAASAL']; ?> TUJUAN <?php echo $row_stt['kotatujuan']; ?></td>
    <td align="right" style="border:solid 1px #000000;border-top:none;border-left:none;"><ul style="list-style:none;margin:0;padding:0;line-height:15px;">

    

        <li><?php echo number_format($row_stt['SUBTOTAL'],0,',','.').",-";?></li>

    </ul></td>

  </tr>

  <tr>

    <td colspan="2" style="border:solid 1px #000000;border-top:none;">Harga Jual <span style="text-decoration:line-through">/ Penggantian / Uang Muka / Termin</span> * ) </td>

    <td align="right" style="border:solid 1px #000000;border-top:none;border-left:none;">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="2" style="border:solid 1px #000000;border-top:none;">Dikurangi Potongan Harga </td>

    <td align="right" style="border:solid 1px #000000;border-top:none;border-left:none;">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="2" style="border:solid 1px #000000;border-top:none;">Dikurangi Uang Muka yang telah diterima </td>

    <td align="right" style="border:solid 1px #000000;border-top:none;border-left:none;">-</td>

  </tr>

  <tr>

    <td colspan="2" style="border:solid 1px #000000;border-top:none;">Dasar Pengenaan Pajak </td>

    <td align="right" style="border:solid 1px #000000;border-top:none;border-left:none;">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="2" style="border:solid 1px #000000;border-top:none;">PPN = 10% x Dasar Pengenaan Pajak </td>

    <td align="right" style="border:solid 1px #000000;border-top:none;border-left:none;"><?php echo number_format($row_stt['PPN'],0,',','.').",-";?></td>

  </tr>

  <tr>

    <td colspan="3" style="border-left:solid 1px #000000;border-right:solid 1px #000000">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="3" style="border-left:solid 1px #000000;border-right:solid 1px #000000">Pajak Penjualan Atas Barang Mewah </td>

  </tr>

  <tr>

    <td colspan="3" style="border-left:solid 1px #000000;border-right:solid 1px #000000"><table width="100%" border="0" cellspacing="0" cellpadding="4">

      <tr>

        <td width="8%" align="center" style="border:solid 1px #000000;">Tarif</td>

        <td width="15%" align="center" style="border:solid 1px #000000;border-left:none;border-right:none;">DPP</td>

        <td width="15%" align="center" style="border:solid 1px #000000;">PPn BM </td>

        <td width="12%">&nbsp;</td>

        <td width="42%">&nbsp;</td>

        <td width="8%">&nbsp;</td>

      </tr>

      <tr>

        <td style="border:solid 1px #000000;border-top:none;">.......% </td>

        <td style="border:solid 1px #000000;border-top:none;border-left:none;">Rp. </td>

        <td style="border:solid 1px #000000;border-top:none;border-left:none;">Rp..............................</td>

        <td>&nbsp;</td>

        <td>Bandung,          
          <?php tanggal(date("Y/m/d"),"tampilkan");?></td>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td style="border:solid 1px #000000;border-top:none;">.......% </td>

        <td style="border:solid 1px #000000;border-top:none;border-left:none;">Rp..............................</td>

        <td style="border:solid 1px #000000;border-top:none;border-left:none;">Rp..............................</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td style="border:solid 1px #000000;border-top:none;">.......% </td>

        <td style="border:solid 1px #000000;border-top:none;border-left:none;">Rp..............................</td>

        <td style="border:solid 1px #000000;border-top:none;border-left:none;">Rp..............................</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td style="border:solid 1px #000000;border-top:none;">.......% </td>

        <td style="border:solid 1px #000000;border-top:none;border-left:none;">Rp..............................</td>

        <td style="border:solid 1px #000000;border-top:none;border-left:none;">Rp..............................</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td colspan="2" style="border:solid 1px #000000;border-top:none;">Jumlah</td>

        <td style="border:solid 1px #000000;border-top:none;border-left:none;">Rp..............................</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

      </tr>

    </table></td>

  </tr>

  <!--<tr>

    <td colspan="3" style="border:solid 1px #000000;border-top:none;border-bottom:none;">&nbsp;</td>

  </tr>-->

  <tr>

    <td colspan="3" style="border:solid 1px #000000;border-top:none;border-bottoms:none;">&nbsp;</td>

  </tr>

</table>

*) Coret yang tidak perlu<br /><br /><br />

<table width="710" border="0" align="center" cellpadding="4" cellspacing="0">

  <tr valign="top">

    <td width="4%">&nbsp;</td>

    <td width="70%" align="right">Lembar ke 2 : <br /></td>

    <td width="26%">Untuk Pembeli BKP/Penerima JKP sebagai bukti Pajak Masukan</td>

  </tr>

  <tr>

    <td colspan="3" align="center"><h3>Faktur Pajak </h3></td>

  </tr>

  <tr>

    <td colspan="3">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="3" style="border:solid 1px #000000;border-bottom:none;">Kode dan Nomor Seri Faktur Pajak : </td>

  </tr>

  <tr>

    <td colspan="3" style="border:solid 1px #000000;border-bottom:none;">Pengusaha Kena Pajak : </td>

  </tr>

  <tr>

    <td colspan="3" style="border:solid 1px #000000;border-bottom:none;"><table width="100%" border="0" cellspacing="0" cellpadding="2">

      <tr>

        <td width="15%" align="left" valign="top">Nama</td>

        <td width="2%" align="center" valign="top">:</td>

        <td width="83%" valign="top"><?php echo $row_gudang['pajak_pt']; ?></td>

      </tr>

      <tr>

        <td align="left" valign="top">Alamat </td>

        <td align="center" valign="top">:</td>

        <td valign="top"><?php echo $row_gudang['pajak_alamat']; ?></td>

      </tr>

      <tr>

        <td align="left" valign="top">NPWP </td>

        <td align="center" valign="top">:</td>

        <td valign="top"><?php echo $row_gudang['pajak_npwp']; ?></td>

      </tr>

    </table></td>

  </tr>

  <tr>

    <td colspan="3" style="border:solid 1px #000000;border-bottom:none;">Pembeli Barang Kena Pajak / Penerima Jasa Kena Pajak : </td>

  </tr>

  <tr>

    <td colspan="3" style="border:solid 1px #000000;border-tops:none;"><table width="100%" border="0" cellspacing="0" cellpadding="2">

      <tr>

        <td width="15%" align="left" valign="top">Nama</td>

        <td width="2%" align="center" valign="top">:</td>

        <td width="83%" valign="top"><?php echo $row_stt['NAMACUSTOMER']; ?></td>

      </tr>

      <tr>

        <td align="left" valign="top">Alamat </td>

        <td align="center" valign="top">:</td>

        <td valign="top"><?php echo $row_stt['ALAMAT']; ?></td>

      </tr>

      <tr>

        <td align="left" valign="top">NPWP </td>

        <td align="center" valign="top">:</td>

        <td valign="top">&nbsp;</td>

      </tr>

    </table></td>

  </tr>

  <tr align="center" valign="middle">

    <td style="border:solid 1px #000000;border-top:none;">NO Urut </td>

    <td style="border:solid 1px #000000;border-top:none;border-left:none;">Nama Barang Kena Pajak / Jasa Kena Pajak </td>

    <td style="border:solid 1px #000000;border-top:none;border-left:none;">Harga Jual / Penggantian / Uang Muka / Termin (Rp) </td>

  </tr>

  <tr valign="top" style="height:325px;">

    <td style="border:solid 1px #000000;border-top:none;"><ul style="list-style:none;margin:0;padding:0;">

      <li style="padding-left:15px;line-height:15px;">1</li>

    </ul></td>

    <td style="border:solid 1px #000000;border-top:none;border-left:none;"><ul style="list-style:none;margin:0;padding:0;"><MM_REPEATEDREGION SOURCE="@@rs@@"></MM_REPEATEDREGION>

      <li style="padding-left:15px;line-height:15px;">Pengiriman Barang dengan Layanan <?php echo $row_stt['NAMALAYANAN']; ?> Armada <?php echo $row_stt['NAMAJNSKIRIM']; ?> ASAL <?php echo $row_stt['KOTAASAL']; ?> TUJUAN <?php echo $row_stt['kotatujuan']; ?></li>

      <MM_REPEATEDREGION SOURCE="@@rs@@"></MM_REPEATEDREGION>
    </ul></td>

    <td align="right" style="border:solid 1px #000000;border-top:none;border-left:none;"><ul style="list-style:none;margin:0;padding:0;">

       <li><?php echo number_format($row_stt['SUBTOTAL'],0,',','.').",-";?></li>

     

    </ul></td>

  </tr>

  <tr>

    <td colspan="2" style="border:solid 1px #000000;border-top:none;">Harga Jual <span style="text-decoration:line-through">/ Penggantian / Uang Muka / Termin</span> * ) </td>

    <td align="right" style="border:solid 1px #000000;border-top:none;border-left:none;"><?php echo number_format($row_stt['SUBTOTAL'],0,',','.').",-";?></td>

  </tr>

  <tr>

    <td colspan="2" style="border:solid 1px #000000;border-top:none;">Dikurangi Potongan Harga </td>

    <td align="right" style="border:solid 1px #000000;border-top:none;border-left:none;">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="2" style="border:solid 1px #000000;border-top:none;">Dikurangi Uang Muka yang telah diterima </td>

    <td align="right" style="border:solid 1px #000000;border-top:none;border-left:none;">-</td>

  </tr>

  <tr>

    <td colspan="2" style="border:solid 1px #000000;border-top:none;">Dasar Pengenaan Pajak </td>

    <td align="right" style="border:solid 1px #000000;border-top:none;border-left:none;">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="2" style="border:solid 1px #000000;border-top:none;">PPN = 10% x Dasar Pengenaan Pajak </td>

    <td align="right" style="border:solid 1px #000000;border-top:none;border-left:none;"><?php echo number_format($row_stt['PPN'],0,',','.').",-";?></td>

  </tr>

  <tr>

    <td colspan="3" style="border-left:solid 1px #000000;border-right:solid 1px #000000">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="3" style="border-left:solid 1px #000000;border-right:solid 1px #000000">Pajak Penjualan Atas Barang Mewah </td>

  </tr>

  <tr>

    <td colspan="3" style="border-left:solid 1px #000000;border-right:solid 1px #000000"><table width="100%" border="0" cellspacing="0" cellpadding="4">

      <tr>

        <td width="8%" align="center" style="border:solid 1px #000000;">Tarif</td>

        <td width="15%" align="center" style="border:solid 1px #000000;border-left:none;border-right:none;">DPP</td>

        <td width="15%" align="center" style="border:solid 1px #000000;">PPn BM </td>

        <td width="12%">&nbsp;</td>

        <td width="42%">&nbsp;</td>

        <td width="8%">&nbsp;</td>

      </tr>

      <tr>

        <td style="border:solid 1px #000000;border-top:none;">.......% </td>

        <td style="border:solid 1px #000000;border-top:none;border-left:none;">Rp..............................</td>

        <td style="border:solid 1px #000000;border-top:none;border-left:none;">Rp..............................</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td style="border:solid 1px #000000;border-top:none;">.......% </td>

        <td style="border:solid 1px #000000;border-top:none;border-left:none;">Rp..............................</td>

        <td style="border:solid 1px #000000;border-top:none;border-left:none;">Rp..............................</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td style="border:solid 1px #000000;border-top:none;">.......% </td>

        <td style="border:solid 1px #000000;border-top:none;border-left:none;">Rp..............................</td>

        <td style="border:solid 1px #000000;border-top:none;border-left:none;">Rp..............................</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td style="border:solid 1px #000000;border-top:none;">.......% </td>

        <td style="border:solid 1px #000000;border-top:none;border-left:none;">Rp..............................</td>

        <td style="border:solid 1px #000000;border-top:none;border-left:none;">Rp..............................</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td colspan="2" style="border:solid 1px #000000;border-top:none;">Jumlah</td>

        <td style="border:solid 1px #000000;border-top:none;border-left:none;">Rp..............................</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>Manager Pajak</td>

        <td>&nbsp;</td>

      </tr>

    </table></td>

  </tr>

  <!--<tr>

    <td colspan="3" style="border:solid 1px #000000;border-top:none;border-bottom:none;">&nbsp;</td>

  </tr>-->

  <tr>

    <td colspan="3" style="border:solid 1px #000000;border-top:none;border-bottoms:none;">&nbsp;</td>

  </tr>

</table>

*) Coret yang tidak perlu<br />

</body>

</html>