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

mysql_select_db($database_con_gl, $con_gl);

$query_company = "SELECT * FROM gl_company WHERE id = 1";

$company = mysql_query($query_company, $con_gl) or die(mysql_error());

$row_company = mysql_fetch_assoc($company);

$totalRows_company = mysql_num_rows($company);



mysql_select_db($database_con_gl, $con_gl);

$query_kontak = "SELECT gl_rtrans.kontak, gl_kontak.nama, gl_kontak.alamat, gl_kontak.npwp FROM gl_rtrans, gl_kontak WHERE gl_rtrans.no_ref='$_GET[referensi]' AND gl_kontak.id=gl_rtrans.kontak";

$kontak = mysql_query($query_kontak, $con_gl) or die(mysql_error());

$row_kontak = mysql_fetch_assoc($kontak);

$totalRows_kontak = mysql_num_rows($kontak);



mysql_select_db($database_con_gl, $con_gl);

$query_getbrg = "SELECT gl_trans.transaksi, gl_barang.barang FROM gl_trans, gl_barang WHERE gl_trans.no_ref='$_GET[referensi]' AND gl_trans.barang = gl_barang.id ORDER BY gl_trans.id";

$getbrg = mysql_query($query_getbrg, $con_gl) or die(mysql_error());

$row_getbrg = mysql_fetch_assoc($getbrg);

$totalRows_getbrg = mysql_num_rows($getbrg);



mysql_select_db($database_con_gl, $con_gl);

$query_getotal = "SELECT gl_trans.total, gl_trans.diskon, gl_trans.jumlah, gl_trans.hargasatuan FROM gl_trans WHERE gl_trans.no_ref='$_GET[referensi]' AND gl_trans.barang <>'' ORDER BY gl_trans.id";

$getotal = mysql_query($query_getotal, $con_gl) or die(mysql_error());

$row_getotal = mysql_fetch_assoc($getotal);

$totalRows_getotal = mysql_num_rows($getotal);



mysql_select_db($database_con_gl, $con_gl);

$query_getnama = "SELECT gl_admin.link, gl_kontak.nama FROM gl_admin, gl_kontak WHERE gl_admin.username='$_SESSION[admin]' AND gl_kontak.id=gl_admin.link";

$getnama = mysql_query($query_getnama, $con_gl) or die(mysql_error());

$row_getnama = mysql_fetch_assoc($getnama);

$totalRows_getnama = mysql_num_rows($getnama);



mysql_select_db($database_con_gl, $con_gl);

$query_company2 = "SELECT * FROM gl_company WHERE id = 1";

$company2 = mysql_query($query_company2, $con_gl) or die(mysql_error());

$row_company2 = mysql_fetch_assoc($company2);

$totalRows_company2 = mysql_num_rows($company2);



mysql_select_db($database_con_gl, $con_gl);

$query_kontak2 = "SELECT gl_rtrans.kontak, gl_kontak.nama, gl_kontak.alamat, gl_kontak.npwp FROM gl_rtrans, gl_kontak WHERE gl_rtrans.no_ref='$_GET[referensi]' AND gl_kontak.id=gl_rtrans.kontak";

$kontak2 = mysql_query($query_kontak2, $con_gl) or die(mysql_error());

$row_kontak2 = mysql_fetch_assoc($kontak2);

$totalRows_kontak2 = mysql_num_rows($kontak2);



mysql_select_db($database_con_gl, $con_gl);

$query_getbrg2 = "SELECT gl_barang.barang, gl_trans.transaksi FROM gl_trans, gl_barang WHERE gl_trans.no_ref='$_GET[referensi]' AND gl_trans.barang = gl_barang.id ORDER BY gl_trans.id";

$getbrg2 = mysql_query($query_getbrg2, $con_gl) or die(mysql_error());

$row_getbrg2 = mysql_fetch_assoc($getbrg2);

$totalRows_getbrg2 = mysql_num_rows($getbrg2);



mysql_select_db($database_con_gl, $con_gl);

$query_getotal2 = "SELECT gl_trans.total, gl_trans.diskon, gl_trans.jumlah, gl_trans.hargasatuan FROM gl_trans WHERE gl_trans.no_ref='$_GET[referensi]' AND gl_trans.barang <>'' ORDER BY gl_trans.id";

$getotal2 = mysql_query($query_getotal2, $con_gl) or die(mysql_error());

$row_getotal2 = mysql_fetch_assoc($getotal2);

$totalRows_getotal2 = mysql_num_rows($getotal2);



mysql_select_db($database_con_gl, $con_gl);

$query_getnama2 = "SELECT gl_admin.link, gl_kontak.nama FROM gl_admin, gl_kontak WHERE gl_admin.username='$_SESSION[admin]' AND gl_kontak.id=gl_admin.link";

$getnama2 = mysql_query($query_getnama2, $con_gl) or die(mysql_error());

$row_getnama2 = mysql_fetch_assoc($getnama2);

$totalRows_getnama2 = mysql_num_rows($getnama2);



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

        <td width="83%" valign="top"><?php echo $row_company['perusahaan']; ?></td>

      </tr>

      <tr>

        <td align="left" valign="top">Alamat </td>

        <td align="center" valign="top">:</td>

        <td valign="top"><?php echo $row_company['alamat']; ?></td>

      </tr>

      <tr>

        <td align="left" valign="top">NPWP </td>

        <td align="center" valign="top">:</td>

        <td valign="top"><?php echo $row_company['npwp']; ?></td>

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

        <td width="83%" valign="top"><?php echo $row_kontak['nama']; ?></td>

      </tr>

      <tr>

        <td align="left" valign="top">Alamat </td>

        <td align="center" valign="top">:</td>

        <td valign="top"><?php echo $row_kontak['alamat']; ?></td>

      </tr>

      <tr>

        <td align="left" valign="top">NPWP </td>

        <td align="center" valign="top">:</td>

        <td valign="top"><?php echo $row_kontak['npwp']; ?></td>

      </tr>

    </table></td>

  </tr>

  <tr align="center" valign="middle">

    <td style="border:solid 1px #000000;border-top:none;">NO Urut </td>

    <td style="border:solid 1px #000000;border-top:none;border-left:none;">Nama Barang Kena Pajak / Jasa Kena Pajak </td>

    <td style="border:solid 1px #000000;border-top:none;border-left:none;">Harga Jual / Penggantian / Uang Muka / Termin (Rp) </td>

  </tr>

   <?php

  /*Edited by suwondo*/

  $a = "select b.id as jenisid, b.tipekendaraan, c.nopolisi, harga, diskon, total, transaksi from gl_dkontrak a, gl_tipekendaraan b, gl_masterkendaraan c, gl_rtrans d where a.kendaraan = c.nopolisi AND b.id = c.tipekendaraan AND a.kontrak = d.kontrak AND d.no_ref = '$_GET[referensi]' order by a.id"; 

  $b = mysql_query($a) or die (mysql_error());

  while(list($jenisid, $tipekendaraan, $nopolisi, $harga, $diskon, $total, $transaksi) = mysql_fetch_row($b)){

	$jen[] = $jenisid;

	$tipe[] = $tipekendaraan;

	$nopol[] = $nopolisi;

	$hrg[] = $harga;

	$disc[] = $diskon;

	$tot[] = $total;

	$trans[] = $transaksi;

  }

  ?>

  <tr valign="top" style="height:325px;">

    <td style="border:solid 1px #000000;border-top:none;"><ul style="list-style:none;margin:0;padding:0;">

    <?php if(isset($tipe)){ $i=1;

		foreach($tipe as $t){ ?><li style="padding-left:15px;line-height:15px;"><?php echo $i;?></li><?php $i++; } } ?></ul></td>

    <!--<?php //for($i=1;$i<=$totalRows_getbrg;$i++) { ?><li style="padding-left:15px;line-height:15px;"><?php //echo $i;?></li><?php //} ?>-->

	</ul>

	</td>

    <td style="border:solid 1px #000000;border-top:none;border-left:none;"><ul style="list-style:none;margin:0;padding:0;">

           <?php

	 if(isset($tipe)){ $i=0;

		foreach($tipe as $t){

			echo "<li style='font-size:10px'>$t (".$nopol[$i].")</li>"; $i++;

		}

	 }

	 ?>

</ul></td>

    <td align="right" style="border:solid 1px #000000;border-top:none;border-left:none;"><ul style="list-style:none;margin:0;padding:0;line-height:15px;">

        <li><?php $subtotal = 0;

	 if(isset($tot)){ $i=0;

		foreach($tot as $t){

			echo "<li style='font-size10px'>Rp. ".number_format($t,0,',','.')."</li>"; $subtotal += $t; $i++;

		}

	 }

	 ?></ul></td>

  </tr>

  

  <tr>

    <td colspan="2" style="border:solid 1px #000000;border-top:none;">Harga Jual <span style="text-decoration:line-through">/ Penggantian / Uang Muka / Termin</span> * ) </td>

    <td align="right" style="border:solid 1px #000000;border-top:none;border-left:none;"><?php echo number_format($subtotal,0,',','.').",-";?></td>

  </tr>

  <tr>

    <td colspan="2" style="border:solid 1px #000000;border-top:none;">Dikurangi Potongan Harga </td>

    <td align="right" style="border:solid 1px #000000;border-top:none;border-left:none;"><?php echo number_format($diskon,0,',','.').",-";?></td>

  </tr>

  <tr>

    <td colspan="2" style="border:solid 1px #000000;border-top:none;">Dikurangi Uang Muka yang telah diterima </td>

    <td align="right" style="border:solid 1px #000000;border-top:none;border-left:none;">-</td>

  </tr>

  <tr>

    <td colspan="2" style="border:solid 1px #000000;border-top:none;">Dasar Pengenaan Pajak </td>

    <td align="right" style="border:solid 1px #000000;border-top:none;border-left:none;"><?php $dpp = $subtotal - $diskon; echo number_format($dpp,0,',','.').",-";?></td>

  </tr>

  <tr>

    <td colspan="2" style="border:solid 1px #000000;border-top:none;">PPN = 10% x Dasar Pengenaan Pajak </td>

    <td align="right" style="border:solid 1px #000000;border-top:none;border-left:none;"><?php $ppn = intval(10*$dpp/100);echo number_format($ppn,0,',','.').",-";?></td>

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

        <td>Jakarta, <?php tanggal(date("Y/m/d"),"tampilkan");?></td>

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

        <td><?php echo $row_getnama['nama']; ?></td>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>Nama</td>

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

        <td width="83%" valign="top"><?php echo $row_company2['perusahaan']; ?></td>

      </tr>

      <tr>

        <td align="left" valign="top">Alamat </td>

        <td align="center" valign="top">:</td>

        <td valign="top"><?php echo $row_company2['alamat']; ?></td>

      </tr>

      <tr>

        <td align="left" valign="top">NPWP </td>

        <td align="center" valign="top">:</td>

        <td valign="top"><?php echo $row_company2['npwp']; ?></td>

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

        <td width="83%" valign="top"><?php echo $row_kontak2['nama']; ?></td>

      </tr>

      <tr>

        <td align="left" valign="top">Alamat </td>

        <td align="center" valign="top">:</td>

        <td valign="top"><?php echo $row_kontak2['alamat']; ?></td>

      </tr>

      <tr>

        <td align="left" valign="top">NPWP </td>

        <td align="center" valign="top">:</td>

        <td valign="top"><?php echo $row_kontak2['npwp']; ?></td>

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

      <?php for($i=1;$i<=$totalRows_getbrg;$i++) { ?>

      <li style="padding-left:15px;line-height:15px;"><?php echo $i;?></li>

      <?php } ?>

    </ul></td>

    <td style="border:solid 1px #000000;border-top:none;border-left:none;"><ul style="list-style:none;margin:0;padding:0;">

      <?php do { ?>

      <li style="padding-left:15px;"><?php echo $row_getbrg2['barang']; ?> ( <?php echo $row_getbrg2['transaksi']; ?> )</li>

      <?php } while ($row_getbrg2 = mysql_fetch_assoc($getbrg2)); ?>

    </ul></td>

    <td align="right" style="border:solid 1px #000000;border-top:none;border-left:none;"><ul style="list-style:none;margin:0;padding:0;">

      <?php $subtotal = 0; $diskon=0; do { ?>

      <li>

        <?php $subtotal +=$row_getotal2['jumlah']*$row_getotal2['hargasatuan']; echo number_format($subtotal,0,',','.').",-";if($row_getotal2[diskon]<>'') { $diskon += intval($row_getotal2[diskon]*$subtotal/100);}?>

      </li>

      <?php } while ($row_getotal2 = mysql_fetch_assoc($getotal2));?>

    </ul></td>

  </tr>

  <tr>

    <td colspan="2" style="border:solid 1px #000000;border-top:none;">Harga Jual <span style="text-decoration:line-through">/ Penggantian / Uang Muka / Termin</span> * ) </td>

    <td align="right" style="border:solid 1px #000000;border-top:none;border-left:none;"><?php echo number_format($subtotal,0,',','.').",-";?></td>

  </tr>

  <tr>

    <td colspan="2" style="border:solid 1px #000000;border-top:none;">Dikurangi Potongan Harga </td>

    <td align="right" style="border:solid 1px #000000;border-top:none;border-left:none;"><?php echo number_format($diskon,0,',','.').",-";?></td>

  </tr>

  <tr>

    <td colspan="2" style="border:solid 1px #000000;border-top:none;">Dikurangi Uang Muka yang telah diterima </td>

    <td align="right" style="border:solid 1px #000000;border-top:none;border-left:none;">-</td>

  </tr>

  <tr>

    <td colspan="2" style="border:solid 1px #000000;border-top:none;">Dasar Pengenaan Pajak </td>

    <td align="right" style="border:solid 1px #000000;border-top:none;border-left:none;"><?php $dpp = $subtotal - $diskon; echo number_format($dpp,0,',','.').",-";?></td>

  </tr>

  <tr>

    <td colspan="2" style="border:solid 1px #000000;border-top:none;">PPN = 10% x Dasar Pengenaan Pajak </td>

    <td align="right" style="border:solid 1px #000000;border-top:none;border-left:none;"><?php $ppn = intval(10*$dpp/100);echo number_format($ppn,0,',','.').",-";?></td>

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

        <td>Jakarta,

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

        <td><?php echo $row_getnama2['nama']; ?></td>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>Nama</td>

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