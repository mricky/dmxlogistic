<?php require_once('../connections/con_gl.php'); ?>
<?php
include('function.php');
$mulai = $_GET[mulai];
$sampai = $_GET[sampai];
mysql_select_db($database_con_gl, $con_gl);
$query_data = "SELECT * FROM gl_rtrans";
if((isset($_GET[tipe_j]) AND $_GET[tipe_j]<>'ALL') OR ($mulai <>'Mulai...' AND $sampai<>'Sampai...')) {
	$query_data .=" where ";
}	
if(isset($_GET[tipe_j]) AND $_GET[tipe_j]<>'ALL') {
	$tip = $_GET[tipe_j];
	$query_data .="no_ref LIKE '%%$tip%%'";
}
if((isset($_GET[tipe_j]) AND $_GET[tipe_j]<>'ALL') AND ($mulai <>'Mulai...' AND $sampai<>'Sampai...')) {
	$query_data .=" AND ";
}
if($mulai <>'Mulai...' AND $sampai<>'Sampai...') {
	$query_data .="tgl between '$mulai' AND '$sampai'";
}
$query_data .=" ORDER BY gl_rtrans.tgl desc";
$data = mysql_query($query_data, $con_gl) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);
?>
<title>Cetak Jurnal</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<img src="../images/my_logo.png" />
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0"> 
  <?php if($totalRows_data > 0) { ?>
  <tr valign="top" bgcolor="#007EBF">
        <td  style="border-bottom:solid 1px #E2EAC1;"><strong style="color:#FFFFFF;">Tanggal</strong></td>
        <td style="border-bottom:solid 1px #E2EAC1;"><strong style="color:#FFFFFF;">No Referensi </strong></td>
        <td width="508" style="border-bottom:solid 1px #E2EAC1;"><strong style="color:#FFFFFF;">Keterangan</strong></td>
  </tr>
  <?php do { ?>
    <tr valign="top" bgcolor="#FFFFFF">
      <td width="136">
        &nbsp;<?php tanggal($row_data['tgl'],"tampilkan"); ?></td>
      <td width="226"><?php echo $row_data[no_ref];?>&nbsp;</td>
      <td><?php echo $row_data[keterangan];?>&nbsp;</td>
    </tr>
	<?php 
	mysql_select_db($database_con_gl, $con_gl);
$query_trans = "SELECT gl_trans.transaksi, gl_trans.id, gl_trans.total, gl_trans.pos, gl_trans.akun as coa, gl_akun.akun as namakun FROM gl_trans, gl_akun WHERE gl_akun.id = gl_trans.akun AND gl_trans.no_ref='$row_data[no_ref]' ORDER BY gl_trans.pos asc";
$trans = mysql_query($query_trans, $con_gl) or die(mysql_error());
$row_trans = mysql_fetch_assoc($trans);
$totalRows_trans = mysql_num_rows($trans);
	?>
	<tr valign="top" bgcolor="#FFFFFF">
        <td colspan="3" style="border-bottom:solid 1px #E2EAC1;"><table width="84%" border="0" align="right" cellpadding="3" cellspacing="0" class="datatable">
			<tr>
              <th width="32%"><strong>Transaksi </strong></th>
              <th width="33%" align="left" valign="top"><strong>Akun</strong></th>
              <th width="18%" align="center" valign="top"><strong>Debet</strong></th>
              <th width="17%" align="center" valign="top"><strong>Kredit</strong></th>
            </tr>
            <?php $totdeb=0; $totkre=0; if($totalRows_trans > 0)  { ?>
            <?php  do { ?>
            <tr valign="top" bgcolor="#FFFFFF">
              <td width="32%"><?php echo $row_trans['transaksi']; ?></td>
              <td width="33%" align="left" valign="top"><?php echo $row_trans['coa']; ?> - <?php echo $row_trans['namakun']; ?></td>
              <td width="18%" align="right" valign="top"><?php if($row_trans['pos']=='D') { $totdeb += $row_trans['total']; echo number_format($row_trans['total'],0,',','.').",-";}else{ echo "0,00";} ?></td>
              <td width="17%" align="right" valign="top"><?php if($row_trans['pos']=='K') { $totkre += $row_trans['total']; echo number_format($row_trans['total'],0,',','.').",-";}else{ echo "0,00";} ?></td>
            </tr>
            <?php } while ($row_trans = mysql_fetch_assoc($trans)); ?>
            <?php } ?>
            <tr valign="top">
              <td colspan="2" align="right"><strong>Total : </strong></td>
              <td align="right" valign="top" bgcolor="#FFFFCC"><strong><?php echo number_format($totdeb,0,',','.').",-";?></strong></td>
              <td align="right" valign="top" bgcolor="#FFFFCC"><strong><?php echo number_format($totkre,0,',','.').",-";?></strong></td>
            </tr>
          </table></td>
	</tr>
      <?php } while ($row_data = mysql_fetch_assoc($data)); ?>
   <?php }else if($mulai<>'' AND $sampai<>'' AND $totalRows_data ==0) { ?>
  <tr>
      <td colspan="3">Data tidak ada !!!</td>
  </tr>
  <?php } ?>
</table>