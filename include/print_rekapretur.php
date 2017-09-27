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
$query_data = "SELECT sum(gl_trans.total) as total, gl_satuan.satuan, gl_trans.jumlah, gl_trans.r_ref, gl_rtrans.kontak, gl_kontak.nama FROM gl_rtrans, gl_trans, gl_kontak, gl_satuan WHERE gl_kontak.id=gl_rtrans.kontak AND gl_rtrans.no_ref = gl_trans.no_ref AND gl_trans.pos='D' AND gl_trans.no_ref LIKE 'SR%' AND gl_trans.barang='$_GET[barang]' AND gl_trans.satuan = gl_satuan.id";
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
?><title>Cetak Rekap Retur Penjualan : <?php echo $row_getagen['barang']; ?></title>
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
    <td colspan="8" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
    <td colspan="8">NAMA BARANG : <strong><?php echo $row_getagen['barang']; ?></strong></td>
  </tr>
  <tr bgcolor="#1A4D80">
    <th width="24"><strong>No</strong></th>
    <th align="center" bgcolor="#1A4D80"><strong>Agen</strong></th>
    <th width="72" align="center"><strong>Oplah</strong></th>
    <th width="83" align="center"><strong>Retur</strong></th>
    <th width="76" align="center">%Retur</th>
    <th width="117" align="center"><strong>Terjual</strong></th>
    <th width="112" align="center"><strong>%Terjual</strong></th>
    <th width="152" align="center">Total</th>
  </tr>
  <?php if($totalRows_data > 0) { ?>
  <?php $no=1; $totoph = 0; $totret = 0; $totjual = 0; $tmpsaldo =0; do { ?>
  <?php
  $query_jual = "select sum(gl_trans.jumlah) as totaljual from gl_trans, gl_barang, gl_satuan where gl_trans.pos='K' AND gl_trans.barang = gl_barang.id AND gl_trans.satuan=gl_satuan.id AND gl_trans.no_ref='$row_data[r_ref]'";
  $jual = mysql_query($query_jual, $con_gl);
  $row_jual = mysql_fetch_assoc($jual);
  $oph = $row_data['jumlah'] + $row_jual['totaljual'];
  $totoph += $oph;
  $totret +=$row_data['jumlah'];
  $totjual +=$row_jual['totaljual'];
  $ret_prsn = round(($row_data['jumlah']  / $oph)*100,2); 
  $jua_prsn = round(($row_jual['totaljual']  / $oph)*100,2);
  ?>
    <tr valign="top" bgcolor="#FFFFFF">
      <td align="center" class="border"><?php echo $no;$no++;?></td>
      <td class="border"><?php echo $row_data['nama']; ?></td>
      <td align="right" class="border"><?php echo $oph;?> <?php echo $row_data['satuan']; ?></td>
      <td align="right" bgcolor="#FFFFFF" class="border"><?php echo $row_data['jumlah']; ?> <?php echo $row_data['satuan']; ?></td>
      <td align="right" bgcolor="#FFFFFF" class="border"><?php echo $ret_prsn;?></td>
      <td align="right" bgcolor="#FFFFFF" class="border"><?php echo $row_jual['totaljual'];?> <?php echo $row_data['satuan']; ?></td>
      <td align="right" bgcolor="#FFFFFF" class="border"><?php echo $jua_prsn;?></td>
      <td align="right" bgcolor="#FFFFFF" class="border"><?php echo number_format($row_data['total'],0,',','.').",-"; $tmpsaldo +=$row_data['total'];?></td>
    </tr>
    <?php } while ($row_data = mysql_fetch_assoc($data)); ?>
	<tr valign="top">
          <td  >&nbsp;</td>
          <td align="right" style="border-right:solid 1px #1A4D80;"><strong>Total :</strong></td>
          <td align="right" class="border"><?php echo $totoph;?></td>
          <td align="right" class="border"><?php echo $totret;?></td>
          <td align="right" class="border">&nbsp;</td>
          <td align="right" class="border"><?php echo $totjual;?></td>
          <td align="right" class="border">&nbsp;</td>
          <td align="right" class="border"><?php echo number_format($tmpsaldo,0,',','.').",-";?></td>
    </tr>
   <?php }else{ ?>
  <tr bgcolor="#FFFFFF">
    <td colspan="8"  >Data tidak ada !!! </td>
  </tr>
  <?php } ?>
</table>
<span class="buttonprint"><a href="javascript:window.print();"><img src="../images/_print.png" width="22" height="22" border="0" /> Cetak</a></span><br />
<br /><span class="note">
Periksa setting kertas terlebih dahulu ( File - Page Setup )<br />
Biasakan Print Preview ( File - Print Preview) sebelum mencetak</span>
<?php } ?>