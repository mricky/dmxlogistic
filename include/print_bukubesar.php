<?php require_once('../connections/con_gl.php'); ?>
<?php
include('function.php');
if($_GET['act']=='periode') {
$colname_xyz = "-1";
if (isset($_POST['cr_per'])) {
  $colname_xyz = (get_magic_quotes_gpc()) ? $_POST['cr_per'] : addslashes($_POST['cr_per']);
}
mysql_select_db($database_con_gl, $con_gl);
$query_xyz = sprintf("SELECT awal, akhir FROM gl_periode WHERE id = %s", $colname_xyz);
$xyz = mysql_query($query_xyz, $con_gl) or die(mysql_error());
$row_xyz = mysql_fetch_assoc($xyz);
$totalRows_xyz = mysql_num_rows($xyz);
$mulai = $row_xyz['awal'];
$sampai = $row_xyz['akhir']; 
}else{
$mulai = $_GET['Mulai'];
$sampai = $_GET['Sampai'];
}
$currentPage = $_SERVER["PHP_SELF"];

/*$maxRows_data = 30;
$pageNum_data = 0;
if (isset($_GET['pageNum_data'])) {
  $pageNum_data = $_GET['pageNum_data'];
}
$startRow_data = $pageNum_data * $maxRows_data;*/

mysql_select_db($database_con_gl, $con_gl);
$query_data = stripslashes(str_replace("+"," ",$_GET[query]));
//$query_limit_data = sprintf("%s LIMIT %d, %d", $query_data, $startRow_data, $maxRows_data);
$data = mysql_query($query_data, $con_gl) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);
/*if (isset($_GET['totalRows_data'])) {
  $totalRows_data = $_GET['totalRows_data'];
} else {
  $all_data = mysql_query($query_data);
  $totalRows_data = mysql_num_rows($all_data);
}
$totalPages_data = ceil($totalRows_data/$maxRows_data)-1;

$queryString_data = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_data") == false && 
        stristr($param, "totalRows_data") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_data = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_data = sprintf("&totalRows_data=%d%s", $totalRows_data, $queryString_data);*/

mysql_select_db($database_con_gl, $con_gl);
$query_period = "SELECT id, awal, akhir, saldoawal FROM gl_periode ORDER BY id ASC";
$period = mysql_query($query_period, $con_gl) or die(mysql_error());
$row_period = mysql_fetch_assoc($period);
$totalRows_period = mysql_num_rows($period);

mysql_select_db($database_con_gl, $con_gl);
$query_getklas = "SELECT kd, klasifikasi FROM gl_klas ORDER BY kd,klasifikasi ASC";
$getklas = mysql_query($query_getklas, $con_gl) or die(mysql_error());
$row_getklas = mysql_fetch_assoc($getklas);
$totalRows_getklas = mysql_num_rows($getklas);
?>
<title>Cetak Buku Besar</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<img src="../images/my_logo.png" />
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">   
  <?php if($totalRows_data > 0) { ?>
  <?php do { ?>
  <?php
  $akun_id = $row_data['id'];
  mysql_select_db($database_con_gl, $con_gl);
$query_get_r ="SELECT no_ref, keterangan,tgl FROM gl_rtrans";
if($mulai <>'Mulai...' OR $sampai <>'Sampai...') {
$query_get_r .=" where tgl between '$mulai' AND '$sampai'";
}
$query_get_r .=" ORDER BY tgl asc";
$get_r = mysql_query($query_get_r, $con_gl) or die(mysql_error());
$row_get_r = mysql_fetch_assoc($get_r);
$totalRows_get_r = mysql_num_rows($get_r);

mysql_select_db($database_con_gl, $con_gl);
$query_saldo_deb = "SELECT sum(gl_trans.total) FROM gl_rtrans, gl_trans WHERE gl_trans.pos='D' AND gl_trans.no_ref=gl_rtrans.no_ref AND gl_trans.akun='$akun_id'";
if($_GET[Mulai]<>'Mulai...') {
$query_saldo_deb .=" AND gl_rtrans.tgl < '$_GET[Mulai]'";
}
$saldo_deb = mysql_query($query_saldo_deb, $con_gl) or die(mysql_error());
$row_saldo_deb = mysql_fetch_assoc($saldo_deb);
$totalRows_saldo_deb = mysql_num_rows($saldo_deb);

mysql_select_db($database_con_gl, $con_gl);
$query_saldo_kre = "SELECT sum(gl_trans.total) FROM gl_rtrans, gl_trans WHERE gl_trans.pos='K' AND gl_trans.no_ref=gl_rtrans.no_ref AND gl_trans.akun='$akun_id'";
if($_GET[Mulai]<>'Mulai...') {
$query_saldo_kre .=" AND gl_rtrans.tgl < '$_GET[Mulai]'";
}
$saldo_kre = mysql_query($query_saldo_kre, $con_gl) or die(mysql_error());
$row_saldo_kre = mysql_fetch_assoc($saldo_kre);
$totalRows_saldo_kre = mysql_num_rows($saldo_kre);
$saldoawalakun = $row_saldo_deb['sum(gl_trans.total)'] - $row_saldo_kre['sum(gl_trans.total)'];
  ?>
      <tr>
        <td colspan="3" align="center">&nbsp;</td>
      </tr>
      <tr bgcolor="#DDDDDD">
    <td colspan="3" align="center" bgcolor="#007EBF"><strong style="color:#FFFFFF;"><?php echo $row_data['akun'];?></strong></td>
  </tr>
	<tr valign="top" bgcolor="#FFFFFF">
        <td colspan="3"  style="border-bottom:solid 1px #E2EAC1;border-right:solid 1px #E2EAC1;border-left:solid 1px #E2EAC1;"><table width="100%" border="1" align="right" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC">
          <tr bgcolor="#EEEEEE">
            <td width="8%"><strong>Tanggal</strong></td>
            <td width="39%"><strong>Transaksi</strong></td>
            <td width="17%" align="center" valign="top"><strong>Debet</strong></td>
            <td width="17%" align="center" valign="top"><strong>Kredit</strong></td>
            <td width="19%" align="center" valign="top"><strong>Balance</strong></td>
          </tr>
          <tr valign="top" bgcolor="#FFFFFF">
            <td bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF">Saldo Awal </td>
            <td align="right" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
            <td align="right" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
            <td align="right" valign="top" bgcolor="#FFFFFF"><?php if($row_data['pos']=='D') { echo number_format($row_data[saldoawal],0,',','.').",-";$totbal_x += $row_data[saldoawal];}else{ echo "( ".number_format(str_replace("-","",$row_data[saldoawal]),0,',','.').",-"." )";$totbal_x -= $row_data[saldoawal];}?></td>
          </tr>
          <?php $totdeb=0; $totkre=0; $totbal_x = $row_data['saldoawal']; do { ?>
          <?php 
	mysql_select_db($database_con_gl, $con_gl);
$query_trans = "SELECT gl_rtrans.tgl, gl_trans.transaksi, gl_trans.id, gl_trans.total, gl_trans.pos, gl_akun.akun, gl_trans.no_ref FROM gl_trans, gl_rtrans, gl_akun WHERE gl_akun.id = gl_trans.akun AND gl_trans.no_ref='$row_get_r[no_ref]' AND gl_trans.akun='$akun_id' AND gl_trans.no_ref=gl_rtrans.no_ref ORDER BY gl_rtrans.tgl desc";
$trans = mysql_query($query_trans, $con_gl) or die(mysql_error());
$row_trans = mysql_fetch_assoc($trans);
$totalRows_trans = mysql_num_rows($trans);
	?>
          <?php if($totalRows_trans > 0)  { ?>
          <?php  do { ?>
          <tr valign="top" bgcolor="#FFFFFF">
            <td bgcolor="#FFFFFF"><?php tanggal($row_get_r['tgl'],"tampilkan");?></td>
            <td bgcolor="#FFFFFF"><?php echo $row_trans['transaksi']; ?></td>
            <td align="right" valign="top" bgcolor="#FFFFFF"><?php if($row_trans['pos']=='D') { $totdeb += $row_trans['total']; echo number_format($row_trans['total'],0,',','.').",-"; if($row_data['pos']=='D') { $cur_totbal = $totbal_x + $row_trans['total'];}else{ $cur_totbal = $totbal_x - $row_trans['total'];}$totbal_x = $cur_totbal;}else{ echo "0,00";} ?></td>
            <td align="right" valign="top" bgcolor="#FFFFFF"><?php if($row_trans['pos']=='K') { $totkre += $row_trans['total']; echo number_format($row_trans['total'],0,',','.').",-";if($row_data['pos']=='K') { $cur_totbal = $totbal_x + $row_trans['total'];}else{ $cur_totbal = $totbal_x - $row_trans['total'];}$totbal_x = $cur_totbal;}else{ echo "0,00";} ?></td>
            <td align="right" valign="top" bgcolor="#FFFFFF"><?php if($totbal_x >0) { echo number_format($totbal_x,0,',','.').",-";}else{ echo "( ".number_format(str_replace("-","",$totbal_x),0,',','.').",-"." )";}?></td>
          </tr>
          <?php } while ($row_trans = mysql_fetch_assoc($trans)); ?>
          <?php } ?>
          <?php } while ($row_get_r = mysql_fetch_assoc($get_r)); ?>
          <tr valign="top">
            <td colspan="2" align="right" bgcolor="#EEEEEE"><strong>Total : </strong></td>
            <td align="right" valign="top" bgcolor="#FFFFFF"><?php echo number_format($totdeb,0,',','.').",-";?></td>
            <td align="right" valign="top" bgcolor="#FFFFFF"><?php echo number_format($totkre,0,',','.').",-";?></td>
            <td align="right" valign="top" bgcolor="#FFFFFF"><?php if($totbal_x >0) { echo number_format($totbal_x,0,',','.').",-";}else{ echo "( ".number_format(str_replace("-","",$totbal_x),0,',','.').",-"." )";}?></td>
          </tr>
        </table></td>
    </tr>
      <?php } while ($row_data = mysql_fetch_assoc($data)); ?>
  <?php }else{ ?>
  <tr>
    <td colspan="3"  style="border-bottom:solid 1px #E2EAC1;border-right:solid 1px #E2EAC1;border-left:solid 1px #E2EAC1;">Data tidak ada !!! </td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="3"></td>
  </tr>
</table>
