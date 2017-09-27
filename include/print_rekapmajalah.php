<?php require_once('../connections/con_gl.php'); ?>
<?php
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
$currentPage = $_SERVER["PHP_SELF"];
$startRow_data = $pageNum_data * $maxRows_data;
mysql_select_db($database_con_gl, $con_gl);
$query_data = "SELECT sum(gl_trans.total) as total, gl_rtrans.kontak, gl_kontak.nama FROM gl_rtrans, gl_trans, gl_kontak WHERE gl_kontak.id=gl_rtrans.kontak AND gl_rtrans.no_ref = gl_trans.no_ref AND gl_trans.pos='K' AND gl_trans.x_ref is NULL AND gl_trans.barang='$_GET[barang]'";
if($_GET[mulai]<>'' AND $_GET[sampai]<>'') {
$query_data .=" AND gl_rtrans.tgl between '$_POST[mulai]' AND '$_POST[sampai]'";
}
if($_GET[agen]<>'' AND $_GET[agen]<>'ALL') {
$query_data .=" AND gl_rtrans.kontak='$_GET[agen]'";
}
$query_data .=" group by gl_kontak.nama asc";
$data = mysql_query($query_data, $con_gl) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);

mysql_select_db($database_con_gl, $con_gl);
$query_agen = "SELECT gl_kontak.id, gl_kontak.nama FROM gl_kontak ORDER BY gl_kontak.nama";
$agen = mysql_query($query_agen, $con_gl) or die(mysql_error());
$row_agen = mysql_fetch_assoc($agen);
$totalRows_agen = mysql_num_rows($agen);

$colname_getagen = "-1";
if (isset($_GET['barang'])) {
  $colname_getagen = (get_magic_quotes_gpc()) ? $_GET['barang'] : addslashes($_GET['barang']);
}
mysql_select_db($database_con_gl, $con_gl);
$query_getagen = sprintf("SELECT barang FROM gl_barang WHERE id = %s", $colname_getagen);
$getagen = mysql_query($query_getagen, $con_gl) or die(mysql_error());
$row_getagen = mysql_fetch_assoc($getagen);
$totalRows_getagen = mysql_num_rows($getagen);

mysql_select_db($database_con_gl, $con_gl);
$query_company = "SELECT * FROM gl_company WHERE id = 1";
$company = mysql_query($query_company, $con_gl) or die(mysql_error());
$row_company = mysql_fetch_assoc($company);
$totalRows_company = mysql_num_rows($company);
?><title>Cetak Rekap Penjualan : <?php echo $row_getagen['barang']; ?></title>
<style media="all">
table tr td, .buttonprint, .note {
font-size:11px;
font-family:Verdana, Arial, Helvetica, sans-serif;
color:#000000;
border-bottom:none;
}
table th {
font-family:Verdana, Arial, Helvetica, sans-serif;
color:white;
font-size:12px;
font-weight:bold;
}
table tr td.border {
border:solid 1px #1A4D80;
border-top:none;
border-left:none;
}
</style>
<style media="print">
.buttonprint, .note {
display:none;
}
</style>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable"> 
  <tr align="right">
    <td colspan="9" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr valign="middle">
        <td width="62%" align="left"><img src="../<?php echo $row_company['logo']; ?>" hspace="15" /></td>
        <td width="38%" align="center"><strong><?php echo $row_company['perusahaan']; ?></strong><br />
          <?php echo $row_company['alamat']; ?><br />
Telp. <?php echo $row_company['telp']; ?> Fax.<?php echo $row_company['fax']; ?></td>
      </tr>
    </table></td>
  </tr>
  <?php if(isset($_GET[barang])) { ?>
  <tr>
    <td colspan="9">NAMA BARANG : <strong><?php echo $row_getagen['barang']; ?></strong></td>
  </tr>
  <tr bgcolor="#1A4D80">
    <th width="24"><strong>No</strong></th>
    <th width="189" align="center" bgcolor="#1A4D80"><strong>Agen</strong></th>
    <th width="106" align="center"><strong>Subtotal</strong></th>
    <th width="72" align="center"><strong>Diskon</strong></th>
    <th width="83" align="center"><strong>Biaya Lain </strong></th>
    <th width="76" align="center"><strong>Pajak</strong></th>
    <th width="117" align="center"><strong>Total</strong></th>
    <th width="112" align="center">Pembayaran</th>
    <th width="152" align="center">Saldo</th>
  </tr>
  <?php if($totalRows_data > 0) { ?>
  <?php $no=1; $jum =0; $saldo = 0; $dis=0; $ongk=0; $pjk=0; $byr=0; do { ?>
  <?php
  mysql_select_db($database_con_gl, $con_gl);
  $query_subtotal = "SELECT sum(gl_trans.total) as total FROM gl_trans, gl_rtrans WHERE gl_trans.pos='K' AND gl_trans.diskon<>'' AND gl_trans.no_ref=gl_rtrans.no_ref AND gl_rtrans.kontak='$row_data[kontak]'";
  $subtotal = mysql_query($query_subtotal, $con_gl) or die(mysql_error());
  $row_subtotal = mysql_fetch_assoc($subtotal);
  $totalRows_subtotal = mysql_num_rows($subtotal);

//echo $query_subtotal;
mysql_select_db($database_con_gl, $con_gl);
$query_ongkir = "SELECT sum(gl_trans.total) as total, gl_rtrans.kontak FROM gl_trans, gl_rtrans WHERE gl_trans.pos='K' AND gl_trans.transaksi='Beban Biaya Lain' AND gl_trans.no_ref=gl_rtrans.no_ref AND gl_rtrans.kontak='$row_data[kontak]' GROUP BY gl_rtrans.kontak";
$ongkir = mysql_query($query_ongkir, $con_gl) or die(mysql_error());
$row_ongkir = mysql_fetch_assoc($ongkir);
$totalRows_ongkir = mysql_num_rows($ongkir);

mysql_select_db($database_con_gl, $con_gl);
$query_pjk = "SELECT sum(gl_trans.total) as total, gl_rtrans.kontak FROM gl_trans, gl_rtrans WHERE gl_trans.pos='K' AND gl_trans.transaksi='Beban Pajak' AND gl_trans.no_ref=gl_rtrans.no_ref AND gl_rtrans.kontak='$row_data[kontak]' GROUP BY gl_rtrans.kontak";
$pjk = mysql_query($query_pjk, $con_gl) or die(mysql_error());
$row_pjk = mysql_fetch_assoc($pjk);
$totalRows_pjk = mysql_num_rows($pjk);

mysql_select_db($database_con_gl, $con_gl);
$query_bayar = "SELECT sum(gl_trans.total) as total, gl_rtrans.kontak FROM gl_trans, gl_rtrans WHERE gl_trans.pos='K' AND gl_trans.x_ref <>'' AND gl_trans.no_ref=gl_rtrans.no_ref AND gl_rtrans.kontak='$row_data[kontak]' GROUP BY gl_rtrans.kontak";
$bayar = mysql_query($query_bayar, $con_gl) or die(mysql_error());
$row_bayar = mysql_fetch_assoc($bayar);
$totalRows_bayar = mysql_num_rows($bayar);
//echo $query_bayar;
  $diskon = $row_data['total'] - $row_subtotal['total'];
  ?>
    <tr valign="top" bgcolor="#FFFFFF">
      <td align="center" class="border"><?php echo $no;$no++;?></td>
      <td class="border"><?php echo $row_data['nama']; ?></td>
      <td align="right" class="border"><?php echo number_format($row_subtotal['total'],0,',','.').",-"; $jum+=$row_subtotal['total']; ?></td>
      <td align="right" class="border"><?php echo number_format($diskon,0,',','.').",-";$dis+=$diskon;?></td>
      <td align="right" bgcolor="#FFFFFF" class="border"><?php echo number_format($row_ongkir['total'],0,',','.').",-"; $ongk +=$row_ongkir['total'];?></td>
      <td align="right" bgcolor="#FFFFFF" class="border"><?php echo number_format($row_pjk['total'],0,',','.').",-"; $pjk += $row_pjk['total'];?></td>
      <td align="right" bgcolor="#FFFFFF" class="border"><?php $xtotal = $row_data['total']+$row_ongkir['total']+$row_pjk['total'];echo number_format($xtotal,0,',','.').",-"; $saldo +=$xtotal;?></td>
      <td align="right" bgcolor="#FFFFFF" class="border"><?php echo number_format($row_bayar['total'],0,',','.').",-"; $byr +=$row_bayar['total'];?></td>
      <td align="right" bgcolor="#FFFFFF" class="border"><?php $tmpsaldo = $xtotal - $row_bayar['total'];echo number_format($tmpsaldo,0,',','.').",-";?></td>
    </tr>
    <?php } while ($row_data = mysql_fetch_assoc($data)); ?>
	<tr valign="top">
          <td  >&nbsp;</td>
          <td align="right" style="border-right:solid 1px #1A4D80;"><strong>Total : </strong></td>
          <td align="right" class="border"><?php echo number_format($jum,0,',','.').",-";?></td>
          <td align="right" class="border"><?php echo number_format($dis,0,',','.').",-";?></td>
          <td align="right" class="border"><?php echo number_format($ongk,0,',','.').",-";?></td>
          <td align="right" class="border"><?php echo number_format($pjk,0,',','.').",-";?></td>
          <td align="right" class="border"><?php echo number_format($saldo,0,',','.').",-";?></td>
          <td align="right" class="border"><?php echo number_format($byr,0,',','.').",-";?></td>
          <td align="right" class="border"><?php echo number_format($tmpsaldo,0,',','.').",-";?></td>
    </tr>
   <?php }else{ ?>
  <tr bgcolor="#FFFFFF">
    <td colspan="9"  >Data tidak ada !!! </td>
  </tr>
  <?php } ?>
</table>
<span class="buttonprint"><a href="javascript:window.print();"><img src="../images/_print.png" width="22" height="22" border="0" /> Cetak</a></span><br />
<br /><span class="note">
Periksa setting kertas terlebih dahulu ( File - Page Setup )<br />
Biasakan Print Preview ( File - Print Preview) sebelum mencetak</span>
<?php } ?>