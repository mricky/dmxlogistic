<?php require_once('../connections/con_gl.php'); ?>
<?php
/*session_start();
if(empty($_SESSION['admin']) OR !strstr($_SESSION[akses],"PB-6")) {
	echo "<script>window.location=\"history.go(-1)\";</script>";
}
*/
include('function.php');
$currentPage = $_SERVER["PHP_SELF"];
$startRow_data = $pageNum_data * $maxRows_data;
mysql_select_db($database_con_gl, $con_gl);
$query_data = "SELECT distinct gl_rtrans.no_ref, gl_rtrans.tgl,  gl_trans.tglbayar, gl_trans.tglretur, gl_trans.retur, gl_trans.transaksi, gl_trans.jumlah, gl_trans.hargasatuan, gl_trans.diskon, gl_trans.total, gl_trans.barang, gl_trans.tglretur, gl_rtrans.jenis FROM gl_rtrans, gl_trans WHERE gl_rtrans.kontak='$_GET[kontak]' AND gl_trans.no_ref=gl_rtrans.no_ref AND ((gl_rtrans.jenis='6' AND gl_trans.pos='D') OR (gl_rtrans.jenis='4' AND gl_trans.pos='D' AND gl_trans.x_ref <>''))";
if($_GET[mulai]<>'' AND $_GET[sampai]<>'') {
$query_data .=" AND gl_rtrans.tgl between '$_GET[mulai]' AND '$_GET[sampai]'";
}
$query_data .=" ORDER BY gl_rtrans.tgl, gl_trans.id asc";
$data = mysql_query($query_data, $con_gl) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);

mysql_select_db($database_con_gl, $con_gl);
$query_agen = "SELECT gl_kontak.id, gl_kontak.nama FROM gl_kontak ORDER BY gl_kontak.nama";
$agen = mysql_query($query_agen, $con_gl) or die(mysql_error());
$row_agen = mysql_fetch_assoc($agen);
$totalRows_agen = mysql_num_rows($agen);

mysql_select_db($database_con_gl, $con_gl);
$query_getagen = "SELECT gl_kontak.id, gl_kontak.nama FROM gl_kontak WHERE gl_kontak.id='$_GET[kontak]'";
$getagen = mysql_query($query_getagen, $con_gl) or die(mysql_error());
$row_getagen = mysql_fetch_assoc($getagen);
$totalRows_getagen = mysql_num_rows($getagen);

mysql_select_db($database_con_gl, $con_gl);
$query_company = "SELECT * FROM gl_company WHERE id = 1";
$company = mysql_query($query_company, $con_gl) or die(mysql_error());
$row_company = mysql_fetch_assoc($company);
$totalRows_company = mysql_num_rows($company);
?><title>Cetak Kartu Hutang Supplier : <?php echo $row_getagen['nama']; ?></title>
<style media="all">
table tr td, .buttonprint, .note {
font-size:11px;
font-family:Verdana, Arial, Helvetica, sans-serif;
color:#000000;
border-bottom:none;
}
</style>
<style media="print">
.buttonprint, .note {
display:none;
}
</style>
<table width="1050" border="0" align="center" cellpadding="5" cellspacing="0" style="border-bottoms:solid 1px #5A88D5;">
  <tr align="right">
    <td colspan="10" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr valign="middle">
        <td width="62%" align="left"><img src="../<?php echo $row_company['logo']; ?>" hspace="15" /></td>
        <td width="38%" align="center"><strong><?php echo $row_company['perusahaan']; ?></strong><br />
          <?php echo $row_company['alamat']; ?><br />
Telp. <?php echo $row_company['telp']; ?> Fax.<?php echo $row_company['fax']; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="10"><strong>KARTU HUTANG<br /> 
      </strong><br />
    NAMA SUPPLIER : <strong><?php echo $row_getagen['nama']; ?></strong></td>
  </tr>
  <tr bgcolor="#1A4D80">
    <td width="68" style="color:#FFFFFF;"><strong>Tanggal</strong></td>
    <td width="218" bgcolor="#1A4D80" style="color:#FFFFFF;"><strong>Transaksi</strong></td>
    <td width="111" style="color:#FFFFFF;"><strong>Barang</strong></td>
    <td width="48" align="center" style="color:#FFFFFF;"><strong>Jumlah</strong></td>
    <td width="59" align="center" style="color:#FFFFFF;"><strong>Harga</strong></td>
    <td width="48" align="center" style="color:#FFFFFF;"><strong>Diskon(%)</strong></td>
    <td width="91" align="center" style="color:#FFFFFF;"><strong>Hutang</strong> </td>
    <td width="88" align="center" style="color:#FFFFFF;"><strong>Pembayaran</strong></td>
    <td width="95" align="center" style="color:#FFFFFF;"><strong>Retur</strong></td>
    <td width="124" align="center" style="color:#FFFFFF;"><strong>Saldo</strong></td>
  </tr>
  <?php if($totalRows_data > 0) { ?>
  <?php $saldo = 0; do { ?>
  <?php
mysql_select_db($database_con_gl, $con_gl);
$query_hitung = "SELECT sum(gl_trans.total) FROM gl_trans WHERE gl_trans.no_ref='$row_data[no_ref]' AND pos='K'";
$hitung = mysql_query($query_hitung, $con_gl) or die(mysql_error());
$row_hitung = mysql_fetch_assoc($hitung);
$totalRows_hitung = mysql_num_rows($hitung);

mysql_select_db($database_con_gl, $con_gl);
$query_getbrg = "SELECT barang FROM gl_barang where id='$row_data[barang]'";
$getbrg = mysql_query($query_getbrg, $con_gl) or die(mysql_error());
$row_getbrg = mysql_fetch_assoc($getbrg);
$totalRows_getbrg = mysql_num_rows($getbrg);
  ?>
  <?php //if(!strstr($row_data['transaksi'],"Piutang")) { ?>
    <tr valign="top" bgcolor="#FFFFFF">
      <td  style="border-bottom:solid 1px #1A4D80;border-right:solid 1px #1A4D80;border-left:solid 1px #1A4D80;"><?php if(isset($row_data[tglbayar])) { tanggal($row_data['tglbayar'],"tampilkan");}else if(isset($row_data[tglretur]) AND $row_data[tglretur]<>0) { tanggal($row_data['tglretur'],"tampilkan");}else{ tanggal($row_data['tgl'],"tampilkan");} ?></td>
      <td style="border-bottom:solid 1px #1A4D80;border-right:solid 1px #1A4D80;"><?php echo $row_data['transaksi'];?></td>
      <td style="border-bottom:solid 1px #1A4D80;border-right:solid 1px #1A4D80;"><?php if($row_getbrg['barang']<>'') { echo $row_getbrg['barang'];}else{ echo "-";} ?></td>
      <td align="right" style="border-bottom:solid 1px #1A4D80;border-right:solid 1px #1A4D80;"><?php $jum = $row_data['jumlah']; if($jum<>'') { echo $jum;}else{ echo "-";}?></td>
      <td align="right" style="border-bottom:solid 1px #1A4D80;border-right:solid 1px #1A4D80;"><?php $hrgsat = number_format($row_data['hargasatuan'],0,',','.').",-"; echo $hrgsat;?></td>
      <td align="center" style="border-bottom:solid 1px #1A4D80;border-right:solid 1px #1A4D80;"><?php $diskon = $row_data['diskon']; if($diskon<>'') { echo $diskon;}else{ echo "-";}?></td>
      <td align="right" bgcolor="#FFFFFF" style="border-bottom:solid 1px #1A4D80;border-right:solid 1px #1A4D80;"><?php if(($row_data[barang]<>'' OR strstr($row_data[transaksi],"Beban") OR strstr($row_data[transaksi],"Piutang"))AND($row_data['retur']<>1)) { ?>
          <?php echo number_format($row_data['total'],0,',','.').",-"; $saldo +=$row_data['total'];?>
          <?php }else{ ?>
        -
        <?php } ?></td>
      <td align="right" bgcolor="#FFFFFF" style="border-bottom:solid 1px #1A4D80;border-right:solid 1px #1A4D80;"><?php if(strstr($row_data[transaksi],"Pembayaran") OR $row_data[tglbayar]<>'') { ?>
          <?php echo number_format($row_data['total'],0,',','.').",-"; $saldo -=$row_data['total'];?>
          <?php }else{ ?>
        -
        <?php } ?></td>
      <td align="right" bgcolor="#FFFFFF" style="border-bottom:solid 1px #1A4D80;border-right:solid 1px #1A4D80;"><?php if($row_data['barang']<>'' AND $row_data['retur']==1) { ?>
          <?php echo number_format($row_data['total'],0,',','.').",-"; $saldo -=$row_data['total'];?>
        <?php }else{ ?>
        -
        <?php } ?></td>
      <td align="right" bgcolor="#FFFFFF" style="border-bottom:solid 1px #1A4D80;border-right:solid 1px #1A4D80;"><?php echo number_format($saldo,0,',','.').",-";?></td>
    </tr>
	<?php //} ?>
    <?php } while ($row_data = mysql_fetch_assoc($data)); ?>
    <tr>
      <td colspan="10"  style="border-bottom:solid 1px #5A88D5;border-right:solid 1px #5A88D5;border-left:solid 1px #5A88D5;"></td>
    </tr>
</table>
<span class="buttonprint"><a href="javascript:window.print();"><img src="../images/_print.png" width="22" height="22" border="0" /> Cetak</a></span><br />
<br /><span class="note">
Periksa setting kertas terlebih dahulu ( File - Page Setup )<br />
Biasakan Print Preview ( File - Print Preview) sebelum mencetak</span>
<?php }else{ ?>
   <h3>
   Data tidak ada !!!
   <?php } 
mysql_free_result($company);
?>
