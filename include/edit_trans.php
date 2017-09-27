<?php require_once('../connections/con_gl.php'); ?>
<?php
$nref = $_GET['noreferensi'];
$id_x = $_GET['refid'];
$rul = $_GET['rules'];
$totdeb = 0;
$totkre = 0;
mysql_select_db($database_con_gl, $con_gl);
$query_klas = "SELECT kd, klasifikasi, keterangan, neraca, ruglab, tipe FROM gl_klas ORDER BY kd,klasifikasi ASC";
$klas = mysql_query($query_klas, $con_gl) or die(mysql_error());
$row_klas = mysql_fetch_assoc($klas);
$totalRows_klas = mysql_num_rows($klas);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="datatable">
  <tr>
    <th width="10%" align="center"><strong>Kode</strong></th>
    <th width="30%" align="center"><strong>Akun</strong></th>
    <th width="10%" align="center"><strong>Debet</strong></th>
    <th width="10%" align="center"><strong>Kredit</strong></th>
    <th width="30%" align="center"><strong>Transaksi</strong></th>
    <th width="10%" align="center"><strong>Aksi</strong></th>
  </tr>
  <?php
  $colname_get_t = "-1";
if (isset($_GET['noreferensi'])) {
  $colname_get_t = (get_magic_quotes_gpc()) ? $_GET['noreferensi'] : addslashes($_GET['noreferensi']);
}
mysql_select_db($database_con_gl, $con_gl);
$query_get_t = "SELECT gl_trans.id, gl_trans.transaksi, gl_trans.total, gl_trans.pos, gl_akun.id as akunid, gl_akun.akun FROM gl_trans, gl_akun WHERE gl_trans.no_ref= '$colname_get_t' AND gl_akun.id = gl_trans.akun ORDER BY gl_trans.id desc";
$get_t = mysql_query($query_get_t, $con_gl) or die(mysql_error());
$row_get_t = mysql_fetch_assoc($get_t);
$totalRows_get_t = mysql_num_rows($get_t);

$colname_getaku = "-1";
if (isset($_GET['rules'])) {
  $colname_getaku = (get_magic_quotes_gpc()) ? $_GET['rules'] : addslashes($_GET['rules']);
}
mysql_select_db($database_con_gl, $con_gl);
$query_getaku = sprintf("SELECT akun FROM gl_trans WHERE id = %s", $colname_getaku);
$getaku = mysql_query($query_getaku, $con_gl) or die(mysql_error());
$row_getaku = mysql_fetch_assoc($getaku);
$totalRows_getaku = mysql_num_rows($getaku);
  ?>
  <?php if($totalRows_get_t > 0) { ?>
  <?php do { ?>
  <?php if($rul == $row_get_t['id']) { ?>
      <tr valign="top" bgcolor="#FAFAFA">
        <td align="center">
          <div id="kodeDiv"><label>
          <input name="akunkd" type="text" id="akunkd" size="10" maxlength="10" onchange="cekAkun(this.value);" value="<?php echo $row_getaku['akun'];?>"/>
          </label></div>
        </td>
        <td align="center"><div id="akunDiv"><label>
        <select name="akun" id="akun" onchange="cekKode(this.value);">
          <?php
do {  
?>
          <?php
mysql_select_db($database_con_gl, $con_gl);
$query_akun = "SELECT id, akun, klasifikasi, keterangan FROM gl_akun where klasifikasi = '$row_klas[kd]'";
$query_akun .=" ORDER BY id,akun ASC";
$akun = mysql_query($query_akun, $con_gl) or die(mysql_error());
$row_akun = mysql_fetch_assoc($akun);
$totalRows_akun = mysql_num_rows($akun);
?>
          <?php if($totalRows_akun > 0) { ?>
          <option value="" style="background:#EEEEEE; font-weight:bold;"><?php echo $row_klas['klasifikasi'];?></option>
          <?php do { ?>
          <option value="<?php echo $row_akun['id']?>" <?php if($row_akun['id'] == $row_getaku['akun']) { ?>selected="selected"<?php } ?>>-<?php echo $row_akun['akun']?></option>
          <?php } while ($row_akun = mysql_fetch_assoc($akun));?>
          <?php } ?>
          <?php
} while ($row_klas = mysql_fetch_assoc($klas));
  $rows = mysql_num_rows($klas);
  if($rows > 0) {
      mysql_data_seek($klas, 0);
	  $row_klas = mysql_fetch_assoc($klas);
  }
?>
        </select>
        </label></div></td>
        <td align="center"><label></label>
        <input name="debet" type="text" id="debet" value="<?php if($row_get_t['pos']=='D') { echo $row_get_t['total'];} ?>" size="10" onchange="javascript:if(this.value > 0) { this.form.kredit.value='';}else{ alert('Value invalid !!!');this.value='';}"/></td>
        <td align="center"><label>
          <input name="kredit" type="text" id="kredit" value="<?php if($row_get_t['pos']=='K') { echo $row_get_t['total'];} ?>" size="10" onchange="javascript:if(this.value > 0) { this.form.debet.value='';}else{ alert('Value invalid !!!');this.value='';}"/>
        </label></td>
        <td align="center"><label>
        <textarea name="transaksi" cols="35" rows="2" id="transaksi"><?php echo $row_get_t['transaksi']; ?></textarea>
        </label></td>
        <td align="center"><label></label>
            <label>
            <input type="button" onclick="ajaxManageTransaksi('Simpan','<?php echo $row_get_t['id']; ?>');" value="&nbsp;" id="save" class="checkbutton" title="Simpan Transaksi"/>
        </label></td>
    </tr>
   <?php }else{ ?>
    <tr align="center" valign="top" bgcolor="#FAFAFA">
      <td><?php echo $row_get_t['akunid']; ?></td>
      <td><?php echo $row_get_t['akun']; ?></td>
      <td><?php if($row_get_t['pos']=='D') { echo number_format($row_get_t['total'],0,',','.').",-";$totdeb += $row_get_t['total'];} ?></td>
      <td><?php if($row_get_t['pos']=='K') { echo number_format($row_get_t['total'],0,',','.').",-";$totkre += $row_get_t['total'];} ?></td>
      <td><?php echo $row_get_t['transaksi']; ?></td>
      <td><label>
        <button value="<?php echo $row_get_t['id']; ?>" onclick="ajaxEditForm(<?php echo $row_get_t['id']; ?>);" type="button" class="editbutton" title="Edit Transaksi">&nbsp;</button>
      </label>
        <label>
        <input type="button" value="&nbsp;" id="hapus" onclick="ajaxManageTransaksi('Hapus','<?php echo $row_get_t['id']; ?>');" class="deletebutton" title="Hapus Transaksi"/>
        <input name="idtrans" type="hidden" id="idtrans" value="<?php echo $row_get_t['id']; ?>">
      </label></td>
    </tr>
	<?php } ?>
    <?php } while ($row_get_t = mysql_fetch_assoc($get_t)); ?>
	<?php } ?>
</table>
<?php
mysql_free_result($get_t);

mysql_free_result($getaku);
?>
